@extends('layouts.public')

@section('content')
<section class="bg-gray-50 pb-6 sm:pb-12">
    <div class="container mx-auto max-w-6xl px-3 sm:px-6 lg:px-8">
        
        {{-- Header --}}
        <div class="text-center mb-4 sm:mb-8">
            <div class="inline-flex items-center rounded-lg border-2 border-[#008362] px-4 sm:px-8 py-2 sm:py-4 transition-all duration-300 hover:bg-[#008362] hover:shadow-md group cursor-pointer">
                <span class="text-base sm:text-xl md:text-2xl font-bold tracking-wide text-[#008362] group-hover:text-white transition-colors duration-300">
                    Kajian Selasanan
                </span>
            </div>
        </div>

        {{-- Back to Home --}}
        <div class="mb-4 sm:mb-6">
            <a href="{{ route('welcome') }}" 
               class="inline-flex items-center text-xs sm:text-sm font-medium text-gray-600 hover:text-[#008362] transition px-2 py-1 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                Beranda
            </a>
        </div>

        {{-- Jurnal Terbaru (Highlight) - Compact on mobile --}}
        @if($latest)
            <div class="mb-6 sm:mb-10 bg-gradient-to-br from-emerald-50 to-teal-50 rounded-lg sm:rounded-2xl shadow-lg border border-emerald-200 overflow-hidden">
                <div class="grid md:grid-cols-2 gap-0">
                    {{-- Cover Image --}}
                    <div class="relative h-40 sm:h-56 md:h-auto">
                        @if($latest->cover_image_path)
                            <img src="{{ asset('storage/' . $latest->cover_image_path) }}" 
                                 alt="{{ $latest->title }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-emerald-600 to-teal-600 flex items-center justify-center">
                                <i class="fas fa-book-open text-white text-4xl sm:text-6xl opacity-50"></i>
                            </div>
                        @endif
                        
                        {{-- Badge --}}
                        <div class="absolute top-2 left-2 sm:top-4 sm:left-4 flex flex-wrap items-center gap-1 sm:gap-2">
                            <span class="bg-emerald-600 text-white text-[10px] sm:text-xs font-semibold px-2 sm:px-3 py-1 sm:py-1.5 rounded-full shadow-md">
                                Terbaru
                            </span>
                            @if($latest->audio_path)
                                <span class="bg-amber-500 text-white text-[10px] sm:text-xs font-semibold px-2 sm:px-2.5 py-1 sm:py-1.5 rounded-full shadow-md flex items-center gap-1">
                                    <i class="fas fa-headphones text-[8px] sm:text-[10px]"></i>
                                    Audio
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Content --}}
                    <div class="p-4 sm:p-6 md:p-8 flex flex-col justify-center">
                        <p class="text-[10px] sm:text-sm text-emerald-700 font-medium mb-1 sm:mb-2">
                            {{ \Carbon\Carbon::create($latest->year, $latest->month, 1)->locale('id')->translatedFormat('M Y') }},
                            Minggu {{ $latest->week_of_month }}
                        </p>
                        <h2 class="text-base sm:text-xl md:text-2xl font-bold text-gray-900 mb-2 sm:mb-3 line-clamp-2">{{ $latest->title }}</h2>
                        <div class="text-xs sm:text-sm text-gray-600 mb-3 sm:mb-4 space-y-1">
                            <p class="flex items-center">
                                <i class="far fa-calendar-alt mr-1.5 text-emerald-600"></i>
                                {{ $latest->monday_date->locale('id')->translatedFormat('d M Y') }} • {{ substr($latest->time_wib, 0, 5) }} WIB
                            </p>
                            <p class="flex items-center">
                                <i class="fas fa-user mr-1.5 text-emerald-600"></i>
                                {{ $latest->speaker }}
                            </p>
                        </div>
                        
                        <div class="flex flex-wrap gap-2 sm:gap-3">
                            <a href="{{ route('selasanan.show', $latest->slug) }}"
                               class="inline-flex items-center gap-1 sm:gap-2 px-3 sm:px-5 py-2 sm:py-2.5 rounded-lg bg-[#008362] text-white text-xs sm:text-sm font-semibold hover:bg-emerald-700 transition shadow-md">
                                <i class="fas fa-book-reader text-[10px] sm:text-xs"></i>
                                Baca
                            </a>
                            @if($latest->audio_path)
                                <a href="{{ route('selasanan.download', $latest->slug) }}"
                                   class="inline-flex items-center gap-1 sm:gap-2 px-3 sm:px-5 py-2 sm:py-2.5 rounded-lg border-2 border-[#008362] text-[#008362] text-xs sm:text-sm font-semibold hover:bg-emerald-50 transition">
                                    <i class="fas fa-download text-[10px] sm:text-xs"></i>
                                    Audio
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Daftar Jurnal Lainnya --}}
        @if($entries->count() > 0)
            <div>
                <h3 class="text-sm sm:text-lg font-bold text-gray-900 mb-3 sm:mb-6">Arsip Jurnal</h3>
                
                {{-- Grid 2 columns on mobile like artikel --}}
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6">
                    @foreach($entries as $e)
                        {{-- Skip jika sama dengan latest --}}
                        @if($latest && $e->id === $latest->id)
                            @continue
                        @endif
                        
                        <a href="{{ route('selasanan.show', $e->slug) }}"
                           class="group bg-white rounded-xl sm:rounded-2xl shadow border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 flex flex-col">
                            
                            {{-- Cover Image --}}
                            <div class="relative aspect-[4/3]">
                                @if($e->cover_image_path)
                                    <img src="{{ asset('storage/' . $e->cover_image_path) }}" 
                                         alt="{{ $e->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center">
                                        <i class="fas fa-book-open text-white text-2xl sm:text-3xl opacity-50"></i>
                                    </div>
                                @endif
                                
                                @if($e->audio_path)
                                    <span class="absolute top-1.5 right-1.5 sm:top-3 sm:right-3 bg-amber-500 text-white text-[8px] sm:text-xs font-semibold px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-full flex items-center gap-0.5 shadow">
                                        <i class="fas fa-headphones text-[7px] sm:text-[9px]"></i>
                                        <span class="hidden sm:inline">Audio</span>
                                    </span>
                                @endif
                            </div>
                            
                            {{-- Content --}}
                            <div class="p-3 sm:p-5 flex-grow flex flex-col">
                                <p class="text-[9px] sm:text-xs text-emerald-600 font-medium mb-0.5 sm:mb-1">
                                    {{ \Carbon\Carbon::create($e->year, $e->month, 1)->locale('id')->translatedFormat('M Y') }}, Mg {{ $e->week_of_month }}
                                </p>
                                <h4 class="text-xs sm:text-base font-bold text-gray-900 group-hover:text-emerald-700 transition-colors line-clamp-2 mb-1 sm:mb-2">
                                    {{ $e->title }}
                                </h4>
                                <p class="text-[9px] sm:text-xs text-gray-500 mt-auto">
                                    {{ $e->monday_date->locale('id')->translatedFormat('d/m/y') }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-6 sm:mt-10">
                    {{ $entries->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-8 sm:py-12 bg-white rounded-xl sm:rounded-2xl shadow border border-gray-100">
                <i class="fas fa-book-open text-gray-300 text-3xl sm:text-5xl mb-3 sm:mb-4"></i>
                <p class="text-xs sm:text-base text-gray-500">Belum ada jurnal Selasanan.</p>
            </div>
        @endif
    </div>
</section>
@endsection
