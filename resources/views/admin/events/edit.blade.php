<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Acara: {{ $event->nama_acara }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8" x-data="uploadForm()">
                    
                    {{-- Overlay Loading --}}
                    <div x-show="uploading" x-cloak class="fixed inset-0 bg-[#008362] bg-opacity-75 flex items-center justify-center z-50">
                        <div class="flex flex-col items-center text-center bg-white p-8 rounded-lg shadow-xl">
                            <svg class="animate-spin h-16 w-16 text-[#008362] mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            <h3 class="text-lg font-semibold text-gray-800">Memperbarui Data...</h3>
                            <p class="text-gray-600 mt-2" x-text="progressText"></p>
                        </div>
                    </div>

                    <form x-ref="form" @submit.prevent="submitForm" action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PUT')
                        
                        {{-- Detail Acara --}}
                        <div class="p-6 bg-gray-50 rounded-xl border">
                             <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Acara</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="nama_acara" class="block font-medium text-sm text-gray-700">Nama Acara <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_acara" id="nama_acara" value="{{ old('nama_acara', $event->nama_acara) }}" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label for="tanggal" class="block font-medium text-sm text-gray-700">Tanggal (Opsional)</label>
                                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $event->tanggal) }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label for="deskripsi" class="block font-medium text-sm text-gray-700">Deskripsi (Opsional)</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">{{ old('deskripsi', $event->deskripsi) }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Manajemen Foto --}}
                        <div class="p-6 bg-gray-50 rounded-xl border">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Kelola Foto</h3>
                            <div class="mb-4">
                                <label class="block font-medium text-sm text-gray-700 mb-2">Foto Saat Ini (Centang untuk menghapus)</label>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                    @forelse($event->photos as $photo)
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $photo->file_path) }}" class="w-full h-32 object-cover rounded-lg shadow-md">
                                            <div class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                <label class="flex items-center text-white text-xs cursor-pointer p-2">
                                                    <input type="checkbox" name="delete_photos[]" value="{{ $photo->id }}" class="mr-2 h-4 w-4 rounded text-red-500 border-gray-300 focus:ring-red-500"> Hapus
                                                </label>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="col-span-full text-sm text-gray-500">Tidak ada foto.</p>
                                    @endforelse
                                </div>
                            </div>
                            <div class="mt-6">
                                <label for="photos" class="block font-medium text-sm text-gray-700">Tambah Foto Baru (Opsional)</label>
                                <input type="file" name="photos[]" id="photos" multiple class="mt-1 block w-full text-sm">
                            </div>
                        </div>

                        <div class="flex justify-end pt-6 border-t">
                            <button type="submit" :disabled="uploading" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 shadow-md disabled:bg-gray-400">
                                <span x-show="!uploading">Perbarui Acara</span>
                                <span x-show="uploading">Memperbarui...</span>
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
                uploading: false, progress: 0, progressText: '',
                submitForm() {
                    this.uploading = true; this.progress = 0;
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
                            // Penanganan error bisa ditambahkan di sini jika perlu
                            alert('Terjadi kesalahan saat memperbarui data.');
                        }
                    };
                    xhr.onerror = () => { this.uploading = false; alert('Upload gagal. Periksa koneksi Anda.'); };
                    xhr.open('POST', this.$refs.form.action); // Method tetap POST
                    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                    xhr.setRequestHeader('Accept', 'application/json');
                    xhr.send(formData);
                }
            }
        }
    </script>
</x-app-layout>