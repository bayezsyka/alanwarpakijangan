<section class="section bg-surface-alt">
    <div class="container-editorial">

        {{-- Section heading --}}
        <div class="section-heading mb-12" data-aos="fade-up">
            <p class="eyebrow">Informasi Terbaru</p>
            <h2>Kabar &amp; Kajian Terkini</h2>
            <p class="description">Jurnal kajian Selasanan dan artikel terbaru dari Pondok Pesantren Al-Anwar Pakijangan.</p>
        </div>

        {{-- Cards grid --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">

            {{-- Card Selasanan (featured) --}}
            @if($latestSelasanan)
                <a href="{{ route('selasanan.show', $latestSelasanan->slug) }}"
                   class="card-editorial overflow-hidden group block" data-aos="fade-up" data-aos-delay="0">
                    <div class="relative overflow-hidden">
                        @php
                            $selasananImage = $latestSelasanan->cover_image_path
                                ? asset('storage/' . $latestSelasanan->cover_image_path)
                                : 'https://via.placeholder.com/600x400/059669/ffffff?text=Kajian';
                        @endphp
                        <img src="{{ $selasananImage }}" alt="{{ $latestSelasanan->title }}"
                             class="w-full h-56 object-cover group-hover:scale-[1.04] transition-transform duration-500" />
                        <span class="absolute top-4 left-4 inline-flex items-center gap-1.5 bg-primary text-white text-[11px] font-bold px-3 py-1.5 rounded-full">
                            <i class="fas fa-book-open text-[10px]"></i> Selasanan
                            @if($latestSelasanan->audio_path)
                                <span class="ml-1 bg-accent text-dark text-[9px] px-1.5 py-0.5 rounded-full flex items-center">
                                    <i class="fas fa-headphones"></i>
                                </span>
                            @endif
                        </span>
                    </div>
                    <div class="p-6">
                        <p class="text-[11px] font-bold uppercase tracking-[0.14em] text-accent mb-2">Kajian Rutin</p>
                        <h3 class="font-display text-[22px] font-semibold leading-snug text-dark group-hover:text-primary transition-colors line-clamp-2">
                            {{ $latestSelasanan->title }}
                        </h3>
                        <div class="mt-4 flex items-center justify-between text-xs text-muted">
                            <span class="truncate">{{ $latestSelasanan->speaker }}</span>
                            <span class="shrink-0">{{ $latestSelasanan->monday_date->format('d/m/y') }}</span>
                        </div>
                    </div>
                </a>
            @endif

            {{-- Card Artikel --}}
            @foreach($latestArticles as $article)
                <a href="{{ route('artikel.detail', $article->slug) }}"
                   class="card-editorial overflow-hidden group block"
                   data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 70 }}">
                    <div class="relative overflow-hidden">
                        @php
                            $imageUrl = $article->gambar && Illuminate\Support\Str::startsWith($article->gambar, 'http')
                                ? $article->gambar
                                : ($article->gambar ? asset('storage/' . $article->gambar) : 'https://via.placeholder.com/600x400/f3f4f6/6b7280?text=Artikel');
                        @endphp
                        <img src="{{ $imageUrl }}" alt="{{ $article->judul }}"
                             class="w-full h-56 object-cover group-hover:scale-[1.04] transition-transform duration-500" />
                        @if($article->category)
                            <span class="absolute top-4 left-4 inline-flex bg-dark/85 text-white text-[11px] font-bold px-3 py-1.5 rounded-full">
                                {{ $article->category->name }}
                            </span>
                        @endif
                    </div>
                    <div class="p-6">
                        <p class="text-[11px] font-bold uppercase tracking-[0.14em] text-accent mb-2">Artikel</p>
                        <h3 class="font-display text-[22px] font-semibold leading-snug text-dark group-hover:text-primary transition-colors line-clamp-2">
                            {{ $article->judul }}
                        </h3>
                        <div class="mt-4 flex items-center justify-between text-xs text-muted">
                            <span class="truncate">{{ $article->penulis ?? 'Admin' }}</span>
                            <span class="shrink-0">{{ $article->created_at->format('d/m/y') }}</span>
                        </div>
                    </div>
                </a>
            @endforeach

            {{-- Empty state --}}
            @if(!$latestSelasanan && $latestArticles->isEmpty())
                <div class="col-span-full text-center py-16 text-muted">Belum ada informasi.</div>
            @endif
        </div>

        {{-- Link to all articles --}}
        <div class="mt-10 flex justify-center" data-aos="fade-up">
            <a href="{{ route('artikel') }}" class="btn btn-outline">
                Lihat semua artikel
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</section>
