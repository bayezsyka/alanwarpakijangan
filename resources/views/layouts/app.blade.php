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
<body class="font-sans antialiased bg-gradient-to-br from-green-50 via-white to-green-50 text-gray-800">
    <div class="min-h-screen">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white/80 backdrop-blur border-b border-green-100 shadow-sm">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-xs uppercase tracking-wide text-green-500 font-semibold">Panel Admin</p>
                        <div class="text-2xl font-semibold text-gray-800">{{ $header }}</div>
                    </div>
                </div>
            </header>
        @endisset

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
            {{ $slot }}
        </main>
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
