<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('manage.selasanan.index') }}" class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all border border-transparent hover:border-emerald-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <span class="text-sm font-black tracking-widest uppercase">Sunting Jurnal</span>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form id="selasanan-form" action="{{ route('manage.selasanan.update', $entry->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                    {{-- Main Content Column --}}
                    <div class="lg:col-span-2 space-y-8">
                        <x-card>
                            <x-slot name="header">
                                <div class="flex items-center gap-3">
                                    <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Inti Jurnal</h3>
                                </div>
                            </x-slot>

                            <div class="space-y-8">
                                <div>
                                    <label for="title" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Judul Literasi / Tema Kajian <span class="text-red-500">*</span></label>
                                    <input type="text" name="title" id="title" value="{{ old('title', $entry->title) }}" required autofocus
                                           class="w-full px-6 py-5 bg-gray-50 border border-transparent rounded-[2rem] focus:bg-white focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-500 transition-all font-black text-xl text-gray-900 outline-none shadow-inner">
                                    <p class="text-[9px] text-gray-400 mt-3 font-black uppercase tracking-widest pl-2">IDENTITAS SEO: {{ $entry->slug }}</p>
                                    @error('title') <p class="text-red-500 text-[10px] mt-2 font-bold uppercase tracking-tight">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Narasi & Catatan Dokumentasi <span class="text-red-500">*</span></label>
                                    <div class="rounded-[2.5rem] border border-emerald-50 overflow-hidden shadow-sm bg-white ring-1 ring-gray-100">
                                        <input type="hidden" name="isi" id="isi_hidden" value="{{ old('isi', $entry->isi) }}">
                                        <div id="editor" class="min-h-[450px] border-none !font-sans">{!! old('isi', $entry->isi) !!}</div>
                                    </div>
                                    @error('isi') <p class="text-red-500 text-[10px] mt-2 font-bold uppercase tracking-tight">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </x-card>
                    </div>

                    {{-- Sidebar/Assets Column --}}
                    <div class="space-y-8">
                        {{-- Aset Visual Eksisting & Baru --}}
                        <x-card>
                            <x-slot name="header">
                                <div class="flex items-center gap-3">
                                    <div class="w-1.5 h-6 bg-blue-500 rounded-full"></div>
                                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Visual & Lensa</h3>
                                </div>
                            </x-slot>

                            <div class="space-y-6">
                                @if($entry->cover_image_path)
                                    <div class="relative group h-56 rounded-[2.5rem] overflow-hidden shadow-2xl ring-4 ring-emerald-50">
                                        <img src="{{ asset('storage/' . $entry->cover_image_path) }}" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center p-6 text-center backdrop-blur-sm">
                                            <label class="flex flex-col items-center gap-3 cursor-pointer p-4 rounded-2xl bg-white/10 hover:bg-white/20 transition-all border border-white/20">
                                                <input type="checkbox" name="remove_cover" value="1" class="w-5 h-5 rounded-lg text-red-600 focus:ring-red-500 border-white/30 bg-transparent">
                                                <span class="text-[10px] font-black text-white uppercase tracking-widest">ELIMINASI FOTO INI</span>
                                            </label>
                                        </div>
                                        <div class="absolute top-4 left-4">
                                            <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-[9px] font-black text-emerald-800 rounded-lg shadow-sm uppercase tracking-widest">FOTO AKTIF</span>
                                        </div>
                                    </div>
                                @endif

                                <div class="relative">
                                    <label class="block text-[9px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-2">GANTI / UNGGAH FOTO BARU</label>
                                    <input type="file" name="cover_image" accept="image/*"
                                        class="block w-full text-[10px] text-gray-400 font-black uppercase tracking-widest file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all cursor-pointer bg-gray-50/50 rounded-2xl border border-dashed border-gray-200 p-2" />
                                </div>
                            </div>
                        </x-card>

                        {{-- Transmisi Audio --}}
                        <x-card>
                             <x-slot name="header">
                                <div class="flex items-center gap-3">
                                    <div class="w-1.5 h-6 bg-amber-500 rounded-full"></div>
                                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Frequensi Audio</h3>
                                </div>
                            </x-slot>

                            <div class="space-y-6">
                                @if($entry->audio_path)
                                    <div class="p-6 bg-amber-50/30 rounded-[2rem] border border-amber-100 shadow-inner ring-4 ring-amber-50 relative group">
                                        <div class="flex items-center justify-between mb-5">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-white text-amber-600 rounded-xl flex items-center justify-center shadow-md ring-1 ring-amber-100 group-hover:rotate-6 transition-transform">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" /></svg>
                                                </div>
                                                <span class="text-[10px] font-black text-amber-900 uppercase tracking-widest">AUDIO AKTIF</span>
                                            </div>
                                            <label class="flex items-center gap-2 text-red-500 hover:text-red-700 transition-colors cursor-pointer group/del">
                                                <input type="checkbox" name="remove_audio" value="1" class="w-4 h-4 rounded text-red-600 focus:ring-red-500 border-amber-200 bg-white">
                                                <span class="text-[9px] font-black uppercase tracking-widest group-hover/del:underline">ELIMINASI</span>
                                            </label>
                                        </div>
                                        <audio controls class="w-full h-8 opacity-70 hover:opacity-100 transition-opacity">
                                            <source src="{{ asset('storage/' . $entry->audio_path) }}" type="{{ $entry->audio_mime ?? 'audio/mpeg' }}">
                                        </audio>
                                        <div class="mt-4 flex justify-end">
                                            <a class="inline-flex items-center text-[9px] font-black text-amber-700 hover:text-amber-900 uppercase tracking-widest bg-white/60 px-3 py-1.5 rounded-lg border border-amber-100 shadow-sm transition-all"
                                               href="{{ route('selasanan.download', $entry->slug) }}">
                                                <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                                DOWNLOAD ASET
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                <div class="relative">
                                    <label class="block text-[9px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-2">GANTI / UNGGAH REKAMAN BARU</label>
                                    <input type="file" name="audio_file" accept=".mp3,.m4a,.wav,.ogg"
                                        class="block w-full text-[10px] text-gray-400 font-black uppercase tracking-widest file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 transition-all cursor-pointer bg-gray-50/50 rounded-2xl border border-dashed border-gray-200 p-2" />
                                </div>
                            </div>
                        </x-card>

                        {{-- Metadata & Status --}}
                        <div class="space-y-4">
                            <button type="button" @click="$el.nextElementSibling.classList.toggle('hidden'); $el.querySelector('svg').classList.toggle('rotate-180')" class="w-full flex items-center justify-between px-6 py-4 bg-white rounded-2xl border border-gray-100 shadow-sm group">
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest group-hover:text-emerald-600 transition-colors">PARAMETER LANJUTAN</span>
                                <svg class="w-4 h-4 text-gray-300 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            
                            <div class="hidden space-y-4 animate-scaleIn">
                                <x-card class="!p-6 !bg-gray-50/50 backdrop-blur-sm border-emerald-50">
                                    <div class="space-y-5">
                                        <div>
                                            <label class="block text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2">PEMATERI</label>
                                            <input name="speaker" value="{{ old('speaker', $entry->speaker) }}" class="w-full px-4 py-2.5 bg-white border border-gray-100 rounded-xl text-xs font-bold text-gray-700 outline-none focus:ring-4 focus:ring-emerald-500/5 focus:border-emerald-500 transition-all">
                                        </div>
                                        <div>
                                            <label class="block text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2">STATUS PUBLIKASI</label>
                                            <select name="is_published" class="w-full px-4 py-2.5 bg-white border border-gray-100 rounded-xl text-xs font-bold text-gray-700 outline-none focus:ring-4 focus:ring-emerald-500/5 focus:border-emerald-500 transition-all appearance-none cursor-pointer">
                                                <option value="1" {{ old('is_published', $entry->is_published ? 1 : 0) == 1 ? 'selected' : '' }}>LIVE / PUBLISHED</option>
                                                <option value="0" {{ old('is_published', $entry->is_published ? 1 : 0) == 0 ? 'selected' : '' }}>DRAFT / OFFLINE</option>
                                            </select>
                                        </div>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2">TARGET HARI</label>
                                                <input type="date" name="monday_date" value="{{ old('monday_date', $entry->monday_date->toDateString()) }}" class="w-full px-4 py-2.5 bg-white border border-gray-100 rounded-xl text-xs font-bold text-gray-700 outline-none focus:ring-4 focus:ring-emerald-500/5 transition-all">
                                            </div>
                                            <div>
                                                <label class="block text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2">WIB</label>
                                                <input type="time" name="time_wib" value="{{ old('time_wib', substr($entry->time_wib,0,5)) }}" class="w-full px-4 py-2.5 bg-white border border-gray-100 rounded-xl text-xs font-bold text-gray-700 outline-none focus:ring-4 focus:ring-emerald-500/5 transition-all">
                                            </div>
                                        </div>
                                        <div class="pt-4 border-t border-gray-200/50">
                                            <p class="text-[9px] font-black text-gray-300 uppercase leading-relaxed tracking-wider">
                                                {{ \Carbon\Carbon::create($entry->year, $entry->month, 1)->locale('id')->translatedFormat('F Y') }} • Minggu ke-{{ $entry->week_of_month }}
                                            </p>
                                        </div>
                                    </div>
                                </x-card>
                            </div>
                        </div>

                        {{-- Update Button Container --}}
                        <div class="sticky bottom-6">
                            <button type="submit" class="w-full py-5 bg-emerald-600 rounded-[2.5rem] font-black text-xs text-white uppercase tracking-[0.3em] shadow-2xl shadow-emerald-200 hover:bg-emerald-700 hover:scale-[1.02] transition-all active:scale-95 group">
                                <div class="flex items-center justify-center gap-3">
                                    <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                                    <span>SIMPAN PERUBAHAN MANIFESTASI</span>
                                </div>
                            </button>
                            <a href="{{ route('manage.selasanan.index') }}" class="block text-center text-[10px] font-black text-gray-300 uppercase tracking-widest mt-6 hover:text-gray-500 transition-colors">BATALKAN REVISI</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script>
    var quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Optimasi catatan literasi...',
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

    document.querySelector('#selasanan-form').addEventListener('submit', function () {
        document.querySelector('#isi_hidden').value = quill.root.innerHTML;
    });
</script>
<style>
    @keyframes scaleIn { 0% { opacity: 0; transform: scale(0.95) translateY(10px); } 100% { opacity: 1; transform: scale(1) translateY(0); } }
    .animate-scaleIn { animation: scaleIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
    .ql-container.ql-snow { border: none !important; font-family: 'Inter', sans-serif !important; font-size: 14px !important; }
    .ql-toolbar.ql-snow { border: none !important; border-bottom: 1px solid #f3f4f6 !important; padding: 12px 20px !important; background: #fafafa !important; }
    .ql-editor { padding: 32px !important; min-height: 450px !important; color: #1f2937 !important; line-height: 1.8 !important; }
</style>
@endpush
