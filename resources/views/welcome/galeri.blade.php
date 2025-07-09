{{-- Salin semua kode dari <section> hingga </section> di bawah ini --}}

<section class="bg-white py-16 sm:py-24">

    <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Header Section --}}
        <div class="text-center mb-16">
            <h1 class="text-xl sm:text-2xl md:text-3xl font-medium tracking-wider">
                <span class="text-white bg-[#008362] px-4 py-2 rounded-lg shadow-lg">Galeri</span>
                <span class="text-[#008362]">Acara</span>
            </h1>
        </div>
       {{-- Container untuk semua galeri --}}
        <div class="space-y-16">
            @forelse($latestEvents as $event)
                <div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-2">{{ $event->nama_acara }}</h3>
                    @if($event->tanggal)
                        <p class="text-sm text-gray-500 mb-6">{{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}</p>
                    @endif

                    <div class="swiper welcome-gallery-swiper">
                        <div class="swiper-wrapper">
                            @foreach($event->photos as $photo)
                                <div class="swiper-slide !w-auto">
                                    <img src="{{ asset('storage/' . $photo->file_path) }}" alt="{{ $event->nama_acara }}" 
                                         class="h-48 sm:h-56 md:h-64 rounded-lg shadow-md object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <p class="text-gray-500">Belum ada galeri untuk ditampilkan.</p>
                </div>
            @endforelse
        </div>

        @if($latestEvents->isNotEmpty())
            <div class="text-center mt-16">
                <a href="{{ route('galeri.index') }}" class="px-8 py-3 bg-[#008362] text-white font-semibold rounded-lg shadow-md hover:bg-[hsl(186,100%,26%)]">
                    Lihat Semua Galeri
                </a>
            </div>
        @endif
    </div>
</section>

{{-- 2. SCRIPT INISIALISASI SWIPER.JS --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const swiper = new Swiper('.welcome-gallery-swiper', {
            // Konfigurasi
            slidesPerView: 'auto',
            spaceBetween: 16, // Jarak antar gambar
            speed: 5000, // Kecepatan transisi animasi
            loop: true,
            freeMode: true,
            autoplay: {
                delay: 1, // Delay 1ms untuk scroll berkelanjutan
                disableOnInteraction: false, // Lanjutkan autoplay setelah interaksi pengguna
                pauseOnMouseEnter: true, // Berhenti saat mouse hover
            },
        });
    });
</script>