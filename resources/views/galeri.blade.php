@extends('layouts.public')
@section('title', 'Galeri Acara - Pesantren Al-Anwar')
@push('styles')
@endpush

@section('content')
    <div class="section bg-surface-alt !pt-20 lg:!pt-24">
        <div class="container-editorial">

            {{-- Header --}}
            <div class="mb-10 lg:mb-14" data-aos="fade-up">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.14em] text-muted hover:text-primary transition mb-6">
                    <i class="fas fa-arrow-left text-[10px]"></i> Kembali ke Beranda
                </a>
                <div class="section-heading">
                    <p class="eyebrow">Dokumentasi</p>
                    <h2>Galeri Acara</h2>
                    <p class="description">Kumpulan dokumentasi kegiatan dan acara di Pondok Pesantren Al-Anwar Pakijangan.</p>
                </div>
            </div>

            {{-- 📚 Section Kajian Selasanan --}}
            @if ($selasananEntries->count() > 0)
                <section x-data="{ openModal: false }" class="card-editorial p-5 sm:p-8 lg:p-10 mb-8" data-aos="fade-up">
                    <div class="grid md:grid-cols-2 gap-6 lg:gap-10 items-start">
                        {{-- Swiper Foto --}}
                        <div class="swiper main-gallery-swiper">
                            <div class="swiper-wrapper">
                                @foreach ($selasananEntries as $entry)
                                    <div class="swiper-slide w-auto">
                                        <div class="overflow-hidden rounded-md shadow-card group">
                                            <img src="{{ asset('storage/' . $entry->cover_image_path) }}"
                                                alt="{{ $entry->title }}"
                                                class="rounded-md object-cover h-40 sm:h-56 md:h-64 lg:h-72 w-auto group-hover:scale-[1.04] transition-transform duration-500">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Informasi --}}
                        <div class="space-y-3 p-2 sm:p-4">
                            <p class="eyebrow">Kajian Rutin</p>
                            <h3 class="font-display text-2xl lg:text-3xl font-semibold text-dark">Kajian Selasanan</h3>
                            <p class="text-sm text-muted">Dokumentasi Kajian Rutin Mingguan</p>
                            <p class="text-[15px] text-dark/80 leading-relaxed">
                                Kumpulan foto dokumentasi kajian rutin Selasanan yang dilaksanakan setiap Senin malam di
                                Pondok Pesantren Al-Anwar.
                            </p>
                            <a href="{{ route('selasanan.index') }}" class="btn btn-primary !min-h-[44px] !text-xs mt-4">
                                <i class="fas fa-book-open text-[10px]"></i>
                                Lihat Semua Kajian
                            </a>
                        </div>
                    </div>
                </section>
            @endif

            {{-- 🔁 Looping Galeri Acara --}}
            @forelse($events as $event)
                <section x-data="{ openModal: false }" class="card-editorial p-5 sm:p-8 lg:p-10 mb-8" data-aos="fade-up">
                    <div class="grid md:grid-cols-2 gap-6 lg:gap-10 items-start">
                        {{-- Swiper Foto --}}
                        <div class="swiper main-gallery-swiper">
                            <div class="swiper-wrapper">
                                @foreach ($event->photos as $photo)
                                    <div class="swiper-slide w-auto">
                                        <div class="overflow-hidden rounded-md shadow-card group">
                                            <img src="{{ asset('storage/' . $photo->file_path) }}" alt="Foto Acara"
                                                class="rounded-md object-cover h-40 sm:h-56 md:h-64 lg:h-72 w-auto group-hover:scale-[1.04] transition-transform duration-500">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Informasi Acara --}}
                        <div class="space-y-3 p-2 sm:p-4">
                            <p class="eyebrow">Acara</p>
                            <h3 class="font-display text-2xl lg:text-3xl font-semibold text-dark">{{ $event->nama_acara }}</h3>
                            @if ($event->tanggal)
                                <p class="text-sm text-muted">{{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}</p>
                            @endif
                            <div x-data="{ expanded: false }" class="space-y-2">
                                <p :class="expanded ? 'break-words' : 'break-words line-clamp-4'" class="text-[15px] text-dark/80 leading-relaxed transition-all duration-300">
                                    {{ $event->deskripsi ?? 'Deskripsi belum tersedia.' }}
                                </p>

                                @if (Str::length($event->deskripsi) > 100)
                                    <button @click="expanded = !expanded" class="text-sm font-bold text-primary hover:underline focus:outline-none">
                                        <span x-show="!expanded">Lihat Selengkapnya</span>
                                        <span x-show="expanded">Tutup</span>
                                    </button>
                                @endif
                            </div>
                            <button @click="openModal = true" class="btn btn-outline !min-h-[44px] !text-xs mt-4">
                                <i class="fas fa-images text-[10px]"></i>
                                Lihat Semua Foto
                            </button>
                        </div>
                    </div>

                    {{-- Modal Semua Foto --}}
                    <div x-show="openModal" x-cloak class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-[60] p-4">
                        <div @click.away="openModal = false" class="bg-surface w-full max-w-4xl max-h-[90vh] overflow-y-auto p-6 lg:p-8 rounded-lg shadow-soft relative">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="font-display text-xl lg:text-2xl font-semibold text-dark">{{ $event->nama_acara }}</h3>
                                <button @click="openModal = false" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-black/5 transition" aria-label="Tutup">
                                    <i class="fas fa-times text-lg"></i>
                                </button>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach ($event->photos as $photo)
                                    <div class="overflow-hidden rounded-sm shadow-card">
                                        <img src="{{ asset('storage/' . $photo->file_path) }}" alt="Foto" class="w-full h-40 object-cover">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            @empty
                <div class="card-editorial p-12 text-center text-muted" data-aos="fade-up">
                    Belum ada galeri acara untuk ditampilkan.
                </div>
            @endforelse

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const gallerySwipers = document.querySelectorAll('.main-gallery-swiper');
            gallerySwipers.forEach(function(swiperEl) {
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
