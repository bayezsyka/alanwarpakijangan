{{-- 1. Memberitahu Blade untuk menggunakan layout induk --}}
@extends('layouts.public')

{{-- 2. Mengisi placeholder @yield('title') di layout induk --}}
@section('title', 'Pondok Pesantren Al-Anwar Pakijangan')

{{-- 3. Semua konten unik halaman ini dibungkus dalam @section('content') --}}
@section('content')
    @include('welcome.hero')
    @include('welcome.artikel')
    @include('welcome.profil')
    @include('welcome.galeri')
@endsection