<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Manajemen Selasanan | Admin Al-Anwar</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Quill (Editor artikel) -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">

    <div class="min-h-screen">
        <!-- Topbar -->
        <div class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ route('manage.selasanan.index') }}" class="font-semibold text-gray-800 hover:text-emerald-700">
                        Manajemen Selasanan
                    </a>
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-800">
                            Dashboard Admin
                        </a>
                    @endif
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600">{{ auth()->user()->name ?? '' }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:text-red-800">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @hasSection('header')
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="rounded-[24px] bg-gradient-to-r from-emerald-600 to-emerald-500 text-white shadow-lg shadow-emerald-900/30 px-6 py-5">
                    @yield('header')
                </div>
            </div>
        @endif

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mb-4 rounded-xl bg-emerald-50 border border-emerald-200 p-4 text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 rounded-xl bg-red-50 border border-red-200 p-4 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    @stack('scripts')
</body>
</html>
