<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- 
        Placeholder untuk judul halaman. 
        Setiap halaman bisa menentukan judulnya sendiri. 
        Jika tidak, judul default 'Pesantren Al-Anwar' akan digunakan.
    --}}
    <title>@yield('title', 'Pesantren Al-Anwar')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex flex-col">
    
    {{-- Memanggil Navigasi yang sama untuk semua halaman --}}
    @include('layouts.nav')

    {{-- 
        Ini adalah bagian paling penting.
        @yield('content') adalah "slot" kosong di mana konten unik 
        dari setiap halaman (seperti daftar artikel, form pendaftaran, dll) 
        akan disisipkan.
    --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Memanggil Footer yang sama untuk semua halaman --}}
    @include('layouts.footer')

    {{-- Script Livewire diletakkan sebelum penutup body --}}
    @livewireScripts
    @stack('scripts')
</body>
</html>