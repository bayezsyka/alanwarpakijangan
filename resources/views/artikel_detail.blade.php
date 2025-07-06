<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $article->judul }} - Pesantren Al-Anwar</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    @include('layouts.nav')
    <main class="flex-grow container mx-auto max-w-4xl px-4 py-24">
        <article class="bg-white rounded-lg shadow-lg overflow-hidden p-6 sm:p-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4 leading-tight">{{ $article->judul }}</h1>
            <div class="flex items-center text-gray-600 text-sm mb-6">
                <span class="mr-4">Tanggal: {{ \Carbon\Carbon::parse($article->tanggal)->format('d M Y') }}</span>
                <span>Oleh: {{ $article->penulis }}</span>
            </div>
            @if($article->gambar)
                @php
                    $imageUrl = Illuminate\Support\Str::startsWith($article->gambar, 'http')
                        ? $article->gambar
                        : asset('storage/' . $article->gambar);
                @endphp
                <img src="{{ $imageUrl }}" alt="{{ $article->judul }}" class="w-full h-auto max-h-96 object-cover rounded-md mb-6">
            @endif
            <div class="prose max-w-none text-gray-800 leading-relaxed text-base sm:text-lg">
                {!! nl2br(e($article->isi)) !!}
            </div>
            <div class="mt-8">
                <a href="{{ route('artikel') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold transition duration-300">
                    &larr; Kembali ke Artikel
                </a>
            </div>
        </article>
    </main>
    @include('layouts.footer')
</body>
</html>