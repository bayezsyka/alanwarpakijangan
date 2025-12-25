@extends('layouts.public')

@section('title', 'Artikel - Pesantren Al-Anwar')

@section('content')
<section class="bg-gray-50 pb-6 sm:pb-12">
    <div class="container mx-auto max-w-7xl">
        
        {{-- Seluruh logika tampilan dan pencarian sekarang ada di dalam komponen ini --}}
        @livewire('search-artikel-tamu')

    </div>
</section>
@endsection