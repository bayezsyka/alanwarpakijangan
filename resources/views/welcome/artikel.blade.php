<section class="py-6 sm:py-12 lg:py-20">
    <div class="container text-center mx-auto max-w-3xl px-3 sm:px-6 lg:px-8">
        <div class="inline-flex items-center rounded-lg border-2 border-[#008362] px-4 sm:px-8 py-2 sm:py-4 transition-all duration-300 hover:bg-[#008362] hover:shadow-md group cursor-pointer mb-4 sm:mb-6">
            <span class="text-base sm:text-xl md:text-2xl font-bold tracking-wide text-[#008362] group-hover:text-white transition-colors duration-300">
                Informasi Terbaru
            </span>
        </div>

        {{-- List View - Vertical stack --}}
        <div class="space-y-3 sm:space-y-4">
            
            {{-- CARD SELASANAN (Jurnal Kajian) --}}
            @if($latestSelasanan)
                <a href="{{ route('selasanan.show', $latestSelasanan->slug) }}" 
                   class="flex bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl overflow-hidden border border-emerald-200 hover:shadow-lg transition-all duration-300 group">
                    {{-- Gambar kiri --}}
                    <div class="w-28 sm:w-36 flex-shrink-0">
                        @php
                            $selasananImage = $latestSelasanan->cover_image_path 
                                ? asset('storage/' . $latestSelasanan->cover_image_path) 
                                : 'https://via.placeholder.com/200x200/059669/ffffff?text=Kajian';
                        @endphp
                        <img src="{{ $selasananImage }}" 
                             alt="{{ $latestSelasanan->title }}" 
                             class="w-full h-full object-cover aspect-square group-hover:scale-105 transition-transform duration-300">
                    </div>
                    
                    {{-- Content kanan --}}
                    <div class="flex-1 p-3 sm:p-4 flex flex-col justify-center text-left min-w-0">
                        <span class="inline-flex items-center gap-1 bg-emerald-600 text-white text-[10px] sm:text-xs font-semibold px-2 py-0.5 rounded-full w-fit mb-1.5 sm:mb-2">
                            <i class="fas fa-book-open text-[8px] sm:text-[10px]"></i>
                            Selasanan
                            @if($latestSelasanan->audio_path)
                                <span class="ml-1 bg-amber-500 text-white text-[8px] sm:text-[10px] px-1.5 py-0.5 rounded-full flex items-center">
                                    <i class="fas fa-headphones"></i>
                                </span>
                            @endif
                        </span>
                        <h3 class="text-sm sm:text-base font-bold text-gray-900 leading-snug line-clamp-2 group-hover:text-emerald-700 transition-colors">
                            {{ $latestSelasanan->title }}
                        </h3>
                        <div class="flex items-center justify-between text-[10px] sm:text-xs text-gray-500 mt-1.5 sm:mt-2">
                            <span class="truncate">{{ $latestSelasanan->speaker }}</span>
                            <span class="flex-shrink-0">{{ $latestSelasanan->monday_date->format('d/m/y') }}</span>
                        </div>
                    </div>
                </a>
            @endif

            {{-- CARD ARTIKEL --}}
            @forelse($latestArticles as $article)
                <a href="{{ route('artikel.detail', $article->slug) }}" 
                   class="flex bg-white rounded-xl overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 group">
                    {{-- Gambar kiri --}}
                    <div class="w-28 sm:w-36 flex-shrink-0">
                        @php
                            $imageUrl = $article->gambar && Illuminate\Support\Str::startsWith($article->gambar, 'http')
                                ? $article->gambar
                                : ($article->gambar ? asset('storage/' . $article->gambar) : 'https://via.placeholder.com/200x200/f3f4f6/6b7280?text=Artikel');
                        @endphp
                        <img src="{{ $imageUrl }}" 
                             alt="{{ $article->judul }}" 
                             class="w-full h-full object-cover aspect-square group-hover:scale-105 transition-transform duration-300">
                    </div>
                    
                    {{-- Content kanan --}}
                    <div class="flex-1 p-3 sm:p-4 flex flex-col justify-center text-left min-w-0">
                        @if($article->category)
                            <span class="inline-flex bg-[#008362] text-white text-[10px] sm:text-xs font-semibold px-2 py-0.5 rounded-full w-fit mb-1.5 sm:mb-2">
                                {{ $article->category->name }}
                            </span>
                        @endif
                        <h3 class="text-sm sm:text-base font-bold text-gray-900 leading-snug line-clamp-2 group-hover:text-emerald-600 transition-colors">
                            {{ $article->judul }}
                        </h3>
                        <div class="flex items-center justify-between text-[10px] sm:text-xs text-gray-500 mt-1.5 sm:mt-2">
                            <span class="truncate">{{ $article->penulis ?? 'Admin' }}</span>
                            <span class="flex-shrink-0">{{ $article->created_at->format('d/m/y') }}</span>
                        </div>
                    </div>
                </a>
            @empty
                @if(!$latestSelasanan)
                    <div class="text-center py-8">
                        <p class="text-gray-500 text-sm">Belum ada informasi.</p>
                    </div>
                @endif
            @endforelse
        </div>

        {{-- Link ke halaman artikel --}}
        <div class="mt-4 sm:mt-6">
            <a href="{{ route('artikel') }}" class="inline-flex items-center gap-1.5 text-sm text-[#008362] font-medium hover:underline">
                Lihat semua artikel
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</section>