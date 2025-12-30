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

        {{-- Overlay Loading Upload --}}
        <div x-show="uploading" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-[#008362] bg-opacity-75 flex items-center justify-center z-50" style="display: none;">
            <div class="flex flex-col items-center text-center bg-white p-8 rounded-2xl shadow-2xl max-w-sm mx-4">
                {{-- Circular Progress Spinner --}}
                <div class="relative mb-4">
                    <svg class="w-20 h-20" viewBox="0 0 100 100">
                        {{-- Background circle --}}
                        <circle class="text-gray-200 stroke-current" stroke-width="8" cx="50" cy="50" r="40"
                            fill="none"></circle>
                        {{-- Progress circle --}}
                        <circle class="text-[#008362] stroke-current transition-all duration-300 ease-out" stroke-width="8"
                            stroke-linecap="round" cx="50" cy="50" r="40" fill="none"
                            :stroke-dasharray="`${progress * 2.51} 251`" transform="rotate(-90 50 50)"></circle>
                    </svg>
                    {{-- Percentage inside circle --}}
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-lg font-bold text-[#008362]" x-text="progress + '%'">0%</span>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Mengunggah File...</h3>
                <p class="text-gray-500 mt-2 text-sm" x-text="progressText">Mempersiapkan...</p>
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
                        <input type="file" name="cover_image" id="cover_image_input" accept="image/*" class="hidden" />
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
                            <img id="cover_preview_img" class="w-full h-40 object-cover" src="" alt="Preview" />
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
                uploading: false,
                progress: 0,
                progressText: 'Mempersiapkan...',
                errorMessage: '',

                submitForm() {
                    // Get Quill content and set to hidden input
                    document.querySelector('#isi_hidden').value = quill.root.innerHTML;

                    this.uploading = true;
                    this.progress = 0;
                    this.progressText = 'Mempersiapkan...';
                    this.errorMessage = '';

                    const formData = new FormData(this.$refs.selasananForm);
                    const xhr = new XMLHttpRequest();

                    // Progress event handler
                    xhr.upload.addEventListener('progress', (e) => {
                        if (e.lengthComputable) {
                            this.progress = Math.round((e.loaded / e.total) * 100);
                            const loadedMB = (e.loaded / 1024 / 1024).toFixed(2);
                            const totalMB = (e.total / 1024 / 1024).toFixed(2);
                            this.progressText = `(${loadedMB} MB / ${totalMB} MB)`;
                        }
                    });

                    // Load complete handler
                    xhr.onload = () => {
                        this.uploading = false;
                        if (xhr.status >= 200 && xhr.status < 300) {
                            // Redirect to index page on success
                            window.location.href = "{{ route('manage.selasanan.index') }}";
                        } else {
                            try {
                                let errorData = JSON.parse(xhr.responseText);
                                if (errorData.errors) {
                                    this.errorMessage = Object.values(errorData.errors).flat().join(' ');
                                } else {
                                    this.errorMessage = errorData.message || 'Terjadi kesalahan server.';
                                }
                            } catch (e) {
                                this.errorMessage = 'Terjadi kesalahan yang tidak diketahui.';
                            }
                            // Show error with SweetAlert
                            Swal.fire({
                                title: 'Gagal!',
                                text: this.errorMessage,
                                icon: 'error',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#dc2626'
                            });
                        }
                    };

                    // Error handler
                    xhr.onerror = () => {
                        this.uploading = false;
                        this.errorMessage = 'Upload gagal. Periksa koneksi internet Anda.';
                        Swal.fire({
                            title: 'Gagal!',
                            text: this.errorMessage,
                            icon: 'error',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#dc2626'
                        });
                    };

                    xhr.open('POST', this.$refs.selasananForm.action);
                    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content'));
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                    xhr.setRequestHeader('Accept', 'application/json');
                    xhr.send(formData);
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
