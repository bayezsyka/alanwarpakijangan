<section class="py-16 sm:py-24">
    <div class="container text-center mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="inline-flex items-center rounded-lg border-2 border-[#008362] px-8 py-4 transition-all duration-300 hover:bg-[#008362] hover:shadow-md group cursor-pointer">
            <span class="text-xl md:text-2xl font-bold tracking-wide text-[#008362] group-hover:text-white transition-colors duration-300">
                Informasi Terbaru
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 pt-8">
            
            {{-- CARD SELASANAN (Jurnal Kajian) - Card pertama dengan desain berbeda --}}
            @if($latestSelasanan)
                <article class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-xl overflow-hidden border-2 border-emerald-200 hover:shadow-xl transition-all duration-300 flex flex-col group relative">
                    {{-- Badge khusus Selasanan --}}
                    <div class="absolute top-3 left-3 z-10 flex items-center gap-2">
                        <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md flex items-center gap-1.5">
                            <i class="fas fa-book-open text-[10px]"></i>
                            Kajian Selasanan
                        </span>
                        @if($latestSelasanan->audio_path)
                            <span class="bg-amber-500 text-white text-xs font-semibold px-2.5 py-1 rounded-full shadow-md flex items-center gap-1">
                                <i class="fas fa-headphones text-[10px]"></i>
                                Audio
                            </span>
                        @endif
                    </div>
                    
                    <a href="{{ route('selasanan.show', $latestSelasanan->slug) }}" class="block">
                        {{-- Gambar dengan rasio 2:1 --}}
                        <div class="relative w-full" style="padding-top: 50%;">
                            @php
                                $selasananImage = $latestSelasanan->cover_image_path 
                                    ? asset('storage/' . $latestSelasanan->cover_image_path) 
                                    : 'https://via.placeholder.com/800x400/059669/ffffff?text=Kajian+Selasanan';
                            @endphp
                            <img 
                                src="{{ $selasananImage }}" 
                                alt="{{ $latestSelasanan->title }}" 
                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            
                            {{-- Overlay gradient --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/30 to-transparent"></div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 leading-snug group-hover:text-emerald-700 transition-colors duration-200">
                                {{ \Illuminate\Support\Str::limit($latestSelasanan->title, 60) }}
                            </h3>
                        </div>
                    </a>
                    
                    <div class="p-6 pt-0 mt-auto">
                        <div class="flex items-center justify-between text-xs text-gray-600 pt-4 border-t border-emerald-200">
                            <span class="flex items-center">
                                <i class="far fa-calendar-alt mr-1.5 text-emerald-600"></i>
                                {{ $latestSelasanan->monday_date->locale('id')->translatedFormat('d M Y') }}
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-user mr-1.5 text-emerald-600"></i>
                                {{ $latestSelasanan->speaker }}
                            </span>
                        </div>
                    </div>
                </article>
            @endif

            {{-- CARD ARTIKEL (2 artikel terbaru) --}}
            @forelse($latestArticles as $article)
                <article class="bg-white rounded-xl overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 flex flex-col group">
                    <a href="{{ route('artikel.detail', $article->slug) }}" class="block">
                        {{-- Gambar dengan rasio 2:1 --}}
                        <div class="relative w-full" style="padding-top: 50%;">
                            @php
                                $imageUrl = $article->gambar && Illuminate\Support\Str::startsWith($article->gambar, 'http')
                                    ? $article->gambar
                                    : ($article->gambar ? asset('storage/' . $article->gambar) : 'https://via.placeholder.com/800x400/f3f4f6/6b7280?text=Al-Anwar');
                            @endphp
                            <img 
                                src="{{ $imageUrl }}" 
                                alt="{{ $article->judul }}" 
                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 leading-snug group-hover:text-green-600 transition-colors duration-200">
                                {{ \Illuminate\Support\Str::limit($article->judul, 60) }}
                            </h3>
                        </div>
                    </a>
                    
                    <div class="p-6 pt-0 mt-auto">
                        <div class="flex items-center text-xs text-gray-500 pt-4 border-t border-gray-100">
                            <span>Oleh: {{ $article->penulis ?? $article->user->name ?? 'Admin' }}</span>
                            <span class="mx-2">•</span>
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Dilihat: {{ $article->views }} kali
                            </span>                   
                        </div>
                    </div>
                </article>
            @empty
                {{-- Jika tidak ada artikel, tampilkan placeholder --}}
                @if(!$latestSelasanan)
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500">Belum ada informasi untuk ditampilkan.</p>
                    </div>
                @endif
            @endforelse
        </div>
    </div>
</section>