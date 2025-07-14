<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Acara Galeri Baru</h2> --}}
        <div class="bg-gradient-to-r from-[#008362] to-emerald-600 rounded-xl shadow-lg">
            <div class="px-8 py-6">
                <h2 class="text-2xl font-bold text-white">
                    {{ __('Tambah Acara Galeri Baru') }}
                </h2>
                <p class="text-emerald-100 mt-2">Tambahkan acara baru untuk publikasi galeri Anda!</p>
            </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div 
                    class="p-8" 
                    x-data="uploadForm()" {{-- Inisialisasi komponen Alpine.js --}}
                >
                    {{-- Overlay Loading --}}
                    <div x-show="uploading" x-cloak 
                         class="fixed inset-0 bg-[#008362] bg-opacity-75 flex items-center justify-center z-50">
                        <div class="flex flex-col items-center text-center bg-white p-8 rounded-lg shadow-xl">
                            <svg class="animate-spin h-16 w-16 text-[#008362] mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-800">Mengunggah File...</h3>
                            <p class="text-gray-600 mt-2" x-text="progressText"></p>
                        </div>
                    </div>

                    {{-- Form Utama --}}
                    <form 
                        x-ref="form" 
                        @submit.prevent="submitForm" 
                        action="{{ route('admin.events.store') }}" 
                        method="POST" 
                        enctype="multipart/form-data" 
                        class="space-y-8"
                    >
                        @csrf
                        {{-- Detail Acara --}}
                        <div class="p-6 bg-gray-50 rounded-xl border">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Acara</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="nama_acara" class="block font-medium text-sm text-gray-700">Nama Acara <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_acara" id="nama_acara" value="{{ old('nama_acara') }}" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                    @error('nama_acara') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="tanggal" class="block font-medium text-sm text-gray-700">Tanggal (Opsional)</label>
                                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label for="deskripsi" class="block font-medium text-sm text-gray-700">Deskripsi (Opsional)</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">{{ old('deskripsi') }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Upload Foto --}}
                        <div class="p-6 bg-gray-50 rounded-xl border">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Upload Foto <span class="text-red-500">*</span></h3>
                            <input type="file" name="photos[]" id="photos" @change="handleFiles" required multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                            @error('photos') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            @error('photos.*') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror

                            {{-- Preview Gambar --}}
                            <div class="mt-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4" x-show="previews.length > 0">
                                <template x-for="preview in previews" :key="preview.name"><img :src="preview.url" class="w-full h-32 object-cover rounded-lg shadow-md"></template>
                            </div>
                        </div>

                        {{-- Pesan Error dari AJAX --}}
                        <div x-show="errorMessage" x-cloak class="p-4 bg-red-50 text-red-700 border-l-4 border-red-400 rounded-r-md">
                            <p class="font-bold">Terjadi Kesalahan</p>
                            <p x-text="errorMessage"></p>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex justify-end pt-6 border-t">
                            <button type="submit" :disabled="uploading" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 shadow-md disabled:bg-gray-400 disabled:cursor-not-allowed">
                                <span x-show="!uploading">Simpan Acara</span>
                                <span x-show="uploading">Menunggu...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function uploadForm() {
            return {
                uploading: false, progress: 0, progressText: '', errorMessage: '', previews: [],
                handleFiles(event) {
                    this.previews = []; let files = event.target.files;
                    for (let i = 0; i < files.length; i++) { this.previews.push({ name: files[i].name, url: URL.createObjectURL(files[i]) }); }
                },
                submitForm() {
                    this.uploading = true; this.progress = 0; this.errorMessage = '';
                    this.progressText = 'Mempersiapkan...';
                    const formData = new FormData(this.$refs.form);
                    const xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', (e) => {
                        if (e.lengthComputable) {
                            this.progress = Math.round((e.loaded / e.total) * 100);
                            this.progressText = `(${(e.loaded / 1024 / 1024).toFixed(2)} MB / ${(e.total / 1024 / 1024).toFixed(2)} MB)`;
                        }
                    });
                    xhr.onload = () => {
                        this.uploading = false;
                        if (xhr.status >= 200 && xhr.status < 300) { window.location.href = "{{ route('admin.events.index') }}"; } 
                        else {
                            try { let errorData = JSON.parse(xhr.responseText); this.errorMessage = errorData.errors ? Object.values(errorData.errors).flat().join(' ') : (errorData.message || 'Terjadi kesalahan server.'); } 
                            catch (e) { this.errorMessage = 'Terjadi kesalahan yang tidak diketahui.'; }
                        }
                    };
                    xhr.onerror = () => { this.uploading = false; this.errorMessage = 'Upload gagal. Periksa koneksi internet Anda.'; };
                    xhr.open('POST', this.$refs.form.action);
                    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                    xhr.setRequestHeader('Accept', 'application/json');
                    xhr.send(formData);
                }
            }
        }
    </script>
</x-app-layout>