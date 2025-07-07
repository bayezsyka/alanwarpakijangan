<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
    <!-- Header Section -->
    <div class="text-center mb-12 sm:mb-16">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
            <span class="relative inline-block">
                <span class="relative z-10">Artikel Terbaru</span>
                <span class="absolute bottom-0 left-0 w-full h-2 bg-green-100 opacity-70 -z-0" style="bottom: 5px;"></span>
            </span>
        </h2>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
            Temukan wawasan dan pengetahuan terbaru dari para ustadz dan santri Pesantren Al-Anwar Pakijangan
        </p>

        <!-- Search Bar -->
        <div class="relative w-full max-w-md mx-auto mt-8">
            <div class="relative">
                <input 
                    wire:model.live.debounce.300ms="search"
                    type="search" 
                    name="search" 
                    placeholder="Cari artikel..."
                    class="w-full pl-5 pr-12 py-3 border border-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent shadow-sm transition-all duration-200">
                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Articles Grid -->
    <div class="flex-1">
        @if ($articles->isEmpty())
            <div class="bg-white rounded-xl shadow-sm p-8 sm:p-12 text-center max-w-md mx-auto border border-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-700 mb-2">Artikel tidak ditemukan</h3>
                <p class="text-gray-500">Coba kata kunci lain atau periksa kembali pencarian Anda</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach ($articles as $article)
                    <article class="bg-white rounded-xl overflow-hidden border border-gray-100 hover:shadow-md transition-all duration-300 flex flex-col h-full group">
                        <a href="{{ route('artikel.detail', $article->slug) }}" class="block overflow-hidden">
                            @php
                                $imageUrl = $article->gambar && Illuminate\Support\Str::startsWith($article->gambar, 'http')
                                    ? $article->gambar
                                    : ($article->gambar ? asset('storage/' . $article->gambar) : 'https://via.placeholder.com/800x500/f8fafc/cccccc?text=Al-Anwar');
                            @endphp
                            <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                                <img 
                                    src="{{ $imageUrl }}" 
                                    alt="{{ $article->judul }}" 
                                    class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-105">
                            </div>
                        </a>
                        <div class="p-5 sm:p-6 flex-grow flex flex-col">
                            <div class="flex items-center text-xs text-gray-500 mb-3">
                                <span>{{ \Carbon\Carbon::parse($article->tanggal)->format('d M Y') }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $article->penulis }}</span>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-3 leading-snug">
                                <a href="{{ route('artikel.detail', $article->slug) }}" class="hover:text-green-600 transition-colors duration-200">
                                    {{ \Illuminate\Support\Str::limit($article->judul, 60) }}
                                </a>
                            </h3>
                            <p class="text-gray-600 text-sm sm:text-base mb-4 flex-grow leading-relaxed">
                                {{ \Illuminate\Support\Str::limit(strip_tags($article->isi), 100) }}
                            </p>
                            <div class="mt-auto pt-3 border-t border-gray-100">
                                <a href="{{ route('artikel.detail', $article->slug) }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium text-sm transition-colors duration-200 group">
                                    Baca selengkapnya
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if ($articles->hasPages())
        <div class="mt-12 sm:mt-16">
            {{ $articles->links('vendor.pagination.tailwind') }}
        </div>
    @endif
</div>