@extends('layouts.public') {{-- Pastikan ini nama layout publik Anda --}}
@section('title', 'Galeri Acara - Pesantren Al-Anwar')
@push('styles')

@endpush

{{-- @section('content')
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
@endsection --}}

@section('content')
<div class="py-24 bg-gray-50">
    <div class="container mx-auto px-4">

        {{-- 🟢 Judul Halaman --}}
        <div class="text-center mb-16">
            <h1 class="text-6xl font-extrabold mb-2">
                <span class="text-[#008362]">Galeri</span>
                <span class="text-gray-800">Acara</span>
            </h1>
        </div>

        {{-- 🔙 Tombol Kembali --}}
        <div class="mb-10">
            <a href="{{ url('/') }}"
               class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-[#008362] hover:bg-white border border-transparent transition px-3 py-2 rounded shadow-sm">
                {{-- Icon Home --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                <span class="ml-2">Kembali ke Beranda</span>
            </a>
        </div>

        {{-- 🔁 Looping Galeri Acara --}}
        @forelse($events as $event)
            <section x-data="{ openModal: false }" class="bg-white p-10 rounded-lg shadow-md mb-10">
                <div class="grid md:grid-cols-2 gap-6 items-start">
                    {{-- Swiper Foto --}}
                    <div class="swiper main-gallery-swiper">
                        <div class="swiper-wrapper">
                            @foreach($event->photos as $photo)
                                <div class="swiper-slide w-auto">
                                    <img src="{{ asset('storage/' . $photo->file_path) }}"
                                        alt="Foto Acara"
                                        class="rounded-lg object-cover h-56 sm:h-64 md:h-72 shadow-md">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Informasi Acara --}}
                    <div class="space-y-2 p-4">
                        <h2 class="text-2xl font-bold text-gray-800">{{ $event->nama_acara }}</h2>
                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}</p>
                        <div x-data="{ expanded: false }" class="space-y-2">
                            <p :class="expanded ? 'break-words' : 'break-words line-clamp-4'"
                               class="text-sm text-gray-700 transition-all duration-300 ease-in-out">
                                {{ $event->deskripsi ?? 'Deskripsi belum tersedia.' }}
                            </p>

                            @if(Str::length($event->deskripsi) > 100)
                                <button @click="expanded = !expanded"
                                    class="text-sm text-emerald-600 hover:underline focus:outline-none">
                                    <span x-show="!expanded">Lihat Selengkapnya</span>
                                    <span x-show="expanded">Tutup</span>
                                </button>
                            @endif
                        </div>
                        <button
                            @click="openModal = true"
                            class="mt-4 inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded shadow"
                        >
                            {{-- Icon Foto (Heroicon: Photograph) --}}
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 7h2l2-3h10l2 3h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2z"
                                />
                                <circle cx="12" cy="13" r="3" />
                            </svg>
                            Lihat Semua Foto
                        </button>

                    </div>
                </div>

                {{-- Modal Semua Foto --}}
                <div x-show="openModal" x-cloak
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div @click.away="openModal = false"
                        class="bg-white w-full max-w-4xl max-h-[90vh] overflow-y-auto p-6 rounded-lg shadow-lg relative">
                        <h3 class="text-xl font-semibold mb-4">{{ $event->nama_acara }} - Semua Foto</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($event->photos as $photo)
                                <img src="{{ asset('storage/' . $photo->file_path) }}"
                                    alt="Foto"
                                    class="w-full h-40 object-cover rounded-md shadow">
                            @endforeach
                        </div>
                        <div class="text-right mt-6">
                            <button @click="openModal = false"
                                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-sm">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        @empty
            <p class="text-center text-gray-500 py-16">Belum ada galeri acara untuk ditampilkan.</p>
        @endforelse

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