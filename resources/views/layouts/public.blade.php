<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pondok Pesantren Al-Anwar Pakijangan</title>
    <meta name="description" content="Selamat datang di website resmi Pondok Pesantren Al-Anwar Pakijangan. Kami menyatukan pendidikan berkualitas dengan nilai-nilai Islam untuk membentuk generasi berkarakter. Informasi pendaftaran santri baru (PSB)."> 
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @livewireStyles
    @stack('styles')
    <!-- FORCE LIGHT MODE (jalankan sebelum CSS/Tailwind untuk cegah FOUC) -->
<script>
  (function () {
    // Buang jejak dark mode sebelumnya & paksa terang
    document.documentElement.classList.remove('dark');
    try { localStorage.setItem('theme', 'light'); } catch (e) {}
  })();
</script>

<!-- Konfigurasi Tailwind CDN: dark mode berbasis class (tidak otomatis ikut OS) -->
<script>
  window.tailwind = {
    config: {
      darkMode: 'class',
      theme: { extend: {} }
    }
  };
</script>

<!-- Tailwind (CDN) - PASTIKAN HANYA ADA SATU INI DI SELURUH APLIKASI -->
<script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>

<!-- Paksa komponen bawaan browser pakai tema terang -->
<style>
  :root { color-scheme: light; } /* form, scrollbar, input caret, dll tetap terang */
</style>

<!-- (Opsional) Warna address bar/toolbar mobile -->
<meta name="theme-color" content="#FDFDFC">

</head>

<body class="bg-[#FDFDFC] text-[#1b1b18] min-h-screen flex flex-col">
    
    @include('layouts.nav')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('layouts.footer')

    @livewireScripts
    @stack('scripts')
</body>
</html>