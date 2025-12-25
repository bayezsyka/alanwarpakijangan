<div class="max-w-7xl mx-auto px-3 sm:px-6 py-4 sm:py-8 lg:py-16">
    {{-- Header Section --}}
    <div class="text-center mb-6 sm:mb-12 lg:mb-16">
        <div class="inline-flex items-center rounded-lg border-2 border-[#008362] px-4 sm:px-8 py-2 sm:py-4 transition-all duration-300 hover:bg-[#008362] hover:shadow-md group cursor-pointer mb-4 sm:mb-8">
            <span class="text-base sm:text-xl md:text-2xl font-bold tracking-wide text-[#008362] group-hover:text-white transition-colors duration-300">
                Artikel & Opini
            </span>
        </div>
        
        {{-- Search Bar --}}
        <div class="relative w-full max-w-2xl mx-auto mb-4 sm:mb-8 lg:mb-12">
            <div class="absolute inset-y-0 left-0 pl-3 sm:pl-5 flex items-center pointer-events-none text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input 
                wire:model.live.debounce.400ms="search"
                type="search" 
                name="search" 
                placeholder="Cari artikel atau opini..."
                class="w-full pl-10 sm:pl-14 pr-4 sm:pr-6 py-2.5 sm:py-4 border-0 rounded-lg sm:rounded-xl bg-gray-50 focus:ring-2 focus:ring-emerald-400 focus:bg-white shadow-sm text-sm sm:text-lg placeholder-gray-400 transition-all duration-200">
        </div>

        {{-- Filter and View Toggle - Always in one row --}}
        <div class="flex items-center justify-between gap-2 mb-4 sm:mb-8">
            {{-- Filter Kategori - Scrollable --}}
            <div class="flex items-center space-x-1 bg-gray-50 rounded-lg p-1 shadow-inner overflow-x-auto flex-1 min-w-0">
                <a href="{{ route('welcome') }}" 
                class="p-1.5 rounded-lg text-gray-500 hover:bg-white hover:text-gray-700 transition-colors duration-200 flex-shrink-0" 
                aria-label="Beranda"
                title="Beranda">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                </a>

                <div class="h-4 border-l border-gray-200"></div>

                {{-- Filter Buttons --}}
                <button 
                    wire:click="filterKategori('')"
                    @class([
                        'px-2.5 py-1 rounded-lg text-[11px] sm:text-xs font-medium transition-all duration-200 whitespace-nowrap flex-shrink-0',
                        'bg-white shadow-md text-emerald-600' => $kategori === '',
                        'text-gray-500 hover:bg-white hover:text-gray-700' => $kategori !== '',
                    ])>
                    Semua
                </button>

                @foreach($categories as $category)
                    <button 
                        wire:click="filterKategori('{{ $category->slug }}')"
                        @class([
                            'px-2.5 py-1 rounded-lg text-[11px] sm:text-xs font-medium transition-all duration-200 whitespace-nowrap flex-shrink-0',
                            'bg-white shadow-md text-emerald-600' => $kategori === $category->slug,
                            'text-gray-500 hover:bg-white hover:text-gray-700' => $kategori !== $category->slug,
                        ])>
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
            
            {{-- View Toggle - Fixed to right --}}
            <div class="flex items-center space-x-0.5 bg-gray-50 p-1 rounded-lg shadow-inner flex-shrink-0">
                <button 
                    wire:click="$set('viewMode', 'grid')"
                    @class([
                        'p-1.5 rounded-lg transition-all duration-200',
                        'bg-white shadow-md text-emerald-600' => $viewMode === 'grid',
                        'text-gray-500 hover:bg-white hover:text-gray-700' => $viewMode !== 'grid',
                    ])
                    aria-label="Grid View"
                    title="Grid">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </button>
                <button 
                    wire:click="$set('viewMode', 'list')"
                    @class([
                        'p-1.5 rounded-lg transition-all duration-200',
                        'bg-white shadow-md text-emerald-600' => $viewMode === 'list',
                        'text-gray-500 hover:bg-white hover:text-gray-700' => $viewMode !== 'list',
                    ])
                    aria-label="List View"
                    title="List">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Articles List --}}
    <div class="flex-1">
        @if ($articles->isEmpty())
            <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm p-6 sm:p-12 text-center max-w-md mx-auto border border-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 sm:h-16 sm:w-16 mx-auto text-gray-300 mb-3 sm:mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-base sm:text-xl font-medium text-gray-700 mb-2 sm:mb-3">Tidak ada hasil</h3>
                <p class="text-xs sm:text-base text-gray-500 mb-3 sm:mb-4">Coba kata kunci lain</p>
                <button wire:click="resetFilters" class="px-4 sm:px-5 py-1.5 sm:py-2 bg-emerald-50 text-emerald-600 rounded-lg text-xs sm:text-sm font-medium hover:bg-emerald-100 transition-colors">
                    Reset Filter
                </button>
            </div>
        @else
            @if($viewMode === 'grid')
                {{-- Grid View --}}
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6">
                    @foreach ($articles as $article)
                        <article class="group bg-white rounded-xl sm:rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 flex flex-col h-full">
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
                                    @if($article->category)
                                        <div class="absolute top-2 right-2 sm:top-4 sm:right-4">
                                            <span class="inline-block px-2 py-0.5 sm:px-3 sm:py-1 text-[10px] sm:text-xs font-semibold rounded-full bg-emerald-600 text-white">
                                                {{ $article->category->name }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-3 sm:p-6 flex-grow flex flex-col">
                                    <h3 class="text-sm sm:text-xl font-bold text-gray-900 leading-snug mb-1 sm:mb-3 line-clamp-2">
                                        {{ $article->judul }}
                                    </h3>
                                    <p class="hidden sm:block text-gray-600 mb-4 line-clamp-2 text-sm">
                                        {{ Str::limit(strip_tags($article->isi), 100) }}
                                    </p>
                                    <div class="mt-auto pt-2 sm:pt-4 border-t border-gray-100">
                                        <div class="flex items-center justify-between text-[10px] sm:text-sm">
                                            <span class="font-medium text-gray-700 truncate">{{ $article->penulis ?? 'Admin' }}</span>
                                            <span class="text-gray-500">{{ $article->created_at->format('d/m/y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                {{-- List View --}}
                <div class="space-y-3 sm:space-y-4">
                    @foreach ($articles as $article)
                        <article class="group bg-white rounded-xl sm:rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300">
                            <a href="{{ route('artikel.detail', $article->slug) }}" class="flex">
                                <div class="w-24 sm:w-1/4 aspect-square sm:aspect-[4/3] bg-gray-50 overflow-hidden relative flex-shrink-0">
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
                                <div class="p-3 sm:p-6 flex-1 flex flex-col min-w-0">
                                    @if($article->category)
                                        <div class="mb-1 sm:mb-2">
                                            <span class="inline-block px-2 py-0.5 sm:px-3 sm:py-1 text-[10px] sm:text-xs font-semibold rounded-full bg-emerald-600 text-white">
                                                {{ $article->category->name }}
                                            </span>
                                        </div>
                                    @endif
                                    <h3 class="text-sm sm:text-xl font-bold text-gray-900 leading-snug mb-1 sm:mb-2 line-clamp-2">
                                        {{ $article->judul }}
                                    </h3>
                                    <p class="hidden sm:block text-gray-600 mb-4 line-clamp-2 text-sm">
                                        {{ Str::limit(strip_tags($article->isi), 150) }}
                                    </p>
                                    <div class="mt-auto pt-2 sm:pt-4 border-t border-gray-100">
                                        <div class="flex items-center justify-between text-[10px] sm:text-sm">
                                            <span class="font-medium text-gray-700">{{ $article->penulis ?? 'Admin' }}</span>
                                            <span class="text-gray-500">{{ $article->created_at->format('d/m/y') }}</span>
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
        <div class="mt-6 sm:mt-16 px-2 sm:px-4">
            {{ $articles->onEachSide(1)->links('vendor.pagination.tailwind-custom') }}
        </div>
    @endif
</div>
