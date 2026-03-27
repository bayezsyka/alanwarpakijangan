<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Al-Anwar Pakijangan</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.webp') }}">

    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- CSS / Style -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        emerald: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                            950: '#052e16',
                        },
                    }
                }
            }
        }
    </script>

    <!-- SweetAlert & Quill -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Vite (if exists) -->
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        [x-cloak] {
            display: none !综合 !important;
        }

        .font-display {
            font-family: 'Outfit', sans-serif;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    @livewireStyles
    @stack('styles')
</head>

<body class="font-sans antialiased text-gray-800 bg-[#FAFBFC] h-full overflow-hidden">
    {{-- Global State Wrapper --}}
    <div x-data="{
        sidebarOpen: false,
        sidebarFixed: false,
        mobileMenuOpen: false,
        toggleSidebar() { 
            if (window.innerWidth < 1024) {
                this.mobileMenuOpen = !this.mobileMenuOpen;
            } else {
                this.sidebarFixed = !this.sidebarFixed;
                this.sidebarOpen = this.sidebarFixed;
            }
        }
    }"
        @resize.window="if(window.innerWidth < 1024) { sidebarFixed = false; sidebarOpen = false; mobileMenuOpen = false }"
        class="h-full flex overflow-hidden relative">

        {{-- Sidebar Container with Mini/Full State (Desktop Only) --}}
        <div class="z-50 h-full hidden lg:flex transition-all duration-500 ease-in-out border-r border-gray-100 bg-white" 
            :class="sidebarOpen ? 'w-64' : 'w-20'"
            @mouseenter="if(!sidebarFixed) sidebarOpen = true"
            @mouseleave="if(!sidebarFixed) sidebarOpen = false">
            @include('layouts.navigation')
        </div>

        {{-- Main Wrapper --}}
        <div class="flex-1 flex flex-col min-w-0 transition-all duration-500 relative overflow-hidden h-full">

            {{-- Modern Topbar --}}
            <header class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-40 h-16 flex items-center shrink-0">
                <div class="w-full max-w-7xl mx-auto flex items-center justify-between px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center gap-6">
                        {{-- Universal Sidebar Toggle --}}
                        <button @click="toggleSidebar()"
                            class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all shadow-sm border border-transparent hover:border-emerald-100 active:scale-95 group">
                            <svg class="h-5 w-5 transition-transform duration-300"
                                :class="(sidebarFixed || mobileMenuOpen) ? 'rotate-0' : 'rotate-180'" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path x-show="sidebarFixed || mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                <path x-show="!sidebarFixed && !mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        {{-- Dynamic Page Title (from Header Slot) --}}
                        <div class="flex items-center gap-4 transition-all duration-500">
                            @if (isset($header))
                                <div class="text-sm font-bold text-gray-800 uppercase tracking-widest flex items-center gap-2">
                                    {{ $header }}
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Right Side Toolbar --}}
                    <div class="flex items-center gap-4">
                        @auth
                            {{-- Profile Dropdown --}}
                            @php
                                $uRoles = Auth::user()->roles ?? [];
                                $uRoleLabel = 'User Guest';
                                if (in_array('admin', $uRoles)) {
                                    $uRoleLabel = 'Administrator';
                                } elseif (in_array('selasanan_manager', $uRoles)) {
                                    $uRoleLabel = 'Manajer Selasanan';
                                } elseif (in_array('penulis', $uRoles)) {
                                    $uRoleLabel = 'Penulis Konten';
                                }
                            @endphp
                            <div class="relative" x-data="{ userMenuOpen: false }">
                                <button @click="userMenuOpen = !userMenuOpen" @click.away="userMenuOpen = false"
                                    class="flex items-center gap-3 py-1.5 px-4 bg-gray-50 border border-gray-100 rounded-xl hover:bg-white hover:shadow-md transition-all group">
                                    <div class="text-right hidden sm:block">
                                        <p class="text-[12px] font-black text-gray-800 truncate leading-none mb-1">
                                            {{ Auth::user()->name }}</p>
                                        <p
                                            class="text-[9px] font-bold text-emerald-600 uppercase tracking-tighter leading-none">
                                            {{ $uRoleLabel }}</p>
                                    </div>
                                    <div class="p-1.5 bg-emerald-50 text-emerald-600 rounded-lg group-hover:bg-emerald-100 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-emerald-600 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                {{-- Dropdown Content --}}
                                <div x-show="userMenuOpen" x-cloak x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                    x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                                    class="absolute right-0 top-full mt-3 w-56 bg-white border border-gray-100 rounded-2xl shadow-2xl py-2 z-50 ring-1 ring-black/5">

                                    <div class="px-4 py-3 border-b border-gray-50 bg-gray-50/50 rounded-t-2xl mb-1">
                                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Username
                                            Aktif</p>
                                        <p class="text-xs font-bold text-gray-700 truncate">{{ Auth::user()->username }}</p>
                                    </div>

                                    <a href="{{ route('profile.edit') }}"
                                        class="flex items-center gap-2 px-4 py-2.5 text-sm font-bold text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-colors border-b border-gray-50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Profil Saya
                                    </a>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex items-center gap-2 px-4 py-2.5 text-sm font-bold text-red-500 hover:bg-red-50 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            Keluar Sistem
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </header>

            {{-- Mobile Dropdown Menu --}}
            <div x-show="mobileMenuOpen" 
                 x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-4"
                 class="lg:hidden absolute top-16 inset-x-0 z-40 bg-white border-b border-gray-100 shadow-xl overflow-y-auto max-h-[calc(100vh-4rem)]">
                 <div class="p-4 bg-white">
                    @include('layouts.navigation-links')
                 </div>
            </div>

            {{-- Content Area --}}
            <main class="flex-1 overflow-y-auto py-6 scroll-smooth h-full">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    @if (isset($slot) && $slot->isNotEmpty())
                        <div class="animate-in fade-in slide-in-from-bottom-2 duration-500">
                            {{ $slot }}
                        </div>
                    @else
                        <div class="animate-in fade-in slide-in-from-bottom-2 duration-500">
                            @yield('content')
                        </div>
                    @endif

                </div>
            </main>
        </div>
    </div>

    {{-- Universal Toast / Flash --}}
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                background: '#ffffff',
                iconColor: '#10b981',
                customClass: {
                    popup: 'rounded-2xl border border-gray-100 shadow-2xl',
                    title: 'text-gray-800 font-bold',
                    htmlContainer: 'text-gray-500 font-medium'
                }
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Opps!',
                text: '{{ session('error') }}',
                icon: 'error',
                timer: 4000,
                timerProgressBar: true,
                showConfirmButton: false,
                background: '#ffffff',
                iconColor: '#ef4444',
                customClass: {
                    popup: 'rounded-2xl border border-gray-100 shadow-2xl',
                    title: 'text-gray-800 font-bold',
                    htmlContainer: 'text-gray-500 font-medium'
                }
            });
        </script>
    @endif

    @livewireScripts
    @stack('scripts')
</body>

</html>
