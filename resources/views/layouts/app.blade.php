<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Al-Anwar</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Fonts dan Tailwind (boleh tetap CDN jika tidak pakai PostCSS) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.0/dist/tailwind.min.css" rel="stylesheet">
    <!-- SweetAlert dan Quill tetap CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Vite (ini yang akan load Chart.js + chartjs-chart-matrix dari npm) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireScripts
</head>
<body class="font-sans antialiased">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen bg-gray-50 flex">
        @include('layouts.navigation')

        <div class="flex-1 flex flex-col min-h-screen lg:ml-72">
            <!-- Topbar untuk mobile -->
            <div class="lg:hidden sticky top-0 z-20 bg-white shadow-sm border-b border-gray-100">
                <div class="flex items-center justify-between px-4 py-3">
                    <div class="flex items-center space-x-3">
                        <button @click="sidebarOpen = true" class="p-2 rounded-lg text-emerald-600 hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-emerald-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <div>
                            <p class="text-sm text-gray-500">Panel Admin</p>
                            <p class="text-base font-semibold text-emerald-700">Al-Anwar</p>
                        </div>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-200">
                        Profil
                    </a>
                </div>
            </div>

            @isset($header)
                <header class="bg-white shadow-sm border-b border-gray-100">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1">
                {{ $slot }}
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

    {{-- 🚫 Hapus baris ini karena konflik --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
</body>
</html>
