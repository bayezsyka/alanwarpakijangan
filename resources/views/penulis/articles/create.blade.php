<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('penulis.articles.index') }}" class="text-gray-400 hover:text-emerald-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-bold text-gray-800 tracking-tight uppercase">Tulis Artikel Baru</h2>
        </div>
    </x-slot>

    @push('styles')
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <style>
            #editor { min-height: 400px; border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem; }
            .ql-toolbar.ql-snow { border-top-left-radius: 1rem; border-top-right-radius: 1rem; border-color: #f3f4f6; background: #f9fafb; padding: 0.75rem; }
            .ql-container.ql-snow { border-color: #f3f4f6; font-family: 'Inter', sans-serif; font-size: 1rem; }
            .ql-editor.ql-blank::before { color: #9ca3af; font-style: normal; font-weight: 500; }
        </style>
    @endpush

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <form id="artikel-form" action="{{ route('penulis.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-100 p-5 rounded-2xl shadow-sm flex items-start gap-4 animate-shake">
                        <div class="bg-red-500 text-white p-2 rounded-xl shadow-lg shadow-red-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-black text-red-800 uppercase tracking-widest mb-1">Terjadi Kesalahan</h3>
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
                            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required 
                                   placeholder="Ketikkan judul artikel yang menarik perhatian..."
                                   class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none placeholder:text-gray-300">
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="category_id" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Kategori <span class="text-red-500">*</span></label>
                                <select name="category_id" id="category_id" required
                                        class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none">
                                    <option value="" disabled {{ !old('category_id') ? 'selected' : '' }}>Pilih Satu Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : (!old('status') ? 'selected' : '') }}>Published</option>
                                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </x-card>

                {{-- Media --}}
                <x-card no-padding overflow-hidden x-data="{ 
                    activeTab: 'upload', 
                    imageUrl: '', 
                    handleFileSelect(event) { 
                        const file = event.target.files[0]; 
                        if (file) { this.imageUrl = URL.createObjectURL(file); } 
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
                                <div class="flex p-1 bg-white border border-gray-100 rounded-2xl shadow-sm mb-6 max-w-sm mx-auto">
                                    <button type="button" @click="activeTab = 'upload'; $refs.urlInput.value = ''" 
                                            :class="activeTab === 'upload' ? 'bg-emerald-600 text-white shadow-lg' : 'text-gray-400 hover:text-emerald-600'" 
                                            class="flex-1 py-2.5 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                                        UPLOAD
                                    </button>
                                    <button type="button" @click="activeTab = 'url'; $refs.fileInput.value = ''" 
                                            :class="activeTab === 'url' ? 'bg-emerald-600 text-white shadow-lg' : 'text-gray-400 hover:text-emerald-600'" 
                                            class="flex-1 py-2.5 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                                        URL / LINK
                                    </button>
                                </div>

                                <div x-show="activeTab === 'upload'">
                                    <label for="gambar_upload" class="cursor-pointer group block">
                                        <div class="border-2 border-dashed border-gray-200 rounded-3xl px-6 py-12 group-hover:bg-white group-hover:border-emerald-300 group-hover:shadow-xl group-hover:shadow-emerald-500/5 transition-all text-center bg-gray-50">
                                            <div class="w-16 h-16 bg-white border border-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm group-hover:scale-110 group-hover:rotate-3 transition-transform text-gray-400 group-hover:text-emerald-500">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            </div>
                                            <p class="text-[11px] font-black text-gray-500 tracking-widest uppercase">Klik untuk Unggah</p>
                                            <p class="text-[9px] font-bold text-gray-300 mt-1 uppercase tracking-tighter">Maksimal Ukuran File 2MB</p>
                                        </div>
                                        <input type="file" name="gambar_upload" id="gambar_upload" x-ref="fileInput" @change="handleFileSelect" class="hidden">
                                    </label>
                                </div>

                                <div x-show="activeTab === 'url'" x-cloak>
                                    <div class="relative group">
                                        <input type="url" name="gambar_url" id="gambar_url" x-ref="urlInput" placeholder="https://domain.com/path/ke/gambar.jpg" 
                                               class="w-full pl-4 pr-16 py-4 bg-white border border-gray-100 rounded-2xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-700 outline-none text-xs placeholder:text-gray-300 shadow-sm">
                                        <button type="button" @click="imageUrl = $refs.urlInput.value" 
                                                class="absolute right-3 top-3 px-3 py-1.5 bg-emerald-50 text-emerald-600 rounded-xl text-[9px] font-black uppercase tracking-wider hover:bg-emerald-600 hover:text-white transition-all">
                                            CHECK
                                        </button>
                                    </div>
                                    <p class="text-[9px] text-gray-400 mt-3 font-bold italic text-center uppercase tracking-tighter">* Link harus bersifat publik dan dapat diakses</p>
                                </div>
                            </div>

                            <div class="lg:col-span-3 order-1 lg:order-2">
                                <div class="bg-white rounded-3xl border border-gray-100 p-4 shadow-xl shadow-gray-200/50 aspect-video flex items-center justify-center overflow-hidden relative">
                                    <template x-if="imageUrl">
                                        <div class="w-full h-full relative group">
                                            <img :src="imageUrl" class="w-full h-full object-cover rounded-2xl">
                                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-2xl">
                                                <button @click="imageUrl = ''; $refs.fileInput.value = ''; $refs.urlInput.value = ''" 
                                                        type="button"
                                                        class="bg-white text-red-600 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all">
                                                    Ganti Gambar
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                    <template x-if="!imageUrl">
                                        <div class="text-center">
                                            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-dashed border-gray-200">
                                                <svg class="w-10 h-10 text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </div>
                                            <p class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em]">Pratinjau Sampul</p>
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
                        <input type="hidden" name="isi" id="isi_hidden" value="{{ old('isi') }}">
                        <div id="editor" class="border-none">{!! old('isi') !!}</div>
                    </div>
                </x-card>

                {{-- Footer/Aksi --}}
                <div class="flex items-center justify-between p-6 bg-white rounded-3xl border border-gray-100 shadow-sm">
                    <a href="{{ route('penulis.articles.index') }}" 
                       class="px-6 py-3 text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-gray-600 transition-colors">
                        BATALKAN
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center px-10 py-4 bg-emerald-600 rounded-2xl font-black text-xs text-white uppercase tracking-[0.2em] shadow-xl shadow-emerald-200 hover:bg-emerald-700 hover:scale-[1.02] transition-all active:scale-95">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        TERBITKAN SEKARANG
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script>
            var quill = new Quill('#editor', {
                theme: 'snow',
                placeholder: 'Tuliskan hikmah atau informasi menarik di sini...',
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

            // Mencegah keluar tanpa sengaja
            let isSubmitting = false;
            const draftKey = 'penulis_article_draft_content';
            const titleInput = document.getElementById('judul');

            // Pulihkan Draft jika ada
            const savedDraft = localStorage.getItem(draftKey);
            // Jangan memulihkan jika sudah ada return error validasi "old('isi')"
            var hasOldData = {{ old('isi') ? 'true' : 'false' }};
            if (savedDraft && !hasOldData) {
                const draftData = JSON.parse(savedDraft);
                if ((draftData.judul && draftData.judul.trim() !== '') || (draftData.isi && draftData.isi.trim() !== '' && draftData.isi !== '<p><br></p>')) {
                    Swal.fire({
                        title: 'DRAFT DITEMUKAN',
                        html: '<p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-2">Sistem menemukan draf yang belum tersimpan pada sesi terakhir Anda.</p>',
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#059669',
                        cancelButtonColor: '#f43f5e',
                        confirmButtonText: 'YA, PULIHKAN DRAFT',
                        cancelButtonText: 'BUANG DRAF',
                        borderRadius: '2rem',
                        customClass: {
                            title: 'text-xl font-black tracking-widest text-gray-800',
                            confirmButton: 'px-8 py-3 rounded-xl font-black text-xs',
                            cancelButton: 'px-8 py-3 rounded-xl font-black text-xs'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if(draftData.judul && !titleInput.value) titleInput.value = draftData.judul;
                            if(draftData.isi) quill.root.innerHTML = draftData.isi;
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            localStorage.removeItem(draftKey);
                        }
                    });
                }
            }

            // Simpan perubahan form secara real-time
            function saveDraft() {
                localStorage.setItem(draftKey, JSON.stringify({
                    judul: titleInput.value,
                    isi: quill.root.innerHTML
                }));
            }

            quill.on('text-change', saveDraft);
            titleInput.addEventListener('input', saveDraft);

            window.addEventListener('beforeunload', function (e) {
                if (!isSubmitting && (quill.getText().trim().length > 0 || titleInput.value.trim().length > 0)) {
                    e.preventDefault();
                    e.returnValue = 'Draf tersedia, anda yakin menutupnya?';
                }
            });

            document.querySelector('#artikel-form').addEventListener('submit', function () {
                isSubmitting = true;
                localStorage.removeItem(draftKey);
                document.querySelector('#isi_hidden').value = quill.root.innerHTML;
            });
        </script>
    @endpush
</x-app-layout>
