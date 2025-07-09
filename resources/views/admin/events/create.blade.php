<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Acara Galeri Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        {{-- Bagian Informasi Dasar --}}
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
                        
                        {{-- Bagian Upload Foto dengan Alpine.js untuk Preview --}}
                        <div class="p-6 bg-gray-50 rounded-xl border" x-data="fileUpload()">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Upload Foto <span class="text-red-500">*</span></h3>
                            <input type="file" name="photos[]" id="photos" @change="handleFiles" required multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                            @error('photos') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            @error('photos.*') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror

                            {{-- Container untuk Preview Gambar --}}
                            <div class="mt-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4" x-show="previews.length > 0">
                                <template x-for="(preview, index) in previews" :key="index">
                                    <div class="relative group">
                                        <img :src="preview" class="w-full h-32 object-cover rounded-lg shadow-md">
                                        <div @click="removeFile(index)" class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center cursor-pointer opacity-0 group-hover:opacity-100 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div class="flex justify-end pt-6 border-t">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md">Simpan Acara</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function fileUpload() {
            return {
                previews: [],
                handleFiles(event) {
                    this.previews = [];
                    let files = event.target.files;
                    for (let i = 0; i < files.length; i++) {
                        this.previews.push(URL.createObjectURL(files[i]));
                    }
                },
                // Fungsi remove belum bisa menghapus file dari input, hanya preview.
                // Untuk UX yang lebih kompleks, diperlukan pendekatan yang lebih rumit.
                // Untuk saat ini, memilih file kembali akan me-reset preview.
            }
        }
    </script>
</x-app-layout>