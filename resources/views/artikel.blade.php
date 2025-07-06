<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artikel - Pesantren Al-Anwar</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@include('layouts.nav')
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex flex-col">
    <main class="flex-grow">
        <section class="py-8 sm:py-12 px-4 sm:px-6 lg:px-8 bg-gray-50 pt-24 pb-16">
            <div class="container mx-auto max-w-7xl">
                <div class="text-center mb-8 sm:mb-12 md:mb-16">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 sm:mb-6">
                        Artikel Terbaru
                    </h2>
                </div>

                <div class="flex-1">
                    @if ($articles->isEmpty())
                        <div class="bg-white rounded-2xl shadow-lg p-8 sm:p-12 text-center max-w-md mx-auto">
                            <p class="text-gray-500 text-base sm:text-lg">Belum ada artikel yang tersedia.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 w-full">
                            @foreach ($articles as $article)
                                <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex flex-col h-full">
                                    <a href="{{ route('artikel.detail', $article->id) }}" class="block overflow-hidden">
                                        @php
                                            $imageUrl = $article->gambar && Illuminate\Support\Str::startsWith($article->gambar, 'http')
                                                ? $article->gambar
                                                : ($article->gambar ? asset('storage/' . $article->gambar) : 'https://via.placeholder.com/400x250?text=Al-Anwar');
                                        @endphp
                                        <img src="{{ $imageUrl }}" alt="{{ $article->judul }}" class="w-full h-48 object-cover hover:scale-110 transition-transform duration-500">
                                    </a>
                                    <div class="p-4 sm:p-6 flex-grow flex flex-col">
                                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 text-xs sm:text-sm text-gray-500">
                                            <span class="bg-blue-100 text-blue-700 px-2 sm:px-3 py-1 rounded-full font-medium mb-2 sm:mb-0">
                                                {{ \Carbon\Carbon::parse($article->tanggal)->format('d M Y') }}
                                            </span>
                                            <span class="font-medium">Oleh: {{ $article->penulis }}</span>
                                        </div>
                                        <h3 class="text-lg sm:text-xl font-bold mb-3 text-gray-900 leading-tight">
                                            <a href="{{ route('artikel.detail', $article->id) }}" class="hover:text-blue-600 transition duration-300">
                                                {{ $article->judul }}
                                            </a>
                                        </h3>
                                        <p class="text-gray-600 text-sm sm:text-base mb-4 sm:mb-6 flex-grow leading-relaxed">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($article->isi), 120) }}
                                        </p>
                                        <a href="{{ route('artikel.detail', $article->id) }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold text-sm sm:text-base transition duration-300 mt-auto group">
                                            Baca selengkapnya
                                        </a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mt-8">
                    {{ $articles->links() }}
                </div>
            </div>
        </section>
    </main>
    @include('layouts.footer')
</body>
</html>