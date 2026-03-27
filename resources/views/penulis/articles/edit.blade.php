<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('penulis.articles.index') }}" class="text-gray-400 hover:text-emerald-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-bold text-gray-800 tracking-tight uppercase">Sunting Artikel</h2>
        </div>
    </x-slot>

    @push('styles')
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <style>
            #editor { min-height: 400px; border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem; }
            .ql-toolbar.ql-snow { border-top-left-radius: 1rem; border-top-right-radius: 1rem; border-color: #f3f4f6; background: #f9fafb; padding: 0.75rem; }
            .ql-container.ql-snow { border-color: #f3f4f6; font-family: 'Inter', sans-serif; font-size: 1rem; }
        </style>
    @endpush

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <form id="artikel-form" action="{{ route('penulis.articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-100 p-5 rounded-2xl shadow-sm flex items-start gap-4">
                        <div class="bg-red-500 text-white p-2 rounded-xl shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-black text-red-800 uppercase tracking-widest mb-1">Revisi Diperlukan</h3>
                            <ul class="text-xs font-bold text-red-600/80 space-y-0.5 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                {{-- Informasi Utama --}}
                <x-card>
                    <x-slot name="header">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                            <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Data Primer Artikel</h3>
                        </div>
                    </x-slot>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="judul" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Judul Konten <span class="text-red-500">*</span></label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul', $article->judul) }}" required 
                                   class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none">
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="category_id" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Kategori <span class="text-red-500">*</span></label>
                                <select name="category_id" id="category_id" required
                                        class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="penulis" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Identitas Penulis <span class="text-red-500">*</span></label>
                                <div class="relative group">
                                    <input type="text" id="penulis" value="{{ auth()->user()->name }}" disabled 
                                           class="w-full pl-11 pr-4 py-3.5 bg-gray-100 border border-transparent rounded-2xl text-gray-500 cursor-not-allowed font-bold">
                                    <div class="absolute left-4 top-4 text-gray-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="status" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Status <span class="text-red-500">*</span></label>
                                <select name="status" id="status" required
                                        class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none">
                                    <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : (!old('status', $article->status) ? 'selected' : '') }}>Published</option>
                                    <option value="archived" {{ old('status', $article->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </x-card>

                {{-- Media --}}
                <x-card no-padding overflow-hidden x-data="{ 
                    activeTab: '{{ Str::startsWith(old('gambar_url', $article->gambar), 'http') ? 'url' : 'upload' }}', 
                    imageUrl: '{{ $article->gambar ? (Str::startsWith($article->gambar, 'http') ? $article->gambar : asset('storage/' . $article->gambar)) : '' }}', 
                    deleteImage: false,
                    handleFileSelect(event) { 
                        const file = event.target.files[0]; 
                        if (file) { 
                            this.imageUrl = URL.createObjectURL(file); 
                            this.deleteImage = false;
                        } 
                    } 
                }">
                    <x-slot name="header">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-6 bg-blue-500 rounded-full"></div>
                            <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Visual & Cover</h3>
                        </div>
                    </x-slot>

                    <div class="p-6 bg-gray-50/30">
                        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start">
                            <div class="lg:col-span-2 order-2 lg:order-1">
                                <div class="flex p-1 bg-white border border-gray-100 rounded-2xl shadow-sm mb-6 max-w-sm mx-auto uppercase">
                                    <button type="button" @click="activeTab = 'upload'; $refs.urlInput.value = ''" 
                                            :class="activeTab === 'upload' ? 'bg-emerald-600 text-white shadow-lg' : 'text-gray-400'" 
                                            class="flex-1 py-2.5 px-4 rounded-xl text-[10px] font-black tracking-widest transition-all">
                                        UPLOAD
                                    </button>
                                    <button type="button" @click="activeTab = 'url'; $refs.fileInput.value = ''" 
                                            :class="activeTab === 'url' ? 'bg-emerald-600 text-white shadow-lg' : 'text-gray-400'" 
                                            class="flex-1 py-2.5 px-4 rounded-xl text-[10px] font-black tracking-widest transition-all">
                                        LINK / URL
                                    </button>
                                </div>

                                <input type="hidden" name="hapus_gambar" :value="deleteImage ? '1' : '0'">

                                <div x-show="activeTab === 'upload'">
                                    <label for="gambar_upload" class="cursor-pointer group block">
                                        <div class="border-2 border-dashed border-gray-200 rounded-3xl px-6 py-12 group-hover:bg-white group-hover:border-emerald-300 group-hover:shadow-xl group-hover:shadow-emerald-500/5 transition-all text-center bg-gray-50">
                                            <div class="w-16 h-16 bg-white border border-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm group-hover:scale-110 group-hover:rotate-3 transition-transform text-gray-400 group-hover:text-emerald-500">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            </div>
                                            <p class="text-[11px] font-black text-gray-500 tracking-widest">GANTI FILE SAMPU</p>
                                        </div>
                                        <input type="file" name="gambar_upload" id="gambar_upload" x-ref="fileInput" @change="handleFileSelect" class="hidden">
                                    </label>
                                </div>

                                <div x-show="activeTab === 'url'" x-cloak>
                                    <div class="relative group">
                                        <input type="url" name="gambar_url" id="gambar_url" x-ref="urlInput" 
                                               value="{{ old('gambar_url', Str::startsWith($article->gambar, 'http') ? $article->gambar : '') }}"
                                               placeholder="https://domain.com/path/ke/gambar.jpg" 
                                               class="w-full pl-4 pr-16 py-4 bg-white border border-gray-100 rounded-2xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-700 outline-none text-xs placeholder:text-gray-300 shadow-sm">
                                        <button type="button" @click="imageUrl = $refs.urlInput.value; deleteImage = false" 
                                                class="absolute right-3 top-3 px-3 py-1.5 bg-emerald-50 text-emerald-600 rounded-xl text-[9px] font-black uppercase tracking-wider hover:bg-emerald-600 hover:text-white transition-all">
                                            CHECK
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="lg:col-span-3 order-1 lg:order-2">
                                <div class="bg-white rounded-3xl border border-gray-100 p-4 shadow-xl shadow-gray-200/50 aspect-video flex items-center justify-center overflow-hidden relative">
                                    <template x-if="imageUrl">
                                        <div class="w-full h-full relative group">
                                            <img :src="imageUrl" class="w-full h-full object-cover rounded-2xl">
                                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-2xl">
                                                <button @click="imageUrl = ''; deleteImage = true; $refs.fileInput.value = ''; $refs.urlInput.value = ''" 
                                                        type="button"
                                                        class="bg-white text-red-600 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all">
                                                    HAPUS MEDIA
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                    <template x-if="!imageUrl">
                                        <div class="text-center">
                                            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-dashed border-gray-200">
                                                <svg class="w-10 h-10 text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </div>
                                            <p class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em]">Media Dihapus</p>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-card>

                {{-- Konten --}}
                <x-card no-padding overflow-hidden>
                    <x-slot name="header">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-6 bg-amber-500 rounded-full"></div>
                            <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Narasi & Isi Artikel <span class="text-red-500">*</span></h3>
                        </div>
                    </x-slot>
                    
                    <div class="bg-white">
                        <input type="hidden" name="isi" id="isi_hidden">
                        <div id="editor" class="border-none">{!! old('isi', $article->isi) !!}</div>
                    </div>
                </x-card>

                {{-- Footer/Aksi --}}
                <div class="flex items-center justify-between p-6 bg-white rounded-3xl border border-gray-100 shadow-sm">
                    <a href="{{ route('artikel.detail', $article->slug) }}" target="_blank"
                       class="px-6 py-3 text-[10px] font-black text-blue-600 uppercase tracking-widest hover:text-blue-800 bg-blue-50 border border-blue-100 rounded-xl transition-colors">
                        LIHAT PRATINJAU
                    </a>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('penulis.articles.index') }}" 
                           class="px-6 py-3 text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-gray-600 transition-colors">
                            BATALKAN
                        </a>
                        <button type="submit" class="inline-flex items-center justify-center px-10 py-4 bg-emerald-600 rounded-2xl font-black text-xs text-white uppercase tracking-[0.2em] shadow-xl shadow-emerald-200 hover:bg-emerald-700 hover:scale-[1.02] transition-all active:scale-95">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            SIMPAN PERUBAHAN
                        </button>
                    </div>
                </div>
            </form>
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
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'align': [] }],
                        ['link', 'image', 'blockquote', 'code-block'],
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
