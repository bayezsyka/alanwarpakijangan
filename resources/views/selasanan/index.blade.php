@extends('layouts.public')

@section('content')
<section class="section bg-surface-alt !pt-20 lg:!pt-24">
    <div class="container-editorial">

        {{-- Header --}}
        <div class="mb-10 lg:mb-14" data-aos="fade-up">
            <a href="{{ route('welcome') }}" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.14em] text-muted hover:text-primary transition mb-6">
                <i class="fas fa-arrow-left text-[10px]"></i> Beranda
            </a>
            <div class="section-heading">
                <p class="eyebrow">Kajian Rutin Mingguan</p>
                <h2>Kajian Selasanan</h2>
                <p class="description">Jurnal kajian rutin yang dilaksanakan setiap Senin malam di Pondok Pesantren Al-Anwar Pakijangan.</p>
            </div>
        </div>

        {{-- Jurnal Terbaru (Highlight) --}}
        @if($latest)
            <div class="mb-10 lg:mb-14 card-editorial overflow-hidden" data-aos="fade-up">
                <div class="grid md:grid-cols-2 gap-0">
                    {{-- Cover Image --}}
                    <div class="relative h-56 sm:h-72 md:h-auto min-h-[300px]">
                        @if($latest->cover_image_path)
                            <img src="{{ asset('storage/' . $latest->cover_image_path) }}" alt="{{ $latest->title }}" class="absolute inset-0 w-full h-full object-cover">
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-primary to-primary-hover flex items-center justify-center">
                                <i class="fas fa-book-open text-white/60 text-6xl"></i>
                            </div>
                        @endif

                        {{-- Badges --}}
                        <div class="absolute top-4 left-4 flex flex-wrap items-center gap-2">
                            <span class="bg-primary text-white text-[11px] font-bold px-3 py-1.5 rounded-full shadow-sm">Terbaru</span>
                            @if($latest->audio_path)
                                <span class="bg-accent text-dark text-[11px] font-bold px-3 py-1.5 rounded-full shadow-sm flex items-center gap-1">
                                    <i class="fas fa-headphones text-[10px]"></i> Audio
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-6 lg:p-10 flex flex-col justify-center">
                        <p class="eyebrow">Edisi Terbaru</p>
                        <p class="text-xs text-primary font-semibold mb-2">
                            {{ \Carbon\Carbon::create($latest->year, $latest->month, 1)->locale('id')->translatedFormat('M Y') }}, Minggu {{ $latest->week_of_month }}
                        </p>
                        <h3 class="font-display text-2xl lg:text-3xl font-semibold text-dark mb-3 line-clamp-2">{{ $latest->title }}</h3>
                        <div class="text-sm text-muted mb-5 space-y-1.5">
                            <p class="flex items-center gap-2">
                                <i class="far fa-calendar-alt text-primary"></i>
                                {{ $latest->monday_date->locale('id')->translatedFormat('d M Y') }}
                            </p>
                            <p class="flex items-center gap-2">
                                <i class="fas fa-user text-primary"></i>
                                {{ $latest->speaker }}
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('selasanan.show', $latest->slug) }}" class="btn btn-primary !min-h-[44px] !text-xs">
                                <i class="fas fa-book-reader text-[10px]"></i> Baca Jurnal
                            </a>
                            @if($latest->audio_path)
                                <a href="{{ route('selasanan.download', $latest->slug) }}" class="btn btn-outline !min-h-[44px] !text-xs">
                                    <i class="fas fa-download text-[10px]"></i> Audio
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Daftar Jurnal Lainnya --}}
        @if($entries->count() > 0)
            <div data-aos="fade-up">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-px bg-accent"></div>
                    <h3 class="font-display text-xl lg:text-2xl font-semibold text-dark">Arsip Jurnal</h3>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
                    @foreach($entries as $e)
                        @if($latest && $e->id === $latest->id)
                            @continue
                        @endif

                        <a href="{{ route('selasanan.show', $e->slug) }}"
                           class="card-editorial overflow-hidden group flex flex-col"
                           data-aos="fade-up" data-aos-delay="{{ min($loop->iteration * 70, 280) }}">

                            {{-- Cover Image --}}
                            <div class="relative aspect-[4/3]">
                                @if($e->cover_image_path)
                                    <img src="{{ asset('storage/' . $e->cover_image_path) }}" alt="{{ $e->title }}"
                                         class="w-full h-full object-cover group-hover:scale-[1.04] transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-primary to-primary-hover flex items-center justify-center">
                                        <i class="fas fa-book-open text-white/60 text-3xl"></i>
                                    </div>
                                @endif

                                @if($e->audio_path)
                                    <span class="absolute top-3 right-3 bg-accent text-dark text-[10px] font-bold px-2 py-1 rounded-full flex items-center gap-1 shadow-sm">
                                        <i class="fas fa-headphones text-[8px]"></i>
                                        <span class="hidden sm:inline">Audio</span>
                                    </span>
                                @endif
                            </div>

                            {{-- Content --}}
                            <div class="p-4 lg:p-5 flex-grow flex flex-col">
                                <p class="text-[10px] lg:text-xs text-primary font-semibold mb-1">
                                    {{ \Carbon\Carbon::create($e->year, $e->month, 1)->locale('id')->translatedFormat('M Y') }}, Mg {{ $e->week_of_month }}
                                </p>
                                <h4 class="font-display text-sm lg:text-base font-semibold text-dark group-hover:text-primary transition-colors line-clamp-2 mb-2">
                                    {{ $e->title }}
                                </h4>
                                <p class="text-[10px] lg:text-xs text-muted mt-auto">
                                    {{ $e->monday_date->locale('id')->translatedFormat('d/m/y') }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-10">
                    {{ $entries->links() }}
                </div>
            </div>
        @else
            <div class="card-editorial p-12 text-center text-muted" data-aos="fade-up">
                <i class="fas fa-book-open text-muted/30 text-5xl mb-4"></i>
                <p>Belum ada jurnal Selasanan.</p>
            </div>
        @endif
    </div>
</section>
@endsection
