@extends('layouts.public')

@section('title', 'Pendaftaran Santri Baru - Pesantren Al-Anwar')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('content')
<div class="bg-gray-50 flex items-center justify-center p-4 pt-24 pb-12">
    <div x-data="pendaftaranForm({ success: {{ session('registration_success') ? 'true' : 'false' }} })" class="w-full max-w-4xl bg-white rounded-xl shadow-lg overflow-hidden">
        
        <div class="bg-gradient-to-r from-blue-600 to-sky-700 p-6 text-white">
             <h1 class="text-2xl font-bold">Pendaftaran Santri Baru</h1>
             <p class="text-sm opacity-90">Pondok Pesantren Al-Anwar Pakijangan</p>
        </div>

        <div class="px-6 pt-4" x-show="langkah < 3" x-transition>
            <div class="flex justify-between items-start text-center">
                <div class="w-1/3"><div class="h-8 w-8 mx-auto rounded-full flex items-center justify-center font-bold" :class="langkah >= 1 ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600'">1</div><span class="text-xs mt-1">Verifikasi</span></div>
                <div class="w-1/3"><div class="h-8 w-8 mx-auto rounded-full flex items-center justify-center font-bold" :class="langkah >= 2 ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600'">2</div><span class="text-xs mt-1">Data Diri</span></div>
                <div class="w-1/3"><div class="h-8 w-8 mx-auto rounded-full flex items-center justify-center font-bold" :class="langkah >= 3 ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600'">3</div><span class="text-xs mt-1">Selesai</span></div>
            </div>
        </div>

        <div class="p-6 md:p-8">
            <div x-show="langkah === 1" x-transition.opacity class="space-y-8">
                <div class="text-center"><h2 class="text-2xl font-bold text-gray-800">Verifikasi Nomor WhatsApp</h2><p class="mt-2 text-gray-600">Masukkan nomor WhatsApp aktif untuk memulai pendaftaran.</p></div>
                <div class="mt-8 max-w-md mx-auto space-y-4">
                    <div>
                        <label for="wa_input" class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp</label>
                        <div class="flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border bg-gray-50 text-gray-500">+62</span>
                            <input type="tel" id="wa_input" x-model="nomorWaInput" required placeholder="81234567890" class="flex-1 block w-full px-3 py-3 rounded-none rounded-r-md border-gray-300">
                        </div>
                    </div>
                    <div x-show="errorMessage" x-text="errorMessage" class="text-red-500 text-sm p-2 bg-red-50 rounded-md"></div>
                    <button type="button" @click="sendOtp" :disabled="loading" class="w-full flex justify-center items-center py-3 px-4 border rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 disabled:bg-blue-300">
                        <span x-show="!loading">Kirim Kode Verifikasi</span>
                        <svg x-show="loading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        <span x-show="loading">Mengirim...</span>
                    </button>
                </div>
                <div x-show="otpSent" x-transition class="mt-8 max-w-md mx-auto">
                    <label class="block text-sm font-medium text-gray-700 text-center">Masukkan 6 Digit Kode Verifikasi</label>
                    <div class="flex justify-center space-x-2 mt-2" @keydown.backspace="handleOtpBackspace">
                        <template x-for="(digit, index) in otp" :key="index"><input type="text" maxlength="1" x-model="otp[index]" :id="'otp-' + index" @input="handleOtpInput" class="w-12 h-12 text-2xl text-center border rounded-md"></template>
                    </div><div x-show="otpErrorMessage" x-text="otpErrorMessage" class="text-red-500 text-sm text-center mt-2"></div>
                </div>
            </div>

            <div x-show="langkah === 2" x-transition>
                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert"><p class="font-bold">Error dari Server!</p><p>Data yang Anda kirim masih belum valid. Mohon periksa kembali.</p></div>
                @endif
                <form id="registrationForm" x-ref="form" action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    <input type="hidden" name="nomor_wa" :value="verifiedNomorWa">
                    @include('pendaftaran.form-fields')
                    <div class="pt-4 border-t flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-3">
                        <button type="button" @click="validateForm" class="w-full sm:w-auto flex justify-center items-center py-3 px-6 border border-gray-300 rounded-md shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50">Cek Validitas Data</button>
                        <button type="submit" :disabled="!isFormValid" class="w-full sm:w-auto flex justify-center items-center py-3 px-6 border rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 disabled:bg-blue-300 disabled:cursor-not-allowed">Kirim Formulir</button>
                    </div>
                </form>
            </div>

            <div x-show="langkah === 3" x-transition.opacity class="text-center py-12">
                <div class="w-24 h-24 bg-green-100 rounded-full p-4 flex items-center justify-center mx-auto"><svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                <h2 class="text-2xl font-bold text-gray-800 mt-6">Pendaftaran Berhasil!</h2>
                <p class="text-gray-600 mt-2 max-w-md mx-auto">Terima kasih, data Anda telah kami terima. Notifikasi berisi link grup WhatsApp telah dikirim ke nomor Anda.</p>
                <div class="mt-8" x-show="showHomeButton" x-transition.enter.duration.500ms><a href="{{ route('welcome') }}" class="inline-block px-8 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700">Kembali ke Beranda</a></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function pendaftaranForm(config) {
        return {
            langkah: 2,
            isFormValid: false,
            showHomeButton: false,
            nomorWaInput: '',
            verifiedNomorWa: '',
            loading: false,
            errorMessage: '',
            otpSent: false,
            otp: Array(6).fill(''),
            otpErrorMessage: '',

            init() {
                if (config.success) {
                    this.langkah = 3;
                    setTimeout(() => { this.showHomeButton = true; }, 2000);
                }
            },

            validateForm() {
                const form = this.$refs.form;
                this.isFormValid = false;
                if (form.checkValidity()) {
                    this.loading = true;
                    fetch('{{ route('pendaftaran.ajax_validate') }}', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
                        body: JSON.stringify({ nik: document.getElementById('nik').value })
                    })
                    .then(res => {
                        if (!res.ok) { return res.json().then(err => { throw err; }); }
                        return res.json();
                    })
                    .then(data => {
                        this.isFormValid = true;
                        Swal.fire('Data Valid!', 'Semua data yang dicek sudah benar. Silakan kirim formulir.', 'success');
                    })
                    .catch(error => {
                        const errorMessages = Object.values(error.errors).flat();
                        Swal.fire('Data Tidak Valid!', errorMessages.join('\n'), 'error');
                    })
                    .finally(() => {
                        this.loading = false;
                    });
                } else {
                    form.reportValidity();
                    Swal.fire('Oops!', 'Masih ada data yang belum diisi atau tidak sesuai format. Silakan periksa kembali.', 'error');
                }
            },

            sendOtp() {
                if (!this.nomorWaInput) { this.errorMessage = 'Nomor WhatsApp tidak boleh kosong.'; return; }
                this.loading = true; this.errorMessage = '';
                fetch('{{ route('otp.send') }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
                    body: JSON.stringify({ nomor_wa: '62' + this.nomorWaInput })
                })
                .then(res => {
                    if (!res.ok) { return res.json().then(err => { throw new Error(err.message || 'Gagal mengirim OTP.') }); }
                    return res.json();
                })
                .then(data => {
                    this.otpSent = true;
                    this.$nextTick(() => document.getElementById('otp-0').focus());
                })
                .catch(error => { this.errorMessage = error.message; })
                .finally(() => { this.loading = false; });
            },

            handleOtpInput(e) {
                const index = parseInt(e.target.id.split('-')[1]);
                if (e.target.value && index < 5) { document.getElementById('otp-' + (index + 1)).focus(); }
                if (this.otp.join('').length === 6) { this.verifyOtp(); }
            },
            
            handleOtpBackspace(e) {
                const index = parseInt(e.target.id.split('-')[1]);
                if (!e.target.value && index > 0) { document.getElementById('otp-' + (index - 1)).focus(); }
            },

            verifyOtp() {
                this.otpErrorMessage = '';
                const enteredOtp = this.otp.join('');
                if (enteredOtp.length !== 6) return;
                fetch('{{ route('otp.verify') }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
                    body: JSON.stringify({ otp: enteredOtp, nomor_wa: '62' + this.nomorWaInput })
                })
                .then(res => {
                    if (!res.ok) { return res.json().then(err => { throw new Error(err.message || 'Verifikasi gagal.') }); }
                    return res.json();
                })
                .then(data => {
                    this.langkah = 2;
                    this.verifiedNomorWa = '62' + this.nomorWaInput;
                })
                .catch(error => {
                    this.otpErrorMessage = error.message;
                });
            }
        }
    }
</script>
@endpush