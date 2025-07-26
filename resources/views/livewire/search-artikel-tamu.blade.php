<div class="max-w-4xl mx-auto px-4 py-8">
    {{-- Header Section --}}
    <div class="text-center mb-12">
        <h2 class="text-4xl font-bold mb-5">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#008362] to-green-400">
                Artikel & Opini
            </span>
        </h2>
        
        {{-- Filter and View Toggle --}}
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-8">
            {{-- Filter Kategori --}}
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

                {{-- Filter Buttons --}}
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
            
            {{-- View Toggle --}}
            <div class="flex items-center bg-white p-1 rounded-full shadow-sm border border-gray-200">
                <button 
                    wire:click="$set('viewMode', 'grid')"
                    @class([
                        'p-2 rounded-full transition-colors',
                        'bg-gray-100 text-gray-900' => $viewMode === 'grid',
                        'text-gray-500 hover:bg-gray-50' => $viewMode !== 'grid',
                    ])
                    aria-label="Grid View"
                    title="Tampilan Grid">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </button>
                <button 
                    wire:click="$set('viewMode', 'list')"
                    @class([
                        'p-2 rounded-full transition-colors',
                        'bg-gray-100 text-gray-900' => $viewMode === 'list',
                        'text-gray-500 hover:bg-gray-50' => $viewMode !== 'list',
                    ])
                    aria-label="List View"
                    title="Tampilan List">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Search Bar --}}
        <div class="relative w-full max-w-md mx-auto mb-8">
            <input 
                wire:model.live.debounce.300ms="search"
                type="search" 
                name="search" 
                placeholder="Cari artikel..."
                class="w-full pl-5 pr-12 py-3 border border-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm">
            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>

    {{-- Articles List --}}
    <div class="flex-1">
        @if ($articles->isEmpty())
            <div class="bg-white rounded-xl shadow-sm p-8 text-center max-w-md mx-auto border">
                <h3 class="text-lg font-medium text-gray-700 mb-2">Artikel tidak ditemukan</h3>
                <p class="text-gray-500">Coba kata kunci atau filter lain.</p>
            </div>
        @else
            @if($viewMode === 'grid')
                {{-- Compact Grid View - 3 columns --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($articles as $article)
                        <article class="bg-white rounded-lg overflow-hidden border border-gray-100 hover:shadow-md transition-all duration-200 flex flex-col">
                            <a href="{{ route('artikel.detail', $article->slug) }}" class="block">
                                <div class="w-full aspect-[4/3] bg-gray-100 overflow-hidden">
                                    @php
                                        $imageUrl = $article->gambar && Illuminate\Support\Str::startsWith($article->gambar, 'http')
                                            ? $article->gambar
                                            : ($article->gambar ? asset('storage/' . $article->gambar) : 'https://via.placeholder.com/800x600/f3f4f6/6b7280?text=Al-Anwar');
                                    @endphp
                                    <img 
                                        src="{{ $imageUrl }}" 
                                        alt="{{ $article->judul }}" 
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                </div>
                                <div class="p-4">
                                    <span class="inline-block px-2 py-1 text-xs font-medium rounded-full mb-2 
                                        {{ $article->kategori === 'Opini' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ $article->kategori }}
                                    </span>
                                    <h3 class="text-lg font-semibold text-gray-900 leading-tight mb-3 line-clamp-2">
                                        {{ $article->judul }}
                                    </h3>
                                    <div class="flex items-center justify-between text-xs text-gray-500 pt-2 border-t border-gray-100">
                                        <span class="font-medium">{{ $article->penulis }}</span>
                                        <span>{{ $article->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                {{-- Compact List View --}}
                <div class="space-y-3">
                    @foreach ($articles as $article)
                        <article class="bg-white rounded-lg overflow-hidden border border-gray-100 hover:shadow-md transition-all duration-200">
                            <a href="{{ route('artikel.detail', $article->slug) }}" class="block sm:flex items-center">
                                <div class="w-full sm:w-1/5 aspect-[4/3] bg-gray-100 overflow-hidden">
                                    @php
                                        $imageUrl = $article->gambar && Illuminate\Support\Str::startsWith($article->gambar, 'http')
                                            ? $article->gambar
                                            : ($article->gambar ? asset('storage/' . $article->gambar) : 'https://via.placeholder.com/800x600/f3f4f6/6b7280?text=Al-Anwar');
                                    @endphp
                                    <img 
                                        src="{{ $imageUrl }}" 
                                        alt="{{ $article->judul }}" 
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                </div>
                                <div class="p-4 sm:w-4/5">
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                        <div>
                                            <span class="inline-block px-2 py-1 text-xs font-medium rounded-full mb-1 sm:mb-0
                                                {{ $article->kategori === 'Opini' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                                {{ $article->kategori }}
                                            </span>
                                            <h3 class="text-lg font-semibold text-gray-900 leading-tight">
                                                {{ $article->judul }}
                                            </h3>
                                        </div>
                                        <div class="text-xs text-gray-500 text-right">
                                            <div class="font-medium">{{ $article->penulis }}</div>
                                            <div>{{ $article->created_at->format('d M Y') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            @endif
        @endif
    </div>

    {{-- Pagination --}}
    @if ($articles->hasPages())
        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    @endif
</div>