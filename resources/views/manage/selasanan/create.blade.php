<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('manage.selasanan.index') }}" class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all border border-transparent hover:border-emerald-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <span class="text-sm font-black tracking-widest uppercase">Manifest Jurnal</span>
        </div>
    </x-slot>

    <div class="py-6" x-data="selasananUploadForm()" x-cloak>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Floating Upload Panel (Premium Style) --}}
            <div x-show="showUploadPanel" x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-8 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-8 scale-95"
                class="fixed bottom-6 right-6 z-[100] w-96 bg-white/90 backdrop-blur-xl rounded-[2rem] shadow-2xl border border-emerald-100 overflow-hidden ring-8 ring-emerald-50/50"
                style="display: none;">

                {{-- Header Panel --}}
                <div class="bg-emerald-600 px-6 py-4 flex items-center justify-between cursor-pointer"
                    @click="panelExpanded = !panelExpanded">
                    <div class="flex items-center gap-3 text-white">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5" :class="{ 'animate-bounce': uploading && !isPaused }" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                        </div>
                        <span class="font-black text-[10px] uppercase tracking-[0.2em]">
                            <template x-if="uploadStatus === 'uploading'">
                                <span>Transmisi Data<span x-show="isPaused"> (Dijeda)</span></span>
                            </template>
                            <template x-if="uploadStatus === 'success'">
                                <span>Manifestasi Berhasil</span>
                            </template>
                            <template x-if="uploadStatus === 'error'">
                                <span>Kendala Teknis</span>
                            </template>
                            <template x-if="uploadStatus === 'cancelled'">
                                <span>Dibatalkan</span>
                            </template>
                        </span>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" class="p-1.5 hover:bg-white/20 rounded-full transition-colors"
                            @click.stop="panelExpanded = !panelExpanded">
                            <svg class="w-4 h-4 text-white transition-transform duration-300"
                                :class="{ 'rotate-180': !panelExpanded }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Panel Content --}}
                <div x-show="panelExpanded" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-[500px]"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 max-h-[500px]"
                    x-transition:leave-end="opacity-0 max-h-0" class="p-8">
                    
                    {{-- File Info --}}
                    <div class="flex items-center gap-5 mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center flex-shrink-0 shadow-inner">
                            <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-black text-gray-800 truncate uppercase tracking-tight" x-text="fileName || 'JURNAL ENTRY'"></p>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1" x-text="progressText"></p>
                        </div>
                    </div>

                    {{-- Progress Bar --}}
                    <div class="mb-6">
                        <div class="flex justify-between items-end mb-2">
                            <span class="text-2xl font-black text-emerald-600 leading-none" x-text="progress + '%'">0%</span>
                            <span class="text-[9px] font-black text-emerald-900/40 uppercase tracking-widest" x-text="uploadSpeed">-</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden p-0.5">
                            <div class="h-full rounded-full transition-all duration-500 ease-out relative"
                                :class="{
                                    'bg-emerald-600': uploadStatus === 'uploading' && !isPaused,
                                    'bg-amber-500': isPaused,
                                    'bg-emerald-500': uploadStatus === 'success',
                                    'bg-red-500': uploadStatus === 'error' || uploadStatus === 'cancelled'
                                }"
                                :style="'width: ' + progress + '%'">
                                <div class="absolute inset-0 bg-white/20 animate-[pulse_2s_infinite]"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Status/Actions --}}
                    <div class="space-y-4">
                        <template x-if="uploadStatus === 'success'">
                            <div class="p-4 bg-emerald-50 rounded-2xl border border-emerald-100 flex items-center gap-3">
                                <div class="w-8 h-8 bg-emerald-600 text-white rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-[10px] font-black text-emerald-700 uppercase tracking-widest leading-tight">Berhasil! Mengalihkan ke perpustakaan...</span>
                            </div>
                        </template>

                        <template x-if="uploadStatus === 'error'">
                            <div class="p-4 bg-red-50 rounded-2xl border border-red-100 flex flex-col gap-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center shadow-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <span class="text-[10px] font-black text-red-700 uppercase tracking-widest leading-tight">Terjadi Kendala Teknis</span>
                                </div>
                                <p class="text-[10px] font-bold text-red-600/70 ml-11" x-text="errorMessage"></p>
                                <button type="button" @click="retryUpload()" class="mt-2 w-full py-2 bg-white border border-red-100 rounded-xl text-[9px] font-black text-red-600 uppercase tracking-[0.2em] hover:bg-red-600 hover:text-white transition-all">COBA LAGI</button>
                            </div>
                        </template>

                        <div class="flex items-center gap-3" x-show="uploading && uploadStatus === 'uploading'">
                            <button type="button" @click="togglePause()"
                                class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-2xl text-[9px] font-black uppercase tracking-widest transition-all shadow-sm"
                                :class="isPaused ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'">
                                <span x-text="isPaused ? 'LANJUTKAN' : 'JEDA TRANSMISI'"></span>
                            </button>
                            <button type="button" @click="cancelUpload()"
                                class="px-4 py-3 bg-red-50 text-red-600 rounded-2xl text-[9px] font-black uppercase tracking-widest hover:bg-red-600 hover:text-white transition-all border border-red-100">
                                BATAL
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <form x-ref="selasananForm" @submit.prevent="submitForm" id="selasanan-form"
                action="{{ route('manage.selasanan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                    {{-- Main Form Column --}}
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
                                    <input type="text" name="title" id="title" value="{{ old('title') }}" required autofocus
                                           placeholder="Tuliskan judul yang representatif..."
                                           class="w-full px-6 py-5 bg-gray-50 border border-transparent rounded-[2rem] focus:bg-white focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-500 transition-all font-black text-xl text-gray-900 outline-none shadow-inner">
                                    @error('title') <p class="text-red-500 text-[10px] mt-2 font-bold uppercase tracking-tight">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Narasi & Catatan Dokumentasi <span class="text-red-500">*</span></label>
                                    <div class="rounded-[2rem] border border-emerald-50 overflow-hidden shadow-sm bg-white ring-1 ring-gray-100">
                                        <input type="hidden" name="isi" id="isi_hidden" value="{{ old('isi') }}">
                                        <div id="editor" class="min-h-[400px] border-none !font-sans">{!! old('isi') !!}</div>
                                    </div>
                                    @error('isi') <p class="text-red-500 text-[10px] mt-2 font-bold uppercase tracking-tight">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </x-card>
                    </div>

                    {{-- Sidebar/Assets Column --}}
                    <div class="space-y-8">
                        {{-- Aset Visual --}}
                        <x-card>
                            <x-slot name="header">
                                <div class="flex items-center gap-3">
                                    <div class="w-1.5 h-6 bg-blue-500 rounded-full"></div>
                                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Aset Visual</h3>
                                </div>
                            </x-slot>

                            <div id="cover_upload_area">
                                <label for="cover_image_input"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed border-gray-100 rounded-[2.5rem] cursor-pointer bg-gray-50 hover:bg-emerald-50 hover:border-emerald-300 transition-all duration-300 group relative overflow-hidden">
                                    <div class="flex flex-col items-center justify-center p-6 text-center">
                                        <div class="w-16 h-16 bg-white rounded-3xl shadow-xl shadow-gray-200/50 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform group-hover:rotate-3">
                                            <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <p class="text-[10px] font-black text-emerald-800 uppercase tracking-widest">IMPRESI VISUAL</p>
                                        <p class="text-[9px] font-bold text-gray-400 mt-1 uppercase tracking-tighter">KLIK UNTUK IMPORT FOTO (MAX 10MB)</p>
                                    </div>
                                </label>
                                <input type="file" name="cover_image" id="cover_image_input" accept="image/*" class="hidden" />
                            </div>

                            <div id="cover_loading_area" class="hidden">
                                <div class="w-full h-64 border-2 border-emerald-100 rounded-[2.5rem] bg-emerald-50/30 flex flex-col items-center justify-center">
                                    <div class="w-10 h-10 border-4 border-emerald-600 border-t-transparent rounded-full animate-spin"></div>
                                    <p class="text-[9px] font-black text-emerald-600 uppercase tracking-widest mt-4">MEMPROSES LENS...</p>
                                </div>
                            </div>

                            <div id="cover_preview_area" class="hidden relative group h-64 rounded-[2.5rem] overflow-hidden shadow-2xl ring-4 ring-emerald-50">
                                <img id="cover_preview_img" class="w-full h-full object-cover" src="" alt="Preview" />
                                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent p-6 pt-12 transform translate-y-2 group-hover:translate-y-0 transition-transform">
                                    <div class="flex items-center justify-between">
                                        <div class="min-w-0 pr-4">
                                            <p id="cover_file_name" class="text-[10px] font-black text-white uppercase truncate tracking-tight"></p>
                                            <p id="cover_file_size" class="text-[9px] font-bold text-white/60 uppercase tracking-widest mt-0.5"></p>
                                        </div>
                                        <button type="button" id="cover_remove_btn" class="w-10 h-10 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-colors shadow-lg flex-shrink-0 flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="cover_error_area" class="hidden mt-4 p-4 bg-red-50 rounded-2xl border border-red-100">
                                <p id="cover_error_text" class="text-[9px] font-black text-red-600 uppercase tracking-widest leading-relaxed"></p>
                            </div>
                        </x-card>

                        {{-- Aset Audio --}}
                        <x-card>
                             <x-slot name="header">
                                <div class="flex items-center gap-3">
                                    <div class="w-1.5 h-6 bg-amber-500 rounded-full"></div>
                                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Transmisi Audio</h3>
                                </div>
                            </x-slot>

                            <div id="audio_upload_area">
                                <label for="audio_file_input"
                                    class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-100 rounded-[2rem] cursor-pointer bg-gray-50 hover:bg-amber-50 hover:border-amber-300 transition-all duration-300 group">
                                    <div class="flex flex-col items-center justify-center p-4 text-center">
                                        <div class="w-12 h-12 bg-white rounded-2xl shadow-xl shadow-gray-200/50 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                            </svg>
                                        </div>
                                        <p class="text-[10px] font-black text-amber-800 uppercase tracking-widest">REKAMAN KAJIAN</p>
                                        <p class="text-[9px] font-bold text-gray-400 mt-1 uppercase tracking-tighter">IMPORT MP3/M4A (MAX 200MB)</p>
                                    </div>
                                </label>
                                <input type="file" name="audio_file" id="audio_file_input" accept=".mp3,.m4a,.wav,.ogg" class="hidden" />
                            </div>

                            <div id="audio_preview_area" class="hidden">
                                <div class="bg-amber-50/50 border border-amber-100 rounded-[2rem] p-6 shadow-inner ring-4 ring-amber-50">
                                    <div class="flex items-center gap-4 mb-4">
                                        <div class="w-12 h-12 bg-white text-amber-600 rounded-2xl flex items-center justify-center shadow-lg ring-1 ring-amber-100">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" /></svg>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p id="audio_file_name" class="text-[9px] font-black text-amber-900 truncate uppercase tracking-tight"></p>
                                            <p id="audio_file_size" class="text-[9px] font-bold text-amber-700/60 uppercase tracking-widest mt-0.5"></p>
                                        </div>
                                        <button type="button" id="audio_remove_btn" class="w-9 h-9 bg-white border border-red-100 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all shadow-sm flex items-center justify-center">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </div>
                                    <audio id="audio_preview_player" controls class="w-full h-8 opacity-70 hover:opacity-100 transition-opacity"></audio>
                                </div>
                            </div>
                            <div id="audio_error_area" class="hidden mt-4 p-4 bg-red-50 rounded-2xl border border-red-100">
                                <p id="audio_error_text" class="text-[9px] font-black text-red-600 uppercase tracking-widest leading-relaxed"></p>
                            </div>
                        </x-card>

                        {{-- Metadata Lanjutan (Otomatis Sembunyi) --}}
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
                                            <input name="speaker" value="{{ old('speaker', $defaults['speaker']) }}" class="w-full px-4 py-2.5 bg-white border border-gray-100 rounded-xl text-xs font-bold text-gray-700 outline-none focus:ring-4 focus:ring-emerald-500/5 focus:border-emerald-500 transition-all">
                                        </div>
                                        <div>
                                            <label class="block text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2">STATUS PUBLIKASI</label>
                                            <select name="is_published" class="w-full px-4 py-2.5 bg-white border border-gray-100 rounded-xl text-xs font-bold text-gray-700 outline-none focus:ring-4 focus:ring-emerald-500/5 focus:border-emerald-500 transition-all appearance-none cursor-pointer">
                                                <option value="1" {{ old('is_published', $defaults['is_published'] ? 1 : 0) == 1 ? 'selected' : '' }}>LIVE / PUBLISHED</option>
                                                <option value="0" {{ old('is_published', $defaults['is_published'] ? 1 : 0) == 0 ? 'selected' : '' }}>DRAFT / OFFLINE</option>
                                            </select>
                                        </div>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2">TARGET HARI</label>
                                                <input type="date" name="monday_date" value="{{ old('monday_date', $defaults['monday_date']) }}" class="w-full px-4 py-2.5 bg-white border border-gray-100 rounded-xl text-xs font-bold text-gray-700 outline-none focus:ring-4 focus:ring-emerald-500/5 transition-all">
                                            </div>
                                            <div>
                                                <label class="block text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2">WIB</label>
                                                <input type="time" name="time_wib" value="{{ old('time_wib', $defaults['time_wib']) }}" class="w-full px-4 py-2.5 bg-white border border-gray-100 rounded-xl text-xs font-bold text-gray-700 outline-none focus:ring-4 focus:ring-emerald-500/5 transition-all">
                                            </div>
                                        </div>
                                    </div>
                                </x-card>
                            </div>
                        </div>

                        {{-- Finalize Button Container --}}
                        <div class="sticky bottom-6">
                            <button type="submit" id="submit_btn" :disabled="uploading" class="w-full py-5 bg-emerald-600 rounded-[2.5rem] font-black text-xs text-white uppercase tracking-[0.3em] shadow-2xl shadow-emerald-200 hover:bg-emerald-700 hover:scale-[1.02] transition-all active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed group">
                                <div class="flex items-center justify-center gap-3">
                                    <svg x-show="!uploading" class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                                    <svg x-show="uploading" class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    <span x-text="uploading ? 'TRANSMISI BERJALAN...' : 'TERBITKAN JURNAL'">TERBITKAN JURNAL</span>
                                </div>
                            </button>

                            <p class="text-center text-[9px] font-black text-gray-300 uppercase tracking-widest mt-4">PASTIKAN SELURUH SUBSTANSI TELAH TERVERIFIKASI</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

@push('scripts')
    <script>
        // Alpine.js Logic for Upload Feedback
        function selasananUploadForm() {
            return {
                showUploadPanel: false,
                panelExpanded: true,
                uploading: false,
                isPaused: false,
                uploadStatus: 'uploading',
                progress: 0,
                progressText: 'Mempersiapkan...',
                uploadSpeed: '-',
                fileName: '',
                errorMessage: '',
                xhr: null,
                formData: null,
                lastLoaded: 0,
                lastTime: 0,

                submitForm() {
                    document.querySelector('#isi_hidden').value = quill.root.innerHTML;
                    this.fileName = document.querySelector('input[name="title"]').value || 'DEKLARASI JURNAL';
                    this.formData = new FormData(this.$refs.selasananForm);
                    this.startUpload();
                },

                startUpload() {
                    this.uploading = true;
                    this.isPaused = false;
                    this.uploadStatus = 'uploading';
                    this.progress = 0;
                    this.showUploadPanel = true;
                    this.panelExpanded = true;
                    this.lastTime = Date.now();

                    this.xhr = new XMLHttpRequest();
                    this.xhr.upload.addEventListener('progress', (e) => {
                        if (e.lengthComputable && !this.isPaused) {
                            const now = Date.now();
                            const timeDiff = (now - this.lastTime) / 1000;
                            if (timeDiff > 0.5) {
                                const speed = (e.loaded - this.lastLoaded) / timeDiff;
                                this.uploadSpeed = speed > 1024*1024 ? (speed/1024/1024).toFixed(1) + ' MB/S' : (speed/1024).toFixed(0) + ' KB/S';
                                this.lastLoaded = e.loaded;
                                this.lastTime = now;
                            }
                            this.progress = Math.round((e.loaded / e.total) * 100);
                            this.progressText = `${(e.loaded/1024/1024).toFixed(1)}MB / ${(e.total/1024/1024).toFixed(1)}MB`;
                        }
                    });

                    this.xhr.onload = () => {
                        this.uploading = false;
                        if (this.xhr.status >= 200 && this.xhr.status < 300) {
                            this.uploadStatus = 'success';
                            setTimeout(() => { window.location.href = "{{ route('manage.selasanan.index') }}"; }, 1500);
                        } else {
                            this.uploadStatus = 'error';
                            try { this.errorMessage = JSON.parse(this.xhr.responseText).message || 'KENDALA SERVER'; } catch(e) { this.errorMessage = 'KENDALA TEKNIS'; }
                        }
                    };

                    this.xhr.open('POST', this.$refs.selasananForm.action);
                    this.xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
                    this.xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                    this.xhr.setRequestHeader('Accept', 'application/json');
                    this.xhr.send(this.formData);
                },

                togglePause() { this.isPaused = !this.isPaused; this.uploadSpeed = this.isPaused ? 'TERTUNDA' : '-'; },
                cancelUpload() { if(this.xhr) this.xhr.abort(); this.uploading = false; this.uploadStatus = 'cancelled'; },
                retryUpload() { if(this.formData) this.startUpload(); }
            }
        }

        // Quill Initialization
        var quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Mulai menulis catatan literasi...',
            modules: { toolbar: [[{'header': [1, 2, 3, false]}], ['bold', 'italic', 'underline', 'blockquote'], [{'list': 'ordered'}, {'list': 'bullet'}], ['link', 'image', 'code-block'], ['clean']] }
        });

        // File Selection System
        const handleDragDrop = (areaId, inputId, previewId, imgId, nameId, sizeId, loadingId, errorId, errorTextId, isAudio = false) => {
            const area = document.getElementById(areaId);
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            const loading = document.getElementById(loadingId);
            const error = document.getElementById(errorId);
            const errorTextName = document.getElementById(errorTextId);

            input.onchange = (e) => {
                const file = e.target.files[0];
                if (!file) return;

                error.classList.add('hidden');
                area.classList.add('hidden');
                loading.classList.remove('hidden');

                const reader = new FileReader();
                reader.onload = (ev) => {
                    if(!isAudio) document.getElementById(imgId).src = ev.target.result;
                    else {
                        const player = document.getElementById('audio_preview_player');
                        player.src = ev.target.result;
                        player.load();
                    }
                    document.getElementById(nameId).textContent = file.name;
                    document.getElementById(sizeId).textContent = (file.size/1024/1024).toFixed(2) + ' MB';
                    loading.classList.add('hidden');
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            };

            const removeBtn = isAudio ? document.getElementById('audio_remove_btn') : document.getElementById('cover_remove_btn');
            removeBtn.onclick = () => {
                input.value = '';
                preview.classList.add('hidden');
                area.classList.remove('hidden');
            };
        };

        handleDragDrop('cover_upload_area', 'cover_image_input', 'cover_preview_area', 'cover_preview_img', 'cover_file_name', 'cover_file_size', 'cover_loading_area', 'cover_error_area', 'cover_error_text');
        handleDragDrop('audio_upload_area', 'audio_file_input', 'audio_preview_area', null, 'audio_file_name', 'audio_file_size', 'audio_loading_area', 'audio_error_area', 'audio_error_text', true);

    </script>
    <style>
        @keyframes scaleIn { 0% { opacity: 0; transform: scale(0.95) translateY(10px); } 100% { opacity: 1; transform: scale(1) translateY(0); } }
        .animate-scaleIn { animation: scaleIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
        .ql-container.ql-snow { border: none !important; font-family: 'Inter', sans-serif !important; font-size: 14px !important; }
        .ql-toolbar.ql-snow { border: none !important; border-bottom: 1px solid #f3f4f6 !important; padding: 12px 20px !important; background: #fafafa !important; }
        .ql-editor { padding: 32px !important; min-height: 400px !important; color: #1f2937 !important; line-height: 1.8 !important; }
        .ql-editor.ql-blank::before { color: #9ca3af !important; font-style: normal !important; font-weight: 500 !important; }
    </style>
@endpush
