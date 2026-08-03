<section class="section bg-surface">
    <div class="container-editorial">

        {{-- Section heading --}}
        <div class="section-heading text-center mx-auto mb-12" data-aos="fade-up">
            <p class="eyebrow justify-center">Galeri Kegiatan</p>
            <h2>Dokumentasi &amp; Kegiatan</h2>
            <p class="description mx-auto">Dokumentasi kajian rutin dan kegiatan Pondok Pesantren Al-Anwar Pakijangan.</p>
        </div>

        <div class="space-y-16">

            {{-- 📚 Section Kajian Selasanan --}}
            @if ($selasananGallery->count() > 0)
                <div data-aos="fade-up">
                    <div class="flex items-end justify-between mb-5">
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-[0.14em] text-accent mb-1">Kajian Rutin</p>
                            <h3 class="font-display text-2xl lg:text-3xl font-semibold text-dark">Kajian Selasanan</h3>
                            <p class="text-sm text-muted mt-1">Dokumentasi Kajian Rutin Mingguan</p>
                        </div>
                    </div>

                    <div class="swiper welcome-gallery-swiper">
                        <div class="swiper-wrapper">
                            @foreach ($selasananGallery as $entry)
                                <div class="swiper-slide !w-auto">
                                    <div class="overflow-hidden rounded-md shadow-card group">
                                        <img src="{{ asset('storage/' . $entry->cover_image_path) }}"
                                             alt="{{ $entry->title }}"
                                             class="h-44 sm:h-56 lg:h-64 w-auto object-cover group-hover:scale-[1.04] transition-transform duration-500">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            {{-- 🎉 Section Galeri Acara --}}
            @forelse($latestEvents as $event)
                <div data-aos="fade-up">
                    <div class="flex items-end justify-between mb-5">
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-[0.14em] text-accent mb-1">Acara</p>
                            <h3 class="font-display text-2xl lg:text-3xl font-semibold text-dark">{{ $event->nama_acara }}</h3>
                            @if ($event->tanggal)
                                <p class="text-sm text-muted mt-1">{{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="swiper welcome-gallery-swiper">
                        <div class="swiper-wrapper">
                            @foreach ($event->photos as $photo)
                                <div class="swiper-slide !w-auto">
                                    <div class="overflow-hidden rounded-md shadow-card group">
                                        <img src="{{ asset('storage/' . $photo->file_path) }}"
                                             alt="{{ $event->nama_acara }}"
                                             class="h-44 sm:h-56 lg:h-64 w-auto object-cover group-hover:scale-[1.04] transition-transform duration-500">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                @if ($selasananGallery->count() == 0)
                    <div class="text-center py-16 text-muted">Belum ada galeri untuk ditampilkan.</div>
                @endif
            @endforelse
        </div>

        @if ($latestEvents->isNotEmpty() || $selasananGallery->count() > 0)
            <div class="text-center mt-12" data-aos="fade-up">
                <a href="{{ route('galeri.index') }}" class="btn btn-primary">
                    Lihat Semua Galeri
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        @endif
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.welcome-gallery-swiper', {
            slidesPerView: 'auto',
            spaceBetween: 16,
            speed: 5000,
            loop: true,
            freeMode: true,
            autoplay: {
                delay: 1,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
        });
    });
</script>
