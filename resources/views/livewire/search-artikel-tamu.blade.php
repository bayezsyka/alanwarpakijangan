<div class="container-editorial py-12 lg:py-20">
    {{-- Header Section --}}
    <div class="mb-10 lg:mb-14" data-aos="fade-up">
        <div class="section-heading">
            <p class="eyebrow">Karya &amp; Tulisan</p>
            <h2>Artikel &amp; Opini</h2>
            <p class="description">Kumpulan artikel, opini, dan tulisan dari Pondok Pesantren Al-Anwar Pakijangan.</p>
        </div>

        {{-- Search Bar --}}
        <div class="relative w-full max-w-2xl mt-8">
            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-muted">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input wire:model.live.debounce.400ms="search" type="search" name="search"
                placeholder="Cari artikel atau opini..."
                class="w-full pl-14 pr-6 py-3.5 border border-black/10 rounded-full bg-surface focus:ring-2 focus:ring-accent focus:border-accent shadow-sm text-sm placeholder-muted transition-all duration-200">
        </div>

        {{-- Filter and View Toggle --}}
        <div class="flex items-center justify-between gap-3 mt-6">
            {{-- Filter Kategori --}}
            <div class="flex items-center space-x-1 bg-surface-alt rounded-full p-1 overflow-x-auto flex-1 min-w-0">
                <a href="{{ route('welcome') }}"
                    class="p-2 rounded-full text-muted hover:bg-surface hover:text-primary transition-colors duration-200 flex-shrink-0"
                    aria-label="Beranda" title="Beranda">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                </a>

                <div class="h-4 border-l border-black/10"></div>

                <button wire:click="filterKategori('')" @class([
                    'px-3 py-1.5 rounded-full text-xs font-semibold transition-all duration-200 whitespace-nowrap flex-shrink-0',
                    'bg-surface shadow-sm text-primary' => $kategori === '',
                    'text-muted hover:bg-surface hover:text-dark' => $kategori !== '',
                ])>
                    Semua
                </button>

                @foreach ($categories as $category)
                    <button wire:click="filterKategori('{{ $category->slug }}')" @class([
                        'px-3 py-1.5 rounded-full text-xs font-semibold transition-all duration-200 whitespace-nowrap flex-shrink-0',
                        'bg-surface shadow-sm text-primary' => $kategori === $category->slug,
                        'text-muted hover:bg-surface hover:text-dark' => $kategori !== $category->slug,
                    ])>
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            {{-- View Toggle --}}
            <div class="flex items-center space-x-0.5 bg-surface-alt p-1 rounded-full flex-shrink-0">
                <button wire:click="$set('viewMode', 'grid')" @class([
                    'p-2 rounded-full transition-all duration-200',
                    'bg-surface shadow-sm text-primary' => $viewMode === 'grid',
                    'text-muted hover:bg-surface hover:text-dark' => $viewMode !== 'grid',
                ]) aria-label="Grid View" title="Grid">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </button>
                <button wire:click="$set('viewMode', 'list')" @class([
                    'p-2 rounded-full transition-all duration-200',
                    'bg-surface shadow-sm text-primary' => $viewMode === 'list',
                    'text-muted hover:bg-surface hover:text-dark' => $viewMode !== 'list',
                ]) aria-label="List View" title="List">
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
            <div class="card-editorial p-8 sm:p-12 text-center max-w-md mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 mx-auto text-muted/40 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="font-display text-xl font-semibold text-dark mb-2">Tidak ada hasil</h3>
                <p class="text-sm text-muted mb-4">Coba kata kunci lain</p>
                <button wire:click="resetFilters" class="btn btn-outline !min-h-[40px] !text-xs">
                    Reset Filter
                </button>
            </div>
        @else
            @if ($viewMode === 'grid')
                {{-- Grid View --}}
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    @foreach ($articles as $article)
                        <article class="card-editorial overflow-hidden group flex flex-col h-full" data-aos="fade-up" data-aos-delay="{{ min($loop->iteration * 70, 280) }}">
                            <a href="{{ route('artikel.detail', $article->slug) }}" class="block h-full flex flex-col">
                                <div class="w-full aspect-[4/3] bg-surface-alt overflow-hidden relative">
                                    @php
                                        $imageUrl = $article->gambar && Illuminate\Support\Str::startsWith($article->gambar, 'http')
                                            ? $article->gambar
                                            : ($article->gambar ? asset('storage/' . $article->gambar) : 'https://via.placeholder.com/800x600/f3f4f6/6b7280?text=Al-Anwar');
                                    @endphp
                                    <img src="{{ $imageUrl }}" alt="{{ $article->judul }}" class="w-full h-full object-cover group-hover:scale-[1.04] transition-transform duration-500">
                                    @if ($article->category)
                                        <span class="absolute top-3 right-3 inline-block px-3 py-1 text-[10px] sm:text-xs font-bold rounded-full bg-primary text-white">{{ $article->category->name }}</span>
                                    @endif
                                </div>
                                <div class="p-4 sm:p-6 flex-grow flex flex-col">
                                    <h3 class="font-display text-sm sm:text-xl font-semibold text-dark leading-snug mb-1 sm:mb-3 line-clamp-2 group-hover:text-primary transition-colors">
                                        {{ $article->judul }}
                                    </h3>
                                    <p class="hidden sm:block text-muted mb-4 line-clamp-2 text-sm">{{ Str::limit(strip_tags($article->isi), 100) }}</p>
                                    <div class="mt-auto pt-3 sm:pt-4 border-t border-black/8">
                                        <div class="flex items-center text-[10px] sm:text-xs text-muted">
                                            <span class="mr-1 shrink-0">Ditulis oleh:</span>
                                            <span class="font-bold text-dark truncate">{{ $article->penulis ?? ($article->user->name ?? 'Admin') }}</span>
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
                        <article class="card-editorial overflow-hidden group" data-aos="fade-up" data-aos-delay="{{ min($loop->iteration * 70, 280) }}">
                            <a href="{{ route('artikel.detail', $article->slug) }}" class="flex">
                                <div class="w-24 sm:w-1/4 aspect-square sm:aspect-[4/3] bg-surface-alt overflow-hidden relative flex-shrink-0">
                                    @php
                                        $imageUrl = $article->gambar && Illuminate\Support\Str::startsWith($article->gambar, 'http')
                                            ? $article->gambar
                                            : ($article->gambar ? asset('storage/' . $article->gambar) : 'https://via.placeholder.com/800x600/f3f4f6/6b7280?text=Al-Anwar');
                                    @endphp
                                    <img src="{{ $imageUrl }}" alt="{{ $article->judul }}" class="w-full h-full object-cover group-hover:scale-[1.04] transition-transform duration-500">
                                </div>
                                <div class="p-4 sm:p-6 flex-1 flex flex-col min-w-0">
                                    @if ($article->category)
                                        <div class="mb-2">
                                            <span class="inline-block px-3 py-1 text-[10px] sm:text-xs font-bold rounded-full bg-primary text-white">{{ $article->category->name }}</span>
                                        </div>
                                    @endif
                                    <h3 class="font-display text-sm sm:text-xl font-semibold text-dark leading-snug mb-1 sm:mb-2 line-clamp-2 group-hover:text-primary transition-colors">
                                        {{ $article->judul }}
                                    </h3>
                                    <p class="hidden sm:block text-muted mb-4 line-clamp-2 text-sm">{{ Str::limit(strip_tags($article->isi), 150) }}</p>
                                    <div class="mt-auto pt-3 sm:pt-4 border-t border-black/8">
                                        <div class="flex items-center text-[10px] sm:text-xs text-muted">
                                            <span class="mr-1 shrink-0">Ditulis oleh:</span>
                                            <span class="font-bold text-dark truncate">{{ $article->penulis ?? ($article->user->name ?? 'Admin') }}</span>
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
        <div class="mt-10 sm:mt-16 px-2 sm:px-4">
            {{ $articles->onEachSide(1)->links('vendor.pagination.tailwind-custom') }}
        </div>
    @endif
</div>
