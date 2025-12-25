@extends('layouts.public')

@section('content')
<section class="py-16 sm:py-24">
    <div class="container mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="inline-flex items-center rounded-lg border-2 border-[#008362] px-8 py-4 transition-all duration-300 hover:bg-[#008362] hover:shadow-md group cursor-pointer">
                <span class="text-xl md:text-2xl font-bold tracking-wide text-[#008362] group-hover:text-white transition-colors duration-300">
                    Kajian Selasanan
                </span>
            </div>
        </div>

        {{-- Jurnal Terbaru (Highlight) --}}
        @if($latest)
            <div class="mt-10 bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl shadow-lg border-2 border-emerald-200 overflow-hidden">
                <div class="grid md:grid-cols-2 gap-0">
                    {{-- Cover Image --}}
                    <div class="relative h-64 md:h-auto">
                        @if($latest->cover_image_path)
                            <img src="{{ asset('storage/' . $latest->cover_image_path) }}" 
                                 alt="{{ $latest->title }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-emerald-600 to-teal-600 flex items-center justify-center">
                                <i class="fas fa-book-open text-white text-6xl opacity-50"></i>
                            </div>
                        @endif
                        
                        {{-- Badge --}}
                        <div class="absolute top-4 left-4 flex items-center gap-2">
                            <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1.5 rounded-full shadow-md">
                                Jurnal Terbaru
                            </span>
                            @if($latest->audio_path)
                                <span class="bg-amber-500 text-white text-xs font-semibold px-2.5 py-1.5 rounded-full shadow-md flex items-center gap-1">
                                    <i class="fas fa-headphones text-[10px]"></i>
                                    Audio
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Content --}}
                    <div class="p-6 md:p-8 flex flex-col justify-center">
                        <p class="text-sm text-emerald-700 font-medium mb-2">
                            {{ \Carbon\Carbon::create($latest->year, $latest->month, 1)->locale('id')->translatedFormat('F Y') }},
                            Minggu ke-{{ $latest->week_of_month }}
                        </p>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">{{ $latest->title }}</h2>
                        <p class="text-gray-600 mb-4">
                            <i class="far fa-calendar-alt mr-2 text-emerald-600"></i>
                            Senin, {{ $latest->monday_date->locale('id')->translatedFormat('d F Y') }} • {{ substr($latest->time_wib, 0, 5) }} WIB
                            <br>
                            <i class="fas fa-user mr-2 text-emerald-600 mt-1"></i>
                            {{ $latest->speaker }}
                        </p>
                        
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('selasanan.show', $latest->slug) }}"
                               class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-[#008362] text-white font-semibold hover:bg-emerald-700 transition shadow-md">
                                <i class="fas fa-book-reader"></i>
                                Baca Jurnal
                            </a>
                            @if($latest->audio_path)
                                <a href="{{ route('selasanan.download', $latest->slug) }}"
                                   class="inline-flex items-center gap-2 px-5 py-3 rounded-xl border-2 border-[#008362] text-[#008362] font-semibold hover:bg-emerald-50 transition">
                                    <i class="fas fa-download"></i>
                                    Download Audio
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Daftar Jurnal Lainnya --}}
        @if($entries->count() > 0)
            <div class="mt-12">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Arsip Jurnal Selasanan</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($entries as $e)
                        {{-- Skip jika sama dengan latest --}}
                        @if($latest && $e->id === $latest->id)
                            @continue
                        @endif
                        
                        <a href="{{ route('selasanan.show', $e->slug) }}"
                           class="group bg-white rounded-2xl shadow border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
                            
                            {{-- Cover Image --}}
                            <div class="relative h-40">
                                @if($e->cover_image_path)
                                    <img src="{{ asset('storage/' . $e->cover_image_path) }}" 
                                         alt="{{ $e->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center">
                                        <i class="fas fa-book-open text-white text-3xl opacity-50"></i>
                                    </div>
                                @endif
                                
                                @if($e->audio_path)
                                    <span class="absolute top-3 right-3 bg-amber-500 text-white text-xs font-semibold px-2 py-1 rounded-full flex items-center gap-1 shadow">
                                        <i class="fas fa-headphones text-[9px]"></i>
                                        Audio
                                    </span>
                                @endif
                            </div>
                            
                            {{-- Content --}}
                            <div class="p-5">
                                <p class="text-xs text-emerald-600 font-medium mb-1">
                                    {{ \Carbon\Carbon::create($e->year, $e->month, 1)->locale('id')->translatedFormat('F Y') }},
                                    Minggu ke-{{ $e->week_of_month }}
                                </p>
                                <h4 class="text-lg font-bold text-gray-900 group-hover:text-emerald-700 transition-colors line-clamp-2">
                                    {{ $e->title }}
                                </h4>
                                <p class="text-sm text-gray-500 mt-2">
                                    Senin, {{ $e->monday_date->locale('id')->translatedFormat('d M Y') }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $entries->links() }}
                </div>
            </div>
        @else
            <div class="mt-12 text-center py-12 bg-white rounded-2xl shadow border border-gray-100">
                <i class="fas fa-book-open text-gray-300 text-5xl mb-4"></i>
                <p class="text-gray-500">Belum ada jurnal Selasanan yang dipublikasikan.</p>
            </div>
        @endif
    </div>
</section>
@endsection
