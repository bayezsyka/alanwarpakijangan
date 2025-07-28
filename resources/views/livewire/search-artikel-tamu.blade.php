<div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 lg:py-16">
    {{-- Header Section --}}
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-bold mb-6 tracking-tighter">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-400">
                Artikel & Opini
            </span>
        </h1>
        
        {{-- Search Bar --}}
        <div class="relative w-full max-w-2xl mx-auto mb-12">
            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input 
                wire:model.live.debounce.400ms="search"
                type="search" 
                name="search" 
                placeholder="Cari artikel atau opini..."
                class="w-full pl-14 pr-6 py-4 border-0 rounded-xl bg-gray-50 focus:ring-2 focus:ring-emerald-400 focus:bg-white shadow-sm text-lg placeholder-gray-400 transition-all duration-200">
        </div>

        {{-- Filter and View Toggle --}}
        <div class="flex flex-col sm:flex-row justify-between items-center gap-6 mb-10 px-4">
            {{-- Filter Kategori --}}
            <div class="flex items-center space-x-2 bg-gray-50 rounded-xl p-1.5 shadow-inner">
                <a href="{{ route('welcome') }}" 
                class="p-2 rounded-lg text-gray-500 hover:bg-white hover:text-gray-700 transition-colors duration-200" 
                aria-label="Kembali ke Beranda"
                title="Beranda">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                </a>

                <div class="h-6 border-l border-gray-200"></div>

                {{-- Filter Buttons --}}
                <button 
                    wire:click="filterKategori('')"
                    @class([
                        'px-5 py-2 rounded-lg text-sm font-medium transition-all duration-200',
                        'bg-white shadow-md text-emerald-600' => $kategori === '',
                        'text-gray-500 hover:bg-white hover:text-gray-700' => $kategori !== '',
                    ])>
                    Semua
                </button>

                <button 
                    wire:click="filterKategori('Artikel')"
                    @class([
                        'px-5 py-2 rounded-lg text-sm font-medium transition-all duration-200',
                        'bg-white shadow-md text-emerald-600' => $kategori === 'Artikel',
                        'text-gray-500 hover:bg-white hover:text-gray-700' => $kategori !== 'Artikel',
                    ])>
                    Artikel
                </button>

                <button 
                    wire:click="filterKategori('Opini')"
                    @class([
                        'px-5 py-2 rounded-lg text-sm font-medium transition-all duration-200',
                        'bg-white shadow-md text-emerald-600' => $kategori === 'Opini',
                        'text-gray-500 hover:bg-white hover:text-gray-700' => $kategori !== 'Opini',
                    ])>
                    Opini
                </button>
            </div>
            
            {{-- View Toggle --}}
            <div class="flex items-center space-x-1 bg-gray-50 p-1.5 rounded-xl shadow-inner">
                <button 
                    wire:click="$set('viewMode', 'grid')"
                    @class([
                        'p-2 rounded-lg transition-all duration-200',
                        'bg-white shadow-md text-emerald-600' => $viewMode === 'grid',
                        'text-gray-500 hover:bg-white hover:text-gray-700' => $viewMode !== 'grid',
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
                        'p-2 rounded-lg transition-all duration-200',
                        'bg-white shadow-md text-emerald-600' => $viewMode === 'list',
                        'text-gray-500 hover:bg-white hover:text-gray-700' => $viewMode !== 'list',
                    ])
                    aria-label="List View"
                    title="Tampilan List">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Articles List --}}
    <div class="flex-1 px-2">
        @if ($articles->isEmpty())
            <div class="bg-white rounded-2xl shadow-sm p-12 text-center max-w-md mx-auto border border-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-xl font-medium text-gray-700 mb-3">Tidak ada hasil ditemukan</h3>
                <p class="text-gray-500 mb-4">Coba kata kunci atau filter yang berbeda</p>
                <button wire:click="resetFilters" class="px-5 py-2 bg-emerald-50 text-emerald-600 rounded-lg text-sm font-medium hover:bg-emerald-100 transition-colors">
                    Reset Filter
                </button>
            </div>
        @else
            @if($viewMode === 'grid')
                {{-- Grid View --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($articles as $article)
                        <article class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 flex flex-col h-full transform hover:-translate-y-1">
                            <a href="{{ route('artikel.detail', $article->slug) }}" class="block h-full flex flex-col">
                                <div class="w-full aspect-[4/3] bg-gray-50 overflow-hidden relative">
                                    @php
                                        $imageUrl = $article->gambar && Illuminate\Support\Str::startsWith($article->gambar, 'http')
                                            ? $article->gambar
                                            : ($article->gambar ? asset('storage/' . $article->gambar) : 'https://via.placeholder.com/800x600/f3f4f6/6b7280?text=Al-Anwar');
                                    @endphp
                                    <img 
                                        src="{{ $imageUrl }}" 
                                        alt="{{ $article->judul }}" 
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    <div class="absolute top-4 right-4">
                                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                                            {{ $article->kategori === 'Opini' ? 'bg-purple-600 text-white' : 'bg-emerald-600 text-white' }}">
                                            {{ $article->kategori }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-6 flex-grow flex flex-col">
                                    <h3 class="text-xl font-bold text-gray-900 leading-snug mb-3 line-clamp-2">
                                        {{ $article->judul }}
                                    </h3>
                                    <p class="text-gray-600 mb-4 line-clamp-2 text-sm">
                                        {{ Str::limit(strip_tags($article->konten), 100) }}
                                    </p>
                                    <div class="mt-auto pt-4 border-t border-gray-100">
                                        <div class="flex items-center justify-between text-sm">
                                            <span class="font-medium text-gray-700">{{ $article->penulis }}</span>
                                            <span class="text-gray-500">{{ $article->created_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                {{-- List View --}}
                <div class="space-y-4">
                    @foreach ($articles as $article)
                        <article class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                            <a href="{{ route('artikel.detail', $article->slug) }}" class="flex flex-col sm:flex-row">
                                <div class="w-full sm:w-1/4 aspect-[4/3] bg-gray-50 overflow-hidden relative">
                                    @php
                                        $imageUrl = $article->gambar && Illuminate\Support\Str::startsWith($article->gambar, 'http')
                                            ? $article->gambar
                                            : ($article->gambar ? asset('storage/' . $article->gambar) : 'https://via.placeholder.com/800x600/f3f4f6/6b7280?text=Al-Anwar');
                                    @endphp
                                    <img 
                                        src="{{ $imageUrl }}" 
                                        alt="{{ $article->judul }}" 
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                </div>
                                <div class="p-6 sm:w-3/4 flex flex-col h-full">
                                    <div class="mb-2">
                                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                                            {{ $article->kategori === 'Opini' ? 'bg-purple-600 text-white' : 'bg-emerald-600 text-white' }}">
                                            {{ $article->kategori }}
                                        </span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 leading-snug mb-2">
                                        {{ $article->judul }}
                                    </h3>
                                    <p class="text-gray-600 mb-4 line-clamp-2 text-sm">
                                        {{ Str::limit(strip_tags($article->konten), 150) }}
                                    </p>
                                    <div class="mt-auto pt-4 border-t border-gray-100">
                                        <div class="flex items-center justify-between text-sm">
                                            <span class="font-medium text-gray-700">{{ $article->penulis }}</span>
                                            <span class="text-gray-500">{{ $article->created_at->format('d M Y') }}</span>
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
        <div class="mt-16 px-4">
            {{ $articles->onEachSide(1)->links('vendor.pagination.tailwind-custom') }}
        </div>
    @endif
</div>