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
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert dan Quill tetap CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Vite (ini yang akan load Chart.js + chartjs-chart-matrix dari npm) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireScripts
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
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
