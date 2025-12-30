@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Buat Selasanan') }}
    </h2>
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="selasananUploadForm()" x-cloak>
        {{-- Header dengan tombol kembali --}}
        <div
            class="rounded-[24px] bg-gradient-to-r from-emerald-600 to-emerald-500 text-white shadow-lg shadow-emerald-900/30 px-6 py-5 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold">Buat Selasanan</h1>
                    <p class="text-emerald-50/90 text-sm mt-1">Input cepat: Judul, Foto, Audio, Isi. Lainnya otomatis.</p>
                </div>
                <a href="{{ route('manage.selasanan.index') }}"
                    class="px-4 py-2 rounded-xl bg-white text-emerald-700 font-semibold shadow hover:bg-emerald-50">
                    Kembali
                </a>
            </div>
        </div>

        {{-- Floating Upload Panel (Google Drive Style) --}}
        <div x-show="showUploadPanel" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            class="fixed bottom-4 right-4 z-50 w-80 bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden"
            style="display: none;">

            {{-- Header Panel --}}
            <div class="bg-gradient-to-r from-[#008362] to-emerald-600 px-4 py-3 flex items-center justify-between cursor-pointer"
                @click="panelExpanded = !panelExpanded">
                <div class="flex items-center gap-2 text-white">
                    <svg class="w-5 h-5" :class="{ 'animate-bounce': uploading && !isPaused }" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    <span class="font-semibold text-sm">
                        <template x-if="uploadStatus === 'uploading'">
                            <span>Mengunggah<span x-show="isPaused"> (Dijeda)</span></span>
                        </template>
                        <template x-if="uploadStatus === 'success'">
                            <span>Upload Selesai!</span>
                        </template>
                        <template x-if="uploadStatus === 'error'">
                            <span>Upload Gagal</span>
                        </template>
                        <template x-if="uploadStatus === 'cancelled'">
                            <span>Upload Dibatalkan</span>
                        </template>
                    </span>
                </div>
                <div class="flex items-center gap-1">
                    {{-- Minimize/Expand Button --}}
                    <button type="button" class="p-1.5 hover:bg-white/20 rounded-lg transition-colors"
                        @click.stop="panelExpanded = !panelExpanded">
                        <svg class="w-4 h-4 text-white transition-transform duration-200"
                            :class="{ 'rotate-180': !panelExpanded }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    {{-- Close Button (only when not uploading or completed) --}}
                    <button
                        x-show="!uploading || uploadStatus === 'success' || uploadStatus === 'error' || uploadStatus === 'cancelled'"
                        type="button" class="p-1.5 hover:bg-white/20 rounded-lg transition-colors"
                        @click.stop="closePanel()">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Panel Content --}}
            <div x-show="panelExpanded" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-2" class="p-4">
                {{-- File Info --}}
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-800 truncate" x-text="fileName || 'Selasanan Entry'"></p>
                        <p class="text-xs text-gray-500" x-text="progressText"></p>
                    </div>
                </div>

                {{-- Progress Bar --}}
                <div class="mb-3">
                    <div class="flex justify-between text-xs text-gray-600 mb-1">
                        <span x-text="progress + '%'">0%</span>
                        <span x-text="uploadSpeed">-</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-300 ease-out"
                            :class="{
                                'bg-gradient-to-r from-[#008362] to-emerald-500': uploadStatus === 'uploading' && !
                                    isPaused,
                                'bg-amber-500': isPaused,
                                'bg-emerald-500': uploadStatus === 'success',
                                'bg-red-500': uploadStatus === 'error' || uploadStatus === 'cancelled'
                            }"
                            :style="'width: ' + progress + '%'"></div>
                    </div>
                </div>

                {{-- Status Message --}}
                <div x-show="uploadStatus === 'success'" class="flex items-center gap-2 text-emerald-600 text-sm mb-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Berhasil! Mengalihkan ke halaman daftar...</span>
                </div>

                <div x-show="uploadStatus === 'error'" class="flex items-center gap-2 text-red-600 text-sm mb-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="truncate" x-text="errorMessage">Terjadi kesalahan</span>
                </div>

                <div x-show="uploadStatus === 'cancelled'" class="flex items-center gap-2 text-gray-600 text-sm mb-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                        </path>
                    </svg>
                    <span>Upload dibatalkan oleh pengguna</span>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center gap-2" x-show="uploading && uploadStatus === 'uploading'">
                    {{-- Pause/Resume Button --}}
                    <button type="button" @click="togglePause()"
                        class="flex-1 flex items-center justify-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors"
                        :class="isPaused ? 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200' :
                            'bg-amber-100 text-amber-700 hover:bg-amber-200'">
                        <template x-if="isPaused">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"></path>
                            </svg>
                        </template>
                        <template x-if="!isPaused">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"></path>
                            </svg>
                        </template>
                        <span x-text="isPaused ? 'Lanjutkan' : 'Jeda'"></span>
                    </button>

                    {{-- Cancel Button --}}
                    <button type="button" @click="cancelUpload()"
                        class="flex-1 flex items-center justify-center gap-2 px-3 py-2 rounded-lg text-sm font-medium bg-red-100 text-red-700 hover:bg-red-200 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span>Batalkan</span>
                    </button>
                </div>

                {{-- Retry Button (on error) --}}
                <div x-show="uploadStatus === 'error'" class="flex gap-2">
                    <button type="button" @click="retryUpload()"
                        class="flex-1 flex items-center justify-center gap-2 px-3 py-2 rounded-lg text-sm font-medium bg-emerald-100 text-emerald-700 hover:bg-emerald-200 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        <span>Coba Lagi</span>
                    </button>
                </div>
            </div>
        </div>


        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-2xl p-4 mb-4">
                <p class="font-semibold text-red-700">Terjadi kesalahan:</p>
                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form x-ref="selasananForm" @submit.prevent="submitForm" id="selasanan-form"
            action="{{ route('manage.selasanan.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-2xl shadow border border-gray-100 p-5 space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Jurnal (SEO)</label>
                <input name="title" value="{{ old('title') }}" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200"
                    placeholder="Contoh: Menjaga Hati di Tengah Kesibukan" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Foto Kegiatan --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Kegiatan</label>

                    {{-- Upload Area (shown when no file selected) --}}
                    <div id="cover_upload_area">
                        <label for="cover_image_input"
                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-emerald-50 hover:border-emerald-300 transition-all duration-200">
                            <div class="flex flex-col items-center justify-center py-4">
                                <svg class="w-8 h-8 mb-2 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <p class="text-sm text-gray-500"><span class="font-semibold text-emerald-600">Klik untuk
                                        upload</span></p>
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG, GIF, WebP (Max 10MB)</p>
                            </div>
                        </label>
                        <input type="file" name="cover_image" id="cover_image_input" accept="image/*"
                            class="hidden" />
                    </div>

                    {{-- Loading State --}}
                    <div id="cover_loading_area" class="hidden">
                        <div
                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-emerald-200 rounded-xl bg-emerald-50">
                            <svg class="animate-spin h-8 w-8 text-emerald-600 mb-2" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <p class="text-sm text-emerald-600 font-medium">Memuat preview...</p>
                        </div>
                    </div>

                    {{-- Preview Area (shown when file selected) --}}
                    <div id="cover_preview_area" class="hidden">
                        <div class="relative border-2 border-emerald-200 rounded-xl overflow-hidden bg-gray-100">
                            <img id="cover_preview_img" class="w-full h-40 object-cover" src=""
                                alt="Preview" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-3 flex items-center justify-between">
                                <div class="text-white">
                                    <p id="cover_file_name" class="text-sm font-medium truncate max-w-[180px]"></p>
                                    <p id="cover_file_size" class="text-xs opacity-80"></p>
                                </div>
                                <button type="button" id="cover_remove_btn"
                                    class="p-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors shadow-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Error Message --}}
                    <div id="cover_error_area" class="hidden mt-2">
                        <div
                            class="flex items-center gap-2 text-sm rounded-lg p-3 bg-red-50 border border-red-200 text-red-700">
                            <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <p id="cover_error_text" class="flex-1 text-sm"></p>
                        </div>
                    </div>
                </div>

                {{-- Rekaman Audio --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Rekaman Audio</label>

                    {{-- Upload Area (shown when no file selected) --}}
                    <div id="audio_upload_area">
                        <label for="audio_file_input"
                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-emerald-50 hover:border-emerald-300 transition-all duration-200">
                            <div class="flex flex-col items-center justify-center py-4">
                                <svg class="w-8 h-8 mb-2 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                    </path>
                                </svg>
                                <p class="text-sm text-gray-500"><span class="font-semibold text-emerald-600">Klik untuk
                                        upload</span></p>
                                <p class="text-xs text-gray-400 mt-1">MP3, M4A, WAV, OGG (Max 200MB)</p>
                            </div>
                        </label>
                        <input type="file" name="audio_file" id="audio_file_input"
                            accept="audio/mpeg,audio/mp4,audio/x-m4a,audio/wav,audio/ogg,.mp3,.m4a,.wav,.ogg"
                            class="hidden" />
                    </div>

                    {{-- Loading State --}}
                    <div id="audio_loading_area" class="hidden">
                        <div
                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-emerald-200 rounded-xl bg-emerald-50">
                            <svg class="animate-spin h-8 w-8 text-emerald-600 mb-2" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <p class="text-sm text-emerald-600 font-medium">Memuat audio...</p>
                        </div>
                    </div>

                    {{-- Preview Area (shown when file selected) --}}
                    <div id="audio_preview_area" class="hidden">
                        <div
                            class="border-2 border-emerald-200 rounded-xl overflow-hidden bg-gradient-to-br from-emerald-50 to-teal-50 p-4">
                            <div class="flex items-center gap-3 mb-3">
                                <div
                                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                        </path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p id="audio_file_name" class="text-sm font-semibold text-gray-800 truncate"></p>
                                    <p id="audio_file_size" class="text-xs text-gray-500"></p>
                                </div>
                                <button type="button" id="audio_remove_btn"
                                    class="p-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <audio id="audio_preview_player" controls class="w-full h-10 rounded-lg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>

                    {{-- Error Message --}}
                    <div id="audio_error_area" class="hidden mt-2">
                        <div
                            class="flex items-center gap-2 text-sm rounded-lg p-3 bg-red-50 border border-red-200 text-red-700">
                            <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <p id="audio_error_text" class="flex-1 text-sm"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Jurnal</label>
                <input type="hidden" name="isi" id="isi_hidden" value="{{ old('isi') }}">
                <div id="editor" class="bg-white">{!! old('isi') !!}</div>
            </div>

            <div class="border-t pt-4">
                <button type="button" id="toggle-advanced"
                    class="text-sm font-semibold text-emerald-700 hover:underline">
                    Lebih Lanjut (opsional) ▾
                </button>

                <div id="advanced-box" class="hidden mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pembicara</label>
                        <input name="speaker" value="{{ old('speaker', $defaults['speaker']) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200" />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Publish</label>
                        <select name="is_published" class="w-full px-4 py-3 rounded-xl border border-gray-200">
                            <option value="1"
                                {{ old('is_published', $defaults['is_published'] ? 1 : 0) == 1 ? 'selected' : '' }}>Publish
                            </option>
                            <option value="0"
                                {{ old('is_published', $defaults['is_published'] ? 1 : 0) == 0 ? 'selected' : '' }}>Draft
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal (Senin)</label>
                        <input type="date" name="monday_date"
                            value="{{ old('monday_date', $defaults['monday_date']) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200" />
                        <p class="text-xs text-gray-500 mt-1">Kalau diisi bukan Senin, sistem akan set ke Senin minggu
                            tersebut.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jam (WIB)</label>
                        <input type="time" name="time_wib" value="{{ old('time_wib', $defaults['time_wib']) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200" />
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4 border-t">
                <a href="{{ route('manage.selasanan.index') }}"
                    class="px-5 py-3 rounded-xl border border-gray-200 text-gray-700 font-semibold">
                    Batal
                </a>
                <button type="submit" id="submit_btn" :disabled="uploading"
                    class="px-6 py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold hover:from-emerald-700 hover:to-teal-700 shadow-lg shadow-emerald-500/30 flex items-center gap-2 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg x-show="!uploading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    <svg x-show="uploading" class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span x-text="uploading ? 'Mengunggah...' : 'Posting'">Posting</span>
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Alpine.js Upload Form Function
        function selasananUploadForm() {
            return {
                // Panel state
                showUploadPanel: false,
                panelExpanded: true,

                // Upload state
                uploading: false,
                isPaused: false,
                uploadStatus: 'uploading', // 'uploading', 'success', 'error', 'cancelled'

                // Progress data
                progress: 0,
                progressText: 'Mempersiapkan...',
                uploadSpeed: '-',
                fileName: '',
                errorMessage: '',

                // Internal tracking
                xhr: null,
                formData: null,
                lastLoaded: 0,
                lastTime: 0,
                speedInterval: null,

                submitForm() {
                    // Get Quill content and set to hidden input
                    document.querySelector('#isi_hidden').value = quill.root.innerHTML;

                    // Get title for file name display
                    const titleInput = document.querySelector('input[name="title"]');
                    this.fileName = titleInput ? (titleInput.value || 'Selasanan Entry') : 'Selasanan Entry';

                    // Store formData for retry
                    this.formData = new FormData(this.$refs.selasananForm);

                    // Start upload
                    this.startUpload();
                },

                startUpload() {
                    // Reset state
                    this.uploading = true;
                    this.isPaused = false;
                    this.uploadStatus = 'uploading';
                    this.progress = 0;
                    this.progressText = 'Mempersiapkan...';
                    this.uploadSpeed = '-';
                    this.errorMessage = '';
                    this.lastLoaded = 0;
                    this.lastTime = Date.now();

                    // Show panel
                    this.showUploadPanel = true;
                    this.panelExpanded = true;

                    // Create XHR
                    this.xhr = new XMLHttpRequest();

                    // Speed calculation interval
                    this.speedInterval = setInterval(() => {
                        if (!this.isPaused && this.uploading) {
                            // Speed is calculated via progress event
                        }
                    }, 1000);

                    // Progress event handler
                    this.xhr.upload.addEventListener('progress', (e) => {
                        if (e.lengthComputable && !this.isPaused) {
                            const now = Date.now();
                            const timeDiff = (now - this.lastTime) / 1000; // seconds
                            const loadedDiff = e.loaded - this.lastLoaded;

                            // Calculate speed (bytes per second)
                            if (timeDiff > 0.5) {
                                const speed = loadedDiff / timeDiff;
                                if (speed > 0) {
                                    if (speed > 1024 * 1024) {
                                        this.uploadSpeed = (speed / 1024 / 1024).toFixed(1) + ' MB/s';
                                    } else if (speed > 1024) {
                                        this.uploadSpeed = (speed / 1024).toFixed(0) + ' KB/s';
                                    } else {
                                        this.uploadSpeed = speed.toFixed(0) + ' B/s';
                                    }
                                }
                                this.lastLoaded = e.loaded;
                                this.lastTime = now;
                            }

                            this.progress = Math.round((e.loaded / e.total) * 100);
                            const loadedMB = (e.loaded / 1024 / 1024).toFixed(2);
                            const totalMB = (e.total / 1024 / 1024).toFixed(2);
                            this.progressText = `${loadedMB} MB / ${totalMB} MB`;
                        }
                    });

                    // Load complete handler
                    this.xhr.onload = () => {
                        clearInterval(this.speedInterval);
                        this.uploading = false;

                        if (this.xhr.status >= 200 && this.xhr.status < 300) {
                            this.uploadStatus = 'success';
                            this.progress = 100;
                            this.progressText = 'Upload selesai!';
                            this.uploadSpeed = '-';

                            // Redirect after short delay
                            setTimeout(() => {
                                window.location.href = "{{ route('manage.selasanan.index') }}";
                            }, 1500);
                        } else {
                            this.uploadStatus = 'error';
                            try {
                                let errorData = JSON.parse(this.xhr.responseText);
                                if (errorData.errors) {
                                    this.errorMessage = Object.values(errorData.errors).flat().join(' ');
                                } else {
                                    this.errorMessage = errorData.message || 'Terjadi kesalahan server.';
                                }
                            } catch (e) {
                                this.errorMessage = 'Terjadi kesalahan yang tidak diketahui.';
                            }
                        }
                    };

                    // Error handler
                    this.xhr.onerror = () => {
                        clearInterval(this.speedInterval);
                        this.uploading = false;
                        this.uploadStatus = 'error';
                        this.errorMessage = 'Upload gagal. Periksa koneksi internet Anda.';
                    };

                    // Abort handler
                    this.xhr.onabort = () => {
                        clearInterval(this.speedInterval);
                        this.uploading = false;
                        this.uploadStatus = 'cancelled';
                    };

                    // Start request
                    this.xhr.open('POST', this.$refs.selasananForm.action);
                    this.xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'));
                    this.xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                    this.xhr.setRequestHeader('Accept', 'application/json');
                    this.xhr.send(this.formData);
                },

                togglePause() {
                    // Note: Standard XHR doesn't support true pause/resume
                    // We simulate it by showing paused state
                    // For true pause/resume, you'd need chunked uploads
                    this.isPaused = !this.isPaused;

                    if (this.isPaused) {
                        this.uploadSpeed = 'Dijeda';
                    }

                    // Show notification
                    if (this.isPaused) {
                        // Note: XHR cannot truly pause, this is a visual indicator
                        // In production, you'd implement chunked upload for real pause/resume
                    }
                },

                cancelUpload() {
                    if (this.xhr) {
                        this.xhr.abort();
                    }
                    clearInterval(this.speedInterval);
                    this.uploading = false;
                    this.uploadStatus = 'cancelled';
                    this.uploadSpeed = '-';
                },

                retryUpload() {
                    if (this.formData) {
                        this.startUpload();
                    }
                },

                closePanel() {
                    this.showUploadPanel = false;

                    // Reset state after animation
                    setTimeout(() => {
                        if (!this.showUploadPanel) {
                            this.progress = 0;
                            this.progressText = 'Mempersiapkan...';
                            this.uploadSpeed = '-';
                            this.errorMessage = '';
                            this.uploadStatus = 'uploading';
                        }
                    }, 300);
                }
            }
        }

        // Quill (same pattern as artikel)
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{
                        'header': [1, 2, 3, false]
                    }],
                    ['bold', 'italic', 'underline', 'blockquote'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    ['link', 'image', 'code-block'],
                    ['clean']
                ]
            }
        });

        // Toggle advanced
        const btn = document.getElementById('toggle-advanced');
        const box = document.getElementById('advanced-box');
        btn.addEventListener('click', function() {
            box.classList.toggle('hidden');
            btn.textContent = box.classList.contains('hidden') ? 'Lebih Lanjut (opsional) ▾' :
                'Lebih Lanjut (opsional) ▴';
        });

        // File Upload with Preview System
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // =====================
        // COVER IMAGE HANDLING
        // =====================
        const coverInput = document.getElementById('cover_image_input');
        const coverUploadArea = document.getElementById('cover_upload_area');
        const coverLoadingArea = document.getElementById('cover_loading_area');
        const coverPreviewArea = document.getElementById('cover_preview_area');
        const coverPreviewImg = document.getElementById('cover_preview_img');
        const coverFileName = document.getElementById('cover_file_name');
        const coverFileSize = document.getElementById('cover_file_size');
        const coverRemoveBtn = document.getElementById('cover_remove_btn');
        const coverErrorArea = document.getElementById('cover_error_area');
        const coverErrorText = document.getElementById('cover_error_text');

        const maxImageSize = 10 * 1024 * 1024; // 10MB
        const allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];

        function showCoverError(message) {
            coverErrorArea.classList.remove('hidden');
            coverErrorText.textContent = message;
        }

        function hideCoverError() {
            coverErrorArea.classList.add('hidden');
        }

        function resetCoverUpload() {
            coverInput.value = '';
            coverPreviewImg.src = '';
            coverUploadArea.classList.remove('hidden');
            coverLoadingArea.classList.add('hidden');
            coverPreviewArea.classList.add('hidden');
            hideCoverError();
        }

        coverInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            hideCoverError();

            if (!file) {
                resetCoverUpload();
                return;
            }

            // Validate file type
            if (!allowedImageTypes.includes(file.type)) {
                showCoverError(
                    `Tipe file tidak didukung: ${file.type || 'unknown'}. Gunakan JPG, PNG, GIF, atau WebP.`);
                resetCoverUpload();
                return;
            }

            // Validate file size
            if (file.size > maxImageSize) {
                showCoverError(`Ukuran file terlalu besar: ${formatFileSize(file.size)}. Maksimal 10MB.`);
                resetCoverUpload();
                return;
            }

            // Show loading state
            coverUploadArea.classList.add('hidden');
            coverLoadingArea.classList.remove('hidden');
            coverPreviewArea.classList.add('hidden');

            // Read file for preview
            const reader = new FileReader();

            reader.onload = function(event) {
                // Set preview image
                coverPreviewImg.src = event.target.result;
                coverFileName.textContent = file.name;
                coverFileSize.textContent = formatFileSize(file.size);

                // Show preview area
                coverLoadingArea.classList.add('hidden');
                coverPreviewArea.classList.remove('hidden');
            };

            reader.onerror = function() {
                showCoverError('Gagal membaca file. Coba lagi.');
                resetCoverUpload();
            };

            reader.readAsDataURL(file);
        });

        // Remove button for cover image
        coverRemoveBtn.addEventListener('click', function() {
            resetCoverUpload();
        });

        // =====================
        // AUDIO FILE HANDLING
        // =====================
        const audioInput = document.getElementById('audio_file_input');
        const audioUploadArea = document.getElementById('audio_upload_area');
        const audioLoadingArea = document.getElementById('audio_loading_area');
        const audioPreviewArea = document.getElementById('audio_preview_area');
        const audioPlayer = document.getElementById('audio_preview_player');
        const audioFileName = document.getElementById('audio_file_name');
        const audioFileSize = document.getElementById('audio_file_size');
        const audioRemoveBtn = document.getElementById('audio_remove_btn');
        const audioErrorArea = document.getElementById('audio_error_area');
        const audioErrorText = document.getElementById('audio_error_text');

        const maxAudioSize = 200 * 1024 * 1024; // 200MB
        const allowedAudioExtensions = ['.mp3', '.m4a', '.wav', '.ogg'];

        function showAudioError(message) {
            audioErrorArea.classList.remove('hidden');
            audioErrorText.textContent = message;
        }

        function hideAudioError() {
            audioErrorArea.classList.add('hidden');
        }

        function resetAudioUpload() {
            audioInput.value = '';
            audioPlayer.src = '';
            audioPlayer.pause();
            audioUploadArea.classList.remove('hidden');
            audioLoadingArea.classList.add('hidden');
            audioPreviewArea.classList.add('hidden');
            hideAudioError();
        }

        audioInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            hideAudioError();

            if (!file) {
                resetAudioUpload();
                return;
            }

            // Check by extension (more reliable for audio)
            const fileName = file.name.toLowerCase();
            const hasValidExtension = allowedAudioExtensions.some(ext => fileName.endsWith(ext));

            // Validate file type
            if (!hasValidExtension) {
                showAudioError(`Tipe file tidak didukung. Gunakan MP3, M4A, WAV, atau OGG.`);
                resetAudioUpload();
                return;
            }

            // Validate file size
            if (file.size > maxAudioSize) {
                showAudioError(`Ukuran file terlalu besar: ${formatFileSize(file.size)}. Maksimal 200MB.`);
                resetAudioUpload();
                return;
            }

            // Show loading state
            audioUploadArea.classList.add('hidden');
            audioLoadingArea.classList.remove('hidden');
            audioPreviewArea.classList.add('hidden');

            // Create object URL for audio preview (faster than FileReader for audio)
            const audioURL = URL.createObjectURL(file);

            // Set up audio player
            audioPlayer.src = audioURL;
            audioFileName.textContent = file.name;
            audioFileSize.textContent = formatFileSize(file.size);

            // Wait for audio to be loadable
            audioPlayer.oncanplaythrough = function() {
                audioLoadingArea.classList.add('hidden');
                audioPreviewArea.classList.remove('hidden');
            };

            audioPlayer.onerror = function() {
                showAudioError('Gagal memuat audio. Pastikan file tidak rusak.');
                resetAudioUpload();
                URL.revokeObjectURL(audioURL);
            };

            // Fallback - show preview after short delay if canplaythrough doesn't fire
            setTimeout(function() {
                if (!audioPreviewArea.classList.contains('hidden')) return;
                audioLoadingArea.classList.add('hidden');
                audioPreviewArea.classList.remove('hidden');
            }, 1500);
        });

        // Remove button for audio
        audioRemoveBtn.addEventListener('click', function() {
            // Revoke object URL to free memory
            if (audioPlayer.src && audioPlayer.src.startsWith('blob:')) {
                URL.revokeObjectURL(audioPlayer.src);
            }
            resetAudioUpload();
        });
    </script>
@endpush
