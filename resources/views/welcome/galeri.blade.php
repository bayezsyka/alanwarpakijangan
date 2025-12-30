{{-- Salin semua kode dari <section> hingga </section> di bawah ini --}}

<section class="py-10 sm:py-16 lg:py-24">

    <div class="container mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        {{-- Header Section --}}
        <div class="text-center mb-8 sm:mb-12 lg:mb-16">
            <div
                class="inline-flex items-center rounded-lg border-2 border-[#008362] px-5 sm:px-8 py-3 sm:py-4 transition-all duration-300 hover:bg-[#008362] hover:shadow-md group cursor-pointer">
                <span
                    class="text-lg sm:text-xl md:text-2xl font-bold tracking-wide text-[#008362] group-hover:text-white transition-colors duration-300">
                    Galeri Acara
                </span>
            </div>
        </div>

        {{-- Container untuk semua galeri --}}
        <div class="space-y-16">

            {{-- 📚 Section Kajian Selasanan --}}
            @if ($selasananGallery->count() > 0)
                <div>
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-semibold text-gray-800 mb-2">Kajian Selasanan</h3>
                    <p class="text-xs sm:text-sm text-gray-500 mb-4 sm:mb-6">Dokumentasi Kajian Rutin Mingguan</p>

                    <div class="swiper welcome-gallery-swiper">
                        <div class="swiper-wrapper">
                            @foreach ($selasananGallery as $entry)
                                <div class="swiper-slide !w-auto">
                                    <img src="{{ asset('storage/' . $entry->cover_image_path) }}"
                                        alt="{{ $entry->title }}"
                                        class="h-36 sm:h-48 md:h-56 lg:h-64 rounded-lg shadow-md object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            {{-- 🎉 Section Galeri Acara --}}
            @forelse($latestEvents as $event)
                <div>
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-semibold text-gray-800 mb-2">{{ $event->nama_acara }}
                    </h3>
                    @if ($event->tanggal)
                        <p class="text-xs sm:text-sm text-gray-500 mb-4 sm:mb-6">
                            {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}</p>
                    @endif

                    <div class="swiper welcome-gallery-swiper">
                        <div class="swiper-wrapper">
                            @foreach ($event->photos as $photo)
                                <div class="swiper-slide !w-auto">
                                    <img src="{{ asset('storage/' . $photo->file_path) }}"
                                        alt="{{ $event->nama_acara }}"
                                        class="h-36 sm:h-48 md:h-56 lg:h-64 rounded-lg shadow-md object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                @if ($selasananGallery->count() == 0)
                    <div class="text-center py-12">
                        <p class="text-gray-500">Belum ada galeri untuk ditampilkan.</p>
                    </div>
                @endif
            @endforelse
        </div>

        @if ($latestEvents->isNotEmpty() || $selasananGallery->count() > 0)
            <div class="text-center mt-10 sm:mt-16">
                <a href="{{ route('galeri.index') }}"
                    class="px-6 sm:px-8 py-2.5 sm:py-3 bg-[#008362] text-white text-sm sm:text-base font-semibold rounded-lg shadow-md hover:bg-[hsl(186,100%,26%)]">
                    Lihat Semua Galeri
                </a>
            </div>
        @endif
    </div>
</section>

{{-- 2. SCRIPT INISIALISASI SWIPER.JS --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi untuk semua galeri (termasuk Selasanan)
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
