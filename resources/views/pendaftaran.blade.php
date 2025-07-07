@extends('layouts.public')

@section('title', 'Pendaftaran Santri Baru - Pesantren Al-Anwar')

@section('content')
<div class="bg-gray-50 flex items-center justify-center p-4 pt-24 pb-12">
    <div class="w-full max-w-4xl bg-white rounded-xl shadow-lg overflow-hidden">
        {{-- Header Form --}}
        <div class="bg-gradient-to-r from-blue-600 to-sky-700 p-6 text-white">
            <div class="flex items-center space-x-4">
                <img src="{{ url('images/logo.png') }}" alt="Logo Pesantren" class="h-12">
                <div>
                    <h1 class="text-2xl font-bold">Pendaftaran Santri Baru</h1>
                    <p class="text-sm opacity-90">Pondok Pesantren Al-Anwar Pakijangan</p>
                </div>
            </div>
        </div>

        {{-- Menampilkan Error Validasi Jika Ada --}}
        @if ($errors->any())
            <div class="p-6">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Terjadi Kesalahan! Harap periksa kembali isian Anda.</strong>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- Form Utama --}}
        <form id="registrationForm" action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 space-y-8">
            @csrf
            
            {{-- Data Diri Santri --}}
            <div class="space-y-6">
                <div class="border-b border-gray-200 pb-2">
                    <h3 class="text-lg font-semibold text-gray-800">Data Diri Santri</h3>
                    <p class="text-sm text-gray-500">Isi dengan data lengkap dan valid sesuai dokumen resmi.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div class="col-span-2">
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">Nomor Induk Kependudukan (NIK) <span class="text-red-500">*</span></label>
                        <input type="text" id="nik" name="nik" value="{{ old('nik') }}" required pattern="\d{16}" title="NIK harus 16 digit angka" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="nisn" class="block text-sm font-medium text-gray-700 mb-1">NISN</label>
                        <input type="text" id="nisn" name="nisn" value="{{ old('nisn') }}" pattern="\d{10}" title="NISN harus 10 digit angka" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="nomor_wa" class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp <span class="text-red-500">*</span></label>
                        <input type="tel" id="nomor_wa" name="nomor_wa" value="{{ old('nomor_wa') }}" required class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="jenis_kelamin" required class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" @if(old('jenis_kelamin') == 'Laki-laki') selected @endif>Laki-laki</option>
                            <option value="Perempuan" @if(old('jenis_kelamin') == 'Perempuan') selected @endif>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea id="alamat" name="alamat" rows="3" required class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">{{ old('alamat') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Data Orang Tua --}}
            <div class="space-y-6">
                <div class="border-b border-gray-200 pb-2">
                    <h3 class="text-lg font-semibold text-gray-800">Data Orang Tua / Wali</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Data Ayah --}}
                    <div class="space-y-4">
                        <h4 class="font-medium">Data Ayah</h4>
                        <div>
                            <label for="nama_ayah" class="block text-sm text-gray-700 mb-1">Nama Ayah <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" required class="w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="pekerjaan_ayah" class="block text-sm text-gray-700 mb-1">Pekerjaan Ayah <span class="text-red-500">*</span></label>
                            <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" required class="w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="telepon_ayah" class="block text-sm text-gray-700 mb-1">Telepon Ayah <span class="text-red-500">*</span></label>
                            <input type="tel" name="telepon_ayah" value="{{ old('telepon_ayah') }}" required class="w-full border-gray-300 rounded-md">
                        </div>
                    </div>
                    {{-- Data Ibu --}}
                    <div class="space-y-4">
                        <h4 class="font-medium">Data Ibu</h4>
                        <div>
                            <label for="nama_ibu" class="block text-sm text-gray-700 mb-1">Nama Ibu <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" required class="w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="pekerjaan_ibu" class="block text-sm text-gray-700 mb-1">Pekerjaan Ibu <span class="text-red-500">*</span></label>
                            <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" required class="w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="telepon_ibu" class="block text-sm text-gray-700 mb-1">Telepon Ibu <span class="text-red-500">*</span></label>
                            <input type="tel" name="telepon_ibu" value="{{ old('telepon_ibu') }}" required class="w-full border-gray-300 rounded-md">
                        </div>
                    </div>
                    {{-- Data Wali --}}
                    <div class="md:col-span-2 space-y-4 pt-4 border-t">
                        <h4 class="font-medium">Data Wali (Opsional)</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <input type="text" name="nama_wali" value="{{ old('nama_wali') }}" placeholder="Nama Wali" class="w-full border-gray-300 rounded-md">
                            <input type="text" name="pekerjaan_wali" value="{{ old('pekerjaan_wali') }}" placeholder="Pekerjaan Wali" class="w-full border-gray-300 rounded-md">
                            <input type="tel" name="telepon_wali" value="{{ old('telepon_wali') }}" placeholder="Telepon Wali" class="w-full border-gray-300 rounded-md">
                            <input type="text" name="hubungan_wali" value="{{ old('hubungan_wali') }}" placeholder="Hubungan dengan Santri" class="w-full border-gray-300 rounded-md">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Riwayat Pendidikan & Berkas --}}
            <div class="space-y-6">
                 <div class="border-b border-gray-200 pb-2">
                    <h3 class="text-lg font-semibold text-gray-800">Riwayat Pendidikan & Berkas</h3>
                    <p class="text-sm text-gray-500">Upload dokumen dengan format JPG/PNG/PDF (maks. 2MB)</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" required placeholder="Asal Sekolah Terakhir *" class="w-full border-gray-300 rounded-md">
                    <input type="number" name="tahun_lulus" value="{{ old('tahun_lulus') }}" required placeholder="Tahun Lulus *" class="w-full border-gray-300 rounded-md">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto Santri <span class="text-red-500">*</span></label>
                        <input type="file" name="foto_santri" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Scan Kartu Keluarga (KK) <span class="text-red-500">*</span></label>
                        <input type="file" name="scan_kk" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Scan Ijazah/SKL <span class="text-red-500">*</span></label>
                        <input type="file" name="scan_ijazah" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                </div>
            </div>

            {{-- Tombol Submit --}}
            <div class="pt-4 border-t">
                <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700">
                    Kirim Formulir Pendaftaran
                </button>
            </div>
        </form>
    </div>
</div>
@endsection