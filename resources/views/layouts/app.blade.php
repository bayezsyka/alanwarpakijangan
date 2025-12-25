<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Al-Anwar</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.webp') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- FORCE LIGHT MODE (jalankan sebelum CSS/Tailwind untuk cegah FOUC) -->
    <script>
      (function () {
        document.documentElement.classList.remove('dark');
        try { localStorage.setItem('theme', 'light'); } catch (e) {}
      })();
    </script>

    <!-- Konfigurasi Tailwind CDN: dark mode berbasis class -->
    <script>
      window.tailwind = {
        config: {
          darkMode: 'class',
          theme: { extend: {} }
        }
      };
    </script>

    <!-- Tailwind CDN (kalau tidak pakai PostCSS full) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.0/dist/tailwind.min.css" rel="stylesheet">

    <!-- SweetAlert dan Quill -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Vite (Chart.js, dll) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireScripts
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        {{-- Sidebar / topbar --}}
        @include('layouts.navigation')

        {{-- Wrapper konten: geser karena sidebar --}}
        <div class="{{ (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isSelasananManager())) ? 'pt-14 lg:pt-0 lg:ml-64' : 'pt-20' }} transition-all duration-300">

            {{-- HEADER GLOBAL: kartu hijau untuk semua halaman --}}
            @isset($header)
                <header class="bg-transparent">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                        <div class="
                            rounded-[24px] md:rounded-[32px]
                            bg-gradient-to-r from-emerald-600 to-emerald-500
                            text-white shadow-lg shadow-emerald-900/30
                            px-6 py-5 sm:px-8 sm:py-6
                        ">
                            {{-- Isi header dari masing-masing halaman --}}
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="py-4">
                @if(isset($slot) && $slot->isNotEmpty())
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </main>
        </div>
    </div>

    <!-- Flash Message -->
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Gagal!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <!-- Stack untuk JS dari halaman -->
    @stack('scripts')

    {{-- Jangan pakai CDN Chart.js di sini, sudah lewat Vite --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
</body>
</html>
