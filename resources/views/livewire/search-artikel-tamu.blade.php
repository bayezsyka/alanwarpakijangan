<div>
    <div class="text-center mb-8 sm:mb-12 md:mb-16">
        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 sm:mb-6">
            Artikel Terbaru
        </h2>
        <p class="text-base sm:text-lg md:text-xl text-gray-600 max-w-3xl mx-auto mb-6 sm:mb-8">
            Temukan wawasan dan pengetahuan terbaru dari para ustadz dan santri Pesantren Al-Anwar Pakijangan
        </p>

        <div class="relative w-full max-w-md mx-auto">
            <input 
                wire:model.live.debounce.300ms="search"
                type="search" 
                name="search" 
                placeholder="Ketik untuk mencari judul atau penulis..."
                class="w-full pl-4 pr-10 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>

    <div class="flex-1">
        @if ($articles->isEmpty())
            <div class="bg-white rounded-2xl shadow-lg p-8 sm:p-12 text-center max-w-md mx-auto">
                <p class="text-gray-500 text-base sm:text-lg">Artikel yang Anda cari tidak ditemukan.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 w-full">
                @foreach ($articles as $article)
                    <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex flex-col h-full">
                        <a href="{{ route('artikel.detail', $article->slug) }}" class="block overflow-hidden">
                            @php
                                $imageUrl = $article->gambar && Illuminate\Support\Str::startsWith($article->gambar, 'http')
                                    ? $article->gambar
                                    : ($article->gambar ? asset('storage/' . $article->gambar) : 'https://via.placeholder.com/400x250?text=Al-Anwar');
                            @endphp
                            <img src="{{ $imageUrl }}" alt="{{ $article->judul }}" class="w-full h-48 object-cover hover:scale-110 transition-transform duration-500">
                        </a>
                        <div class="p-4 sm:p-6 flex-grow flex flex-col">
                            <h3 class="text-lg sm:text-xl font-bold mb-3 text-gray-900 leading-tight">
                                <a href="{{ route('artikel.detail', $article->slug) }}" class="hover:text-blue-600 transition duration-300">
                                    {{ $article->judul }}
                                </a>
                            </h3>
                            <p class="text-gray-600 text-sm sm:text-base mb-4 sm:mb-6 flex-grow leading-relaxed">
                                {{ \Illuminate\Support\Str::limit(strip_tags($article->isi), 120) }}
                            </p>
                            <a href="{{ route('artikel.detail', $article->slug) }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold text-sm sm:text-base transition duration-300 mt-auto group">
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