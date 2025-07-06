<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-[#008362] to-emerald-600 rounded-xl shadow-lg">
            <div class="px-8 py-6">
                <h2 class="text-2xl font-bold text-white">
                    {{ __('Tambah Artikel Baru') }}
                </h2>
                <p class="text-emerald-100 mt-2">Buat artikel baru untuk publikasi</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="p-8">
                    @if ($errors->any())
                        <div class="mb-8 bg-red-50 border-l-4 border-red-400 rounded-r-lg p-6">
                            <div class="flex items-center mb-3">
                                <svg class="w-5 h-5 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <h3 class="text-red-800 font-semibold">Terjadi Kesalahan!</h3>
                            </div>
                            <ul class="text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li class="flex items-start">
                                        <span class="w-1.5 h-1.5 bg-red-400 rounded-full mt-2 mr-2 flex-shrink-0"></span>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        
                        <!-- Informasi Dasar -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                                <svg class="w-5 h-5 text-[#008362] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Informasi Dasar
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Artikel</label>
                                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#008362] focus:border-transparent transition-all duration-200 bg-white">
                                </div>
                                <div>
                                    <label for="penulis" class="block text-sm font-medium text-gray-700 mb-2">Penulis</label>
                                    <input type="text" name="penulis" id="penulis" value="{{ old('penulis') }}" required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#008362] focus:border-transparent transition-all duration-200 bg-white">
                                </div>
                                <div>
                                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#008362] focus:border-transparent transition-all duration-200 bg-white">
                                </div>
                            </div>
                        </div>

                        <!-- Upload Gambar -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                                <svg class="w-5 h-5 text-[#008362] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Gambar Artikel
                            </h3>
                            
                            <div class="space-y-6">
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-[#008362] transition-colors duration-200">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <label for="gambar_upload" class="cursor-pointer">
                                        <span class="text-[#008362] font-medium hover:text-emerald-600">Upload file gambar</span>
                                        <span class="text-gray-500"> atau drag and drop</span>
                                    </label>
                                    <input type="file" name="gambar_upload" id="gambar_upload" class="hidden" accept="image/*">
                                    <p class="text-xs text-gray-500 mt-2">PNG, JPG, GIF up to 10MB</p>
                                </div>

                                <div class="relative">
                                    <div class="absolute inset-0 flex items-center">
                                        <div class="w-full border-t border-gray-300"></div>
                                    </div>
                                    <div class="relative flex justify-center text-sm">
                                        <span class="px-4 bg-gray-50 text-gray-500 font-medium">ATAU</span>
                                    </div>
                                </div>

                                <div>
                                    <label for="gambar_url" class="block text-sm font-medium text-gray-700 mb-2">URL Gambar</label>
                                    <input type="url" name="gambar_url" id="gambar_url" value="{{ old('gambar_url') }}" 
                                           placeholder="https://contoh.com/gambar.jpg" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#008362] focus:border-transparent transition-all duration-200 bg-white">
                                    <p class="text-xs text-gray-500 mt-2">Jika Anda mengupload file, URL ini akan diabaikan</p>
                                </div>
                            </div>
                        </div>

                        <!-- Konten Artikel -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                                <svg class="w-5 h-5 text-[#008362] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Konten Artikel
                            </h3>
                            <div>
                                <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">Isi Artikel</label>
                                <textarea name="isi" id="isi" rows="12" required 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#008362] focus:border-transparent transition-all duration-200 resize-none bg-white"
                                          placeholder="Tulis konten artikel Anda di sini...">{{ old('isi') }}</textarea>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.artikel.index') }}" 
                               class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-6 py-3 bg-[#008362] text-white rounded-lg font-medium hover:bg-emerald-600 transition-colors duration-200 flex items-center shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Artikel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>