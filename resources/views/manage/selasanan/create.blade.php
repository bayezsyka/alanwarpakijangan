@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Buat Selasanan') }}
    </h2>
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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

        <form id="selasanan-form" action="{{ route('manage.selasanan.store') }}" method="POST"
            enctype="multipart/form-data" class="bg-white rounded-2xl shadow border border-gray-100 p-5 space-y-5">
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
                    <div class="relative">
                        <input type="file" name="cover_image" id="cover_image_input" accept="image/*"
                            class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100" />
                        {{-- Loading Spinner --}}
                        <div id="cover_image_loading" class="hidden absolute right-3 top-1/2 -translate-y-1/2">
                            <svg class="animate-spin h-5 w-5 text-emerald-600" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Opsional. Max 10MB.</p>
                    {{-- Status Message --}}
                    <div id="cover_image_status" class="mt-2 hidden">
                        <div class="flex items-center gap-2 text-sm rounded-lg p-2"></div>
                    </div>
                </div>

                {{-- Rekaman Audio --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Rekaman Audio</label>
                    <div class="relative">
                        <input type="file" name="audio_file" id="audio_file_input"
                            accept="audio/mpeg,audio/mp4,audio/x-m4a,audio/wav,audio/ogg,.mp3,.m4a,.wav,.ogg"
                            class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100" />
                        {{-- Loading Spinner --}}
                        <div id="audio_file_loading" class="hidden absolute right-3 top-1/2 -translate-y-1/2">
                            <svg class="animate-spin h-5 w-5 text-emerald-600" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Opsional. mp3/m4a/wav/ogg. Max 200MB.</p>
                    {{-- Status Message --}}
                    <div id="audio_file_status" class="mt-2 hidden">
                        <div class="flex items-center gap-2 text-sm rounded-lg p-2"></div>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Jurnal</label>
                <input type="hidden" name="isi" id="isi_hidden" value="{{ old('isi') }}">
                <div id="editor" class="bg-white">{!! old('isi') !!}</div>
            </div>

            <div class="border-t pt-4">
                <button type="button" id="toggle-advanced" class="text-sm font-semibold text-emerald-700 hover:underline">
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
                        <input type="date" name="monday_date" value="{{ old('monday_date', $defaults['monday_date']) }}"
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
                <button type="submit"
                    class="px-5 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
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

        document.querySelector('#selasanan-form').addEventListener('submit', function() {
            document.querySelector('#isi_hidden').value = quill.root.innerHTML;
        });

        // Toggle advanced
        const btn = document.getElementById('toggle-advanced');
        const box = document.getElementById('advanced-box');
        btn.addEventListener('click', function() {
            box.classList.toggle('hidden');
            btn.textContent = box.classList.contains('hidden') ? 'Lebih Lanjut (opsional) ▾' :
                'Lebih Lanjut (opsional) ▴';
        });

        // File Upload Validation & Loading Animation
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function showStatus(statusEl, isSuccess, message, fileName = '', fileSize = '') {
            statusEl.classList.remove('hidden');
            const inner = statusEl.querySelector('div');

            if (isSuccess) {
                inner.className =
                    'flex items-center gap-2 text-sm rounded-lg p-3 bg-emerald-50 border border-emerald-200 text-emerald-700';
                inner.innerHTML = `
                <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <div class="flex-1">
                    <p class="font-medium">${message}</p>
                    <p class="text-xs text-emerald-600 mt-0.5">${fileName} (${fileSize})</p>
                </div>
            `;
            } else {
                inner.className =
                    'flex items-center gap-2 text-sm rounded-lg p-3 bg-red-50 border border-red-200 text-red-700';
                inner.innerHTML = `
                <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <div class="flex-1">
                    <p class="font-medium">Gagal!</p>
                    <p class="text-xs text-red-600 mt-0.5">${message}</p>
                </div>
            `;
            }
        }

        function hideStatus(statusEl) {
            statusEl.classList.add('hidden');
        }

        // Cover Image Validation - Real file reading
        const coverInput = document.getElementById('cover_image_input');
        const coverLoading = document.getElementById('cover_image_loading');
        const coverStatus = document.getElementById('cover_image_status');
        const maxImageSize = 10 * 1024 * 1024; // 10MB
        const allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];

        coverInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            hideStatus(coverStatus);

            if (!file) return;

            // Quick validation first
            // Validate file type
            if (!allowedImageTypes.includes(file.type)) {
                showStatus(coverStatus, false,
                    `Tipe file tidak didukung: ${file.type || 'unknown'}. Gunakan JPG, PNG, GIF, atau WebP.`
                );
                e.target.value = '';
                return;
            }

            // Validate file size
            if (file.size > maxImageSize) {
                showStatus(coverStatus, false,
                    `Ukuran file terlalu besar: ${formatFileSize(file.size)}. Maksimal 10MB.`);
                e.target.value = '';
                return;
            }

            // Show loading - real file reading
            coverLoading.classList.remove('hidden');

            // Use FileReader to actually read the file (real loading animation)
            const reader = new FileReader();
            reader.onloadstart = function() {
                coverLoading.classList.remove('hidden');
            };
            reader.onprogress = function(e) {
                // File is being read - loading spinner is visible
            };
            reader.onload = function() {
                coverLoading.classList.add('hidden');
                showStatus(coverStatus, true, 'File siap diupload!', file.name, formatFileSize(file.size));
            };
            reader.onerror = function() {
                coverLoading.classList.add('hidden');
                showStatus(coverStatus, false, 'Gagal membaca file. Coba lagi.');
                e.target.value = '';
            };
            reader.readAsDataURL(file);
        });

        // Audio File Validation - Real file reading
        const audioInput = document.getElementById('audio_file_input');
        const audioLoading = document.getElementById('audio_file_loading');
        const audioStatus = document.getElementById('audio_file_status');
        const maxAudioSize = 200 * 1024 * 1024; // 200MB
        const allowedAudioExtensions = ['.mp3', '.m4a', '.wav', '.ogg', '.mpeg'];

        audioInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            hideStatus(audioStatus);

            if (!file) return;

            // Check by extension (more reliable for audio)
            const fileName = file.name.toLowerCase();
            const hasValidExtension = allowedAudioExtensions.some(ext => fileName.endsWith(ext));

            // Validate file type
            if (!hasValidExtension) {
                showStatus(audioStatus, false,
                    `Tipe file tidak didukung. Gunakan MP3, M4A, WAV, atau OGG.`
                );
                e.target.value = '';
                return;
            }

            // Validate file size
            if (file.size > maxAudioSize) {
                showStatus(audioStatus, false,
                    `Ukuran file terlalu besar: ${formatFileSize(file.size)}. Maksimal 200MB.`);
                e.target.value = '';
                return;
            }

            // Show loading - real file reading
            audioLoading.classList.remove('hidden');

            // Use FileReader to actually read the file (real loading animation)
            const reader = new FileReader();
            reader.onloadstart = function() {
                audioLoading.classList.remove('hidden');
            };
            reader.onprogress = function(e) {
                // File is being read - loading spinner is visible
            };
            reader.onload = function() {
                audioLoading.classList.add('hidden');
                showStatus(audioStatus, true, 'File siap diupload!', file.name, formatFileSize(file.size));
            };
            reader.onerror = function() {
                audioLoading.classList.add('hidden');
                showStatus(audioStatus, false, 'Gagal membaca file. Coba lagi.');
                e.target.value = '';
            };
            reader.readAsArrayBuffer(file); // Use ArrayBuffer for large audio files
        });
    </script>
@endpush
