<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- 🏷️ Primary SEO Meta Tags --}}
    <title>@yield('title', 'Pondok Pesantren Al-Anwar Pakijangan | Brebes')</title>
    <meta name="description" content="@yield('meta_description', 'Pondok Pesantren Al-Anwar Pakijangan di Bulakamba, Brebes mengembangkan pendidikan salaf modern, Madrasah Diniyah, SMP, dan pembinaan karakter santri.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Pondok Pesantren Al-Anwar Pakijangan, Ponpes Al-Anwar Pakijangan, PP Al-Anwar Pakijangan, pesantren Pakijangan, pesantren Bulakamba, pesantren Brebes, pesantren salaf modern Brebes, SMP Al Anwar Pakijangan, Madrasah Diniyah Al-Anwar Pakijangan, KH Anwar Mukhtar, KH Muhammad Miftah')">
    <meta name="author" content="@yield('meta_author', 'Pondok Pesantren Al-Anwar Pakijangan')">
    <meta name="robots" content="@yield('meta_robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1')">

    {{-- 🔗 Canonical URL --}}
    <link rel="canonical" href="@yield('canonical_url', \App\Support\SeoUrl::url(request()->path() === '/' ? '' : request()->path()))">

    {{-- 🌐 Open Graph / Facebook --}}
    <meta property="og:locale" content="id_ID">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="Pondok Pesantren Al-Anwar Pakijangan">
    <meta property="og:title" content="@yield('og_title', View::yieldContent('title', 'Pondok Pesantren Al-Anwar Pakijangan | Brebes'))">
    <meta property="og:description" content="@yield('og_description', View::yieldContent('meta_description', 'Pondok Pesantren Al-Anwar Pakijangan di Bulakamba, Brebes mengembangkan pendidikan salaf modern, Madrasah Diniyah, SMP, dan pembinaan karakter santri.'))">
    <meta property="og:url" content="@yield('og_url', View::yieldContent('canonical_url', \App\Support\SeoUrl::url(request()->path() === '/' ? '' : request()->path())))">
    <meta property="og:image" content="@yield('og_image', \App\Support\SeoUrl::assetUrl('images/landingpage/bgppdb.png'))">
    <meta property="og:image:alt" content="@yield('og_image_alt', 'Pondok Pesantren Al-Anwar Pakijangan Brebes')">

    {{-- 🐦 Twitter Card --}}
    <meta name="twitter:card" content="@yield('twitter_card', 'summary_large_image')">
    <meta name="twitter:title" content="@yield('twitter_title', View::yieldContent('og_title', View::yieldContent('title', 'Pondok Pesantren Al-Anwar Pakijangan | Brebes')))">
    <meta name="twitter:description" content="@yield('twitter_description', View::yieldContent('og_description', View::yieldContent('meta_description', 'Pondok Pesantren Al-Anwar Pakijangan di Bulakamba, Brebes mengembangkan pendidikan salaf modern, Madrasah Diniyah, SMP, dan pembinaan karakter santri.')))">
    <meta name="twitter:image" content="@yield('twitter_image', View::yieldContent('og_image', \App\Support\SeoUrl::assetUrl('images/landingpage/bgppdb.png')))">

    {{-- 📑 Page-Specific Meta Extensions --}}
    @stack('meta')

    {{-- 🏛️ Structured Data (JSON-LD) Organization on All Pages --}}
    <script type="application/ld+json">
    {!! json_encode(\App\Support\SeoUrl::organizationSchema(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    {{-- Additional Page-Specific Schemas --}}
    @stack('schema')

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.webp') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.webp') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:500,600,700|dm-sans:400,500,600,700" rel="stylesheet" />
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

<body class="bg-surface text-dark min-h-screen flex flex-col font-sans">
    
    @include('layouts.nav')

    {{-- Main content --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    @include('layouts.footer')

    @livewireScripts
    @stack('scripts')
</body>
</html>
