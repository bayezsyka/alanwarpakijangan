<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pondok Pesantren Al-Anwar Pakijangan</title>
    <meta name="description" content="Selamat datang di website resmi Pondok Pesantren Al-Anwar Pakijangan. Kami menyatukan pendidikan berkualitas dengan nilai-nilai Islam untuk membentuk generasi berkarakter.">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.webp') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <!-- FORCE LIGHT MODE (jalankan sebelum CSS/Tailwind untuk cegah FOUC) -->
    <script>
      (function () {
        // Buang jejak dark mode sebelumnya & paksa terang
        document.documentElement.classList.remove('dark');
        try { localStorage.setItem('theme', 'light'); } catch (e) {}
      })();
    </script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>

<body class="bg-[#FDFDFC] text-[#1b1b18] min-h-screen flex flex-col">
    
    @include('layouts.nav')

    {{-- Main content with padding for fixed navbar --}}
    {{-- Landing page (/) has fullscreen hero, so no padding needed --}}
    {{-- Other pages need padding to not overlap with navbar --}}
    @php
        $isLanding = request()->is('/');
    @endphp
    <main class="flex-grow {{ $isLanding ? '' : 'pt-16 sm:pt-20' }}">
        @yield('content')
    </main>

    @include('layouts.footer')

    @livewireScripts
    @stack('scripts')
</body>
</html>
