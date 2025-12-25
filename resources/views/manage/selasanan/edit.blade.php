@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Selasanan') }}
    </h2>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Header dengan tombol kembali --}}
    <div class="rounded-[24px] bg-gradient-to-r from-emerald-600 to-emerald-500 text-white shadow-lg shadow-emerald-900/30 px-6 py-5 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold">Edit Selasanan</h1>
                <p class="text-emerald-50/90 text-sm mt-1">{{ $entry->title }}</p>
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
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form id="selasanan-form" action="{{ route('manage.selasanan.update', $entry->id) }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-2xl shadow border border-gray-100 p-5 space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Jurnal (SEO)</label>
            <input name="title" value="{{ old('title', $entry->title) }}" required
                   class="w-full px-4 py-3 rounded-xl border border-gray-200" />
            <p class="text-xs text-gray-500 mt-1">Slug akan ikut menyesuaikan otomatis (dengan tanggal Senin).</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Kegiatan</label>
                @if($entry->cover_image_path)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $entry->cover_image_path) }}" class="h-32 w-full object-cover rounded-xl border">
                    </div>
                    <label class="inline-flex items-center gap-2 text-sm text-red-700">
                        <input type="checkbox" name="remove_cover" value="1">
                        Hapus foto
                    </label>
                @endif
                <input type="file" name="cover_image" accept="image/*"
                       class="mt-2 w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100" />
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Rekaman Audio</label>
                @if($entry->audio_path)
                    <div class="mb-2">
                        <audio controls class="w-full">
                            <source src="{{ asset('storage/' . $entry->audio_path) }}" type="{{ $entry->audio_mime ?? 'audio/mpeg' }}">
                        </audio>
                        <div class="mt-2">
                            <a class="text-sm font-semibold text-emerald-700 hover:underline"
                               href="{{ route('selasanan.download', $entry->slug) }}">
                                Download audio
                            </a>
                        </div>
                    </div>
                    <label class="inline-flex items-center gap-2 text-sm text-red-700">
                        <input type="checkbox" name="remove_audio" value="1">
                        Hapus audio
                    </label>
                @endif
                <input type="file" name="audio_file" accept="audio/*"
                       class="mt-2 w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100" />
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Jurnal</label>
            <input type="hidden" name="isi" id="isi_hidden" value="{{ old('isi', $entry->isi) }}">
            <div id="editor" class="bg-white">{!! old('isi', $entry->isi) !!}</div>
        </div>

        <div class="border-t pt-4">
            <button type="button" id="toggle-advanced"
                    class="text-sm font-semibold text-emerald-700 hover:underline">
                Lebih Lanjut (opsional) ▾
            </button>

            <div id="advanced-box" class="hidden mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pembicara</label>
                    <input name="speaker" value="{{ old('speaker', $entry->speaker) }}"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200" />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Publish</label>
                    <select name="is_published" class="w-full px-4 py-3 rounded-xl border border-gray-200">
                        <option value="1" {{ old('is_published', $entry->is_published ? 1 : 0) == 1 ? 'selected' : '' }}>Publish</option>
                        <option value="0" {{ old('is_published', $entry->is_published ? 1 : 0) == 0 ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal (Senin)</label>
                    <input type="date" name="monday_date" value="{{ old('monday_date', $entry->monday_date->toDateString()) }}"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200" />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jam (WIB)</label>
                    <input type="time" name="time_wib" value="{{ old('time_wib', substr($entry->time_wib,0,5)) }}"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200" />
                </div>

                <div class="md:col-span-2">
                    <p class="text-xs text-gray-500">
                        Info otomatis: {{ \Carbon\Carbon::create($entry->year, $entry->month, 1)->locale('id')->translatedFormat('F Y') }},
                        Minggu ke-{{ $entry->week_of_month }} • Slug: <span class="font-mono">{{ $entry->slug }}</span>
                    </p>
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
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
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

    document.querySelector('#selasanan-form').addEventListener('submit', function () {
        document.querySelector('#isi_hidden').value = quill.root.innerHTML;
    });

    const btn = document.getElementById('toggle-advanced');
    const box = document.getElementById('advanced-box');
    btn.addEventListener('click', function () {
        box.classList.toggle('hidden');
        btn.textContent = box.classList.contains('hidden') ? 'Lebih Lanjut (opsional) ▾' : 'Lebih Lanjut (opsional) ▴';
    });
</script>
@endpush
