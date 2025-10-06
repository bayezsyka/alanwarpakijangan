<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-[#059568] to-emerald-600 rounded-xl shadow-lg">
            <div class="px-8 py-6">
                <h2 class="text-2xl font-bold text-white">
                    {{ __('Tambah Artikel Baru') }}
                </h2>
                <p class="text-emerald-100 mt-2">Buat artikel baru untuk website</p>
            </div>
        </div>
    </x-slot>

    @push('styles')
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <style>
            #editor { min-height: 250px; }
            .ql-toolbar.ql-snow {
                border-top-left-radius: 0.5rem;
                border-top-right-radius: 0.5rem;
                border-color: #d1d5db;
            }
            .ql-container.ql-snow {
                border-bottom-left-radius: 0.5rem;
                border-bottom-right-radius: 0.5rem;
                border-color: #d1d5db;
                font-size: 1rem;
            }
        </style>
    @endpush

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="p-8 space-y-8">

                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-400 p-6 rounded-r-lg">
                            <p class="text-red-800 font-semibold">Terjadi kesalahan:</p>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="artikel-form" action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf

                        {{-- Informasi Dasar --}}
                        <div class="bg-gray-50 rounded-xl p-6 border">
                            <h3 class="text-lg font-semibold text-gray-800 mb-6">Informasi Dasar</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Artikel</label>
                                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                    <select name="category_id" id="category_id" class="w-full ...">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                {{-- Untuk form edit --}}
                                                @if(isset($article) && $article->category_id == $category->id) selected @endif
                                            >
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="penulis" class="block text-sm font-medium text-gray-700 mb-2">Penulis</label>
                                    <input type="text" name="penulis" id="penulis" value="{{ old('penulis') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm">
                                </div>
                            </div>
                        </div>

                        {{-- Gambar Artikel --}}
                        <div class="bg-gray-50 rounded-xl p-6 border" x-data="{ activeTab: 'upload', imageUrl: '', handleFileSelect(event) { const file = event.target.files[0]; if (file) { this.imageUrl = URL.createObjectURL(file); } } }">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Gambar Artikel</h3>
                            <template x-if="imageUrl">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                                    <div class="relative inline-block group">
                                        <img :src="imageUrl" class="w-full max-w-sm h-48 object-cover rounded-lg border shadow-sm">
                                        <div @click="imageUrl = ''; $refs.fileInput.value = ''; $refs.urlInput.value = ''" class="absolute top-0 right-0 m-2 bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity" title="Hapus Gambar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <div class="mb-4 border-b border-gray-200">
                                <nav class="-mb-px flex space-x-4" aria-label="Tabs">
                                    <button type="button" @click="activeTab = 'upload'; $refs.urlInput.value = ''" :class="{ 'border-[#059568] text-[#059568]': activeTab === 'upload', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'upload' }" class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm">Upload File</button>
                                    <button type="button" @click="activeTab = 'url'; $refs.fileInput.value = ''" :class="{ 'border-[#059568] text-[#059568]': activeTab === 'url', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'url' }" class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm">URL Gambar</button>
                                </nav>
                            </div>

                            <div>
                                <div x-show="activeTab === 'upload'">
                                    <label for="gambar_upload" class="block text-sm font-medium text-gray-700 mb-2">Pilih File Gambar</label>
                                    <input type="file" name="gambar_upload" id="gambar_upload" x-ref="fileInput" @change="handleFileSelect" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                                </div>
                                <div x-show="activeTab === 'url'" x-cloak>
                                    <label for="gambar_url" class="block text-sm font-medium text-gray-700 mb-2">Masukkan URL Gambar</label>
                                    <div class="flex space-x-2">
                                        <input type="url" name="gambar_url" id="gambar_url" x-ref="urlInput" placeholder="https://..." class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm">
                                        <button type="button" @click="imageUrl = $refs.urlInput.value" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-medium hover:bg-gray-300">Cek</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Konten Artikel --}}
                        <div class="bg-gray-50 rounded-xl p-6 border">
                            <h3 class="text-lg font-semibold text-gray-800 mb-6">Konten Artikel</h3>
                            <input type="hidden" name="isi" id="isi_hidden" value="{{ old('isi') }}">
                            <div id="editor">{!! old('isi') !!}</div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex justify-end space-x-4 pt-6 border-t">
                            <a href="{{ route('admin.artikel.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200">Batal</a>
                            <button type="submit" class="px-6 py-3 bg-[#059568] text-white rounded-lg font-medium hover:bg-green-700 shadow-lg">Simpan Artikel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script>
            var quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'blockquote'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        ['link', 'image', 'code-block'],
                        ['clean']
                    ]
                }
            });

            document.querySelector('#artikel-form').addEventListener('submit', function () {
                document.querySelector('#isi_hidden').value = quill.root.innerHTML;
            });
        </script>
    @endpush
</x-app-layout>
