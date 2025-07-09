@extends('layouts.public') {{-- Pastikan ini nama layout publik Anda --}}
@section('title', 'Galeri Acara - Pesantren Al-Anwar')
@push('styles')

@endpush

@section('content')
<div class="py-24 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h1 class="text-5xl font-extrabold mb-4">
                <span class="text-white bg-[#008362] px-4 py-2 rounded-lg shadow-lg">Galeri</span>
                <span class="text-[#008362]">Acara</span>
            </h1>
        </div>
        
        <div class="space-y-16">
            @forelse($events as $event)
                <section>
                    <h2 class="text-3xl font-semibold mb-2 text-center">{{ $event->nama_acara }}</h2>
                    @if($event->tanggal)
                        <p class="text-sm text-gray-500 mb-8 text-center">{{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}</p>
                    @endif
                    
                    <div class="swiper main-gallery-swiper">
                        <div class="swiper-wrapper">
                             @foreach($event->photos as $photo)
                                <div class="swiper-slide !w-auto">
                                    <img src="{{ asset('storage/' . $photo->file_path) }}" alt="{{ $event->nama_acara }}" 
                                         class="h-56 sm:h-64 md:h-72 rounded-lg shadow-md object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @empty
                <p class="text-center text-gray-500 py-16">Belum ada galeri acara untuk ditampilkan.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- 2. SCRIPT INISIALISASI SWIPER.JS --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi untuk semua galeri di halaman ini
        const gallerySwipers = document.querySelectorAll('.main-gallery-swiper');
        gallerySwipers.forEach(function (swiperEl) {
            new Swiper(swiperEl, {
                slidesPerView: 'auto',
                spaceBetween: 16,
                speed: 7000,
                loop: true,
                freeMode: true,
                autoplay: {
                    delay: 1,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
            });
        });
    });
</script>
@endpush