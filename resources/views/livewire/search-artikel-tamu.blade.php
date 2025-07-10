<div>
    <div class="text-center mb-12 sm:mb-16">
        <h2 class="text-4xl font-bold mb-5">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#008362] to-green-400">
                Artikel & Opini
            </span>
        </h2>
        
        {{-- Filter Kategori --}}
        <div class="mb-8 flex justify-center">
            <div class="flex items-center bg-white p-1 rounded-full shadow-sm border border-gray-200 space-x-1">
                {{-- TOMBOL HOME --}}
                <a href="{{ route('welcome') }}" 
                class="p-2 rounded-full text-gray-500 hover:bg-gray-100 transition-colors" 
                aria-label="Kembali ke Beranda"
                title="Beranda">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                </a>

                {{-- TOMBOL FILTER --}}
                <button 
                    wire:click="filterKategori('')"
                    @class([
                        'px-4 py-1.5 rounded-full text-sm transition-colors',
                        'bg-gray-100 text-gray-900 font-medium' => $kategori === '',
                        'text-gray-500 hover:bg-gray-50' => $kategori !== '',
                    ])>
                    Semua
                </button>

                <button 
                    wire:click="filterKategori('Artikel')"
                    @class([
                        'px-4 py-1.5 rounded-full text-sm transition-colors',
                        'bg-gray-100 text-gray-900 font-medium' => $kategori === 'Artikel',
                        'text-gray-500 hover:bg-gray-50' => $kategori !== 'Artikel',
                    ])>
                    Artikel
                </button>

                <button 
                    wire:click="filterKategori('Opini')"
                    @class([
                        'px-4 py-1.5 rounded-full text-sm transition-colors',
                        'bg-gray-100 text-gray-900 font-medium' => $kategori === 'Opini',
                        'text-gray-500 hover:bg-gray-50' => $kategori !== 'Opini',
                    ])>
                    Opini
                </button>
            </div>
        </div>

        {{-- Search Bar --}}
        <div class="relative w-full max-w-md mx-auto">
            <input 
                wire:model.live.debounce.300ms="search"
                type="search" 
                name="search" 
                placeholder="Cari artikel..."
                class="w-full pl-5 pr-12 py-3 border border-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm">
            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
            </div>
        </div>
    </div>

    <div class="flex-1">
        @if ($articles->isEmpty())
            <div class="bg-white rounded-xl shadow-sm p-8 text-center max-w-md mx-auto border">
                <h3 class="text-lg font-medium text-gray-700 mb-2">Artikel tidak ditemukan</h3>
                <p class="text-gray-500">Coba kata kunci atau filter lain.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($articles as $article)
                    <article class="bg-white rounded-xl overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 flex flex-col group">
                        <a href="{{ route('artikel.detail', $article->slug) }}" class="block">
                            <div class="w-full aspect-[4/2] bg-gray-100 overflow-hidden">
                                @php
                                    $imageUrl = $article->gambar && Illuminate\Support\Str::startsWith($article->gambar, 'http')
                                        ? $article->gambar
                                        : ($article->gambar ? asset('storage/' . $article->gambar) : 'https://via.placeholder.com/800x400/f3f4f6/6b7280?text=Al-Anwar');
                                @endphp
                                <img 
                                    src="{{ $imageUrl }}" 
                                    alt="{{ $article->judul }}" 
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 leading-snug group-hover:text-[#008362] transition-colors duration-200">
                                    {{ \Illuminate\Support\Str::limit($article->judul, 60) }}
                                </h3>
                            </div>
                        </a>
                        <div class="p-6 pt-0 mt-auto">
                            <div class="flex items-center text-xs text-gray-500 pt-4 border-t border-gray-100">
                                <span>{{ $article->penulis }}</span>
                                <span class="mx-2">•</span>
                                {{-- PERUBAHAN: Menggunakan created_at, bukan tanggal --}}
                                <span>{{ $article->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>

    @if ($articles->hasPages())
        <div class="mt-16">
            {{ $articles->links() }}
        </div>
    @endif
</div>