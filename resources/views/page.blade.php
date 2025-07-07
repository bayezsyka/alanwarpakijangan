@extends('layouts.public')

{{-- Judul halaman akan diambil dari database secara dinamis --}}
@section('title', $page->title . ' - Pesantren Al-Anwar')

@section('content')
<div class="bg-gray-50">
    <div class="container mx-auto max-w-4xl px-4 py-24 sm:py-32">
        <article class="bg-white p-8 sm:p-12 rounded-2xl shadow-lg">
            
            {{-- Menampilkan Judul Halaman --}}
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6 border-b pb-4">
                {{ $page->title }}
            </h1>

            {{-- 
                Menampilkan Konten Halaman.
                {!! ... !!} digunakan agar format teks seperti paragraf baru bisa ditampilkan.
                nl2br(e(...)) adalah cara aman untuk melakukannya.
            --}}
            <div class="prose max-w-none text-gray-800 leading-relaxed text-base sm:text-lg">
                {!! nl2br(e($page->content)) !!}
            </div>
            
        </article>
    </div>
</div>
@endsection