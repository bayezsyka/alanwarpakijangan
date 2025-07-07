@extends('layouts.public')

@section('title', 'Artikel - Pesantren Al-Anwar')

@section('content')
<section class="py-8 sm:py-12 px-4 sm:px-6 lg:px-8 bg-gray-50 pt-24 pb-16">
    <div class="container mx-auto max-w-7xl">
        
        {{-- Seluruh logika tampilan dan pencarian sekarang ada di dalam komponen ini --}}
        @livewire('search-artikel-tamu')

    </div>
</section>
@endsection