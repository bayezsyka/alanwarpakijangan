@extends('layouts.public')

@section('title', 'Pendaftaran Santri Baru - Pesantren Al-Anwar')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('content')
<div class="bg-gray-50 flex items-center justify-center p-4 pt-24 pb-12 min-h-screen">
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg overflow-hidden">
        
        {{-- Header dengan skema warna baru --}}
        <div class="bg-[#008362] p-6 text-white">
            <h1 class="text-2xl font-bold">Pendaftaran Santri Baru</h1>
            <p class="text-sm opacity-90">Pondok Pesantren Al-Anwar Pakijangan</p>
        </div>

        {{-- Konten "Pendaftaran Ditutup" --}}
        <div class="p-8 md:p-16 text-center">
            
            {{-- Ikon --}}
            <div class="w-24 h-24 bg-gray-100 rounded-full p-4 flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-info-circle text-5xl text-[#008362]"></i>
            </div>
            
            {{-- Judul --}}
            <h2 class="text-3xl font-bold text-gray-800">
                Pendaftaran Telah Ditutup
            </h2>
            
            {{-- Paragraf Penjelasan --}}
            <p class="text-gray-600 mt-4 max-w-md mx-auto">
                Mohon maaf, periode pendaftaran untuk saat ini sudah berakhir. Informasi pendaftaran untuk periode selanjutnya akan diumumkan kembali di halaman ini. Terima kasih.
            </p>
            
            {{-- Tombol Kembali --}}
            <div class="mt-8">
                <a href="{{ route('welcome') }}" class="inline-block px-8 py-3 bg-[#008362] text-white font-medium rounded-lg hover:bg-[#006F53] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#008362] transition-colors duration-300">
                    Kembali ke Beranda
                </a>
            </div>

        </div>

    </div>
</div>
@endsection

{{-- Script tidak lagi diperlukan karena formnya sudah tidak ada --}}
@push('scripts')
@endpush