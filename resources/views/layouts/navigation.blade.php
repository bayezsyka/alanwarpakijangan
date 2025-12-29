<nav x-data="{ open: false }" class="relative z-40">

    @php
        $isAdmin = Auth::check() && Auth::user()->isAdmin();
        $isSelasananManager = Auth::check() && Auth::user()->isSelasananManager() && !Auth::user()->isAdmin();
        $isPenulis =
            Auth::check() &&
            Auth::user()->isPenulis() &&
            !Auth::user()->isAdmin() &&
            !Auth::user()->isSelasananManager();

        $linkBase = 'group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200';
        $linkActive = 'bg-[#008362] text-white shadow-sm';
        $linkInactive = 'text-gray-700 hover:bg-gray-50 hover:text-[#008362]';
    @endphp

    {{-- ========== SIDEBAR DESKTOP (Semua Role) ========== --}}
    @if (Auth::check())
        <div
            class="hidden lg:flex lg:flex-col lg:fixed lg:inset-y-0 lg:left-0 lg:w-64 bg-white border-r border-gray-200 shadow-sm">

            {{-- Logo + Brand --}}
            <div class="flex items-center gap-3 h-16 px-4 border-b border-gray-200">
                <img src="{{ asset('images/logo.webp') }}" alt="Logo" class="h-10 w-10 rounded-lg">
                <div>
                    <p class="text-sm font-bold text-gray-900">
                        @if ($isAdmin)
                            Admin Al-Anwar
                        @elseif($isSelasananManager)
                            Pengurus Selasanan
                        @elseif($isPenulis)
                            Panel Penulis
                        @endif
                    </p>
                    <p class="text-xs text-gray-500">
                        @if ($isAdmin)
                            Panel Pengelolaan
                        @elseif($isSelasananManager)
                            Panel Pengelolaan
                        @elseif($isPenulis)
                            Kelola Artikel
                        @endif
                    </p>
                </div>
            </div>

            {{-- Menu Scrollable --}}
            <div class="flex-1 overflow-y-auto py-4 px-3">

                @if ($isAdmin)
                    {{-- Menu Admin --}}
                    <div class="mb-6">
                        <p class="px-3 mb-2 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Menu Utama
                        </p>
                        <nav class="space-y-1">
                            <a href="{{ route('dashboard') }}"
                                class="{{ request()->routeIs('dashboard') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                <i class="fas fa-tachometer-alt w-5 text-center"></i>
                                <span class="ml-3">Dashboard</span>
                            </a>
                            <a href="{{ route('admin.artikel.index') }}"
                                class="{{ request()->routeIs('admin.artikel.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                <i class="fas fa-newspaper w-5 text-center"></i>
                                <span class="ml-3">Artikel</span>
                            </a>
                            <a href="{{ route('admin.events.index') }}"
                                class="{{ request()->routeIs('admin.events.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                <i class="fas fa-calendar-alt w-5 text-center"></i>
                                <span class="ml-3">Agenda / Kegiatan</span>
                            </a>
                            <a href="{{ route('admin.announcements.index') }}"
                                class="{{ request()->routeIs('admin.announcements.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                <i class="fas fa-bullhorn w-5 text-center"></i>
                                <span class="ml-3">Pengumuman</span>
                            </a>
                        </nav>
                    </div>

                    <div>
                        <p class="px-3 mb-2 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Manajemen
                        </p>
                        <nav class="space-y-1">
                            <a href="{{ route('admin.categories.index') }}"
                                class="{{ request()->routeIs('admin.categories.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                <i class="fas fa-tags w-5 text-center"></i>
                                <span class="ml-3">Kategori</span>
                            </a>
                            <a href="{{ route('admin.rutinan.index') }}"
                                class="{{ request()->routeIs('admin.rutinan.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                <i class="fas fa-mosque w-5 text-center"></i>
                                <span class="ml-3">Rutinan</span>
                            </a>
                            <a href="{{ route('manage.selasanan.index') }}"
                                class="{{ request()->routeIs('manage.selasanan.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                <i class="fas fa-book-reader w-5 text-center"></i>
                                <span class="ml-3">Selasanan</span>
                            </a>
                            <a href="{{ route('admin.users.index') }}"
                                class="{{ request()->routeIs('admin.users.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                <i class="fas fa-users w-5 text-center"></i>
                                <span class="ml-3">Users</span>
                            </a>
                            <a href="{{ route('admin.logs.index') }}"
                                class="{{ request()->routeIs('admin.logs.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                <i class="fas fa-clipboard-list w-5 text-center"></i>
                                <span class="ml-3">Log Aktivitas</span>
                            </a>
                            @if (Auth::user()->isPenulis())
                                <a href="{{ route('penulis.articles.index') }}"
                                    class="{{ request()->routeIs('penulis.articles.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                    <i class="fas fa-edit w-5 text-center"></i>
                                    <span class="ml-3">Artikel Saya</span>
                                </a>
                            @endif
                        </nav>
                    </div>
                @elseif($isSelasananManager)
                    {{-- Menu Selasanan Manager --}}
                    <nav class="space-y-1">
                        <a href="{{ route('manage.selasanan.index') }}"
                            class="{{ request()->routeIs('manage.selasanan.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                            <i class="fas fa-book-reader w-5 text-center"></i>
                            <span class="ml-3">Manajemen Selasanan</span>
                        </a>
                        <a href="{{ route('selasanan.index') }}" target="_blank"
                            class="{{ $linkBase . ' ' . $linkInactive }}">
                            <i class="fas fa-external-link-alt w-5 text-center"></i>
                            <span class="ml-3">Lihat Halaman Publik</span>
                        </a>
                        @if (Auth::user()->isPenulis())
                            <a href="{{ route('penulis.articles.index') }}"
                                class="{{ request()->routeIs('penulis.articles.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                <i class="fas fa-edit w-5 text-center"></i>
                                <span class="ml-3">Artikel Saya</span>
                            </a>
                        @endif
                    </nav>
                @elseif($isPenulis)
                    {{-- Menu Penulis --}}
                    <nav class="space-y-1">
                        <a href="{{ route('penulis.articles.index') }}"
                            class="{{ request()->routeIs('penulis.articles.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                            <i class="fas fa-edit w-5 text-center"></i>
                            <span class="ml-3">Artikel Saya</span>
                        </a>
                        <a href="{{ route('welcome') }}" target="_blank"
                            class="{{ $linkBase . ' ' . $linkInactive }}">
                            <i class="fas fa-external-link-alt w-5 text-center"></i>
                            <span class="ml-3">Lihat Website</span>
                        </a>
                    </nav>
                @endif

            </div>

            {{-- Footer User + Logout --}}
            <div class="border-t border-gray-200 p-4">
                <div class="flex items-center justify-between gap-2">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-gray-900 truncate">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-xs text-gray-500 truncate">
                            {{ Auth::user()->email }}
                        </p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-3 py-2 text-xs font-medium rounded-lg
                                   border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 
                                   focus:outline-none focus:ring-2 focus:ring-[#008362] focus:ring-offset-2">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- ========== MOBILE VIEW (Semua Role) ========== --}}
    @if (Auth::check())
        <div class="lg:hidden">
            {{-- Top Bar Mobile --}}
            <div class="flex items-center justify-between h-14 px-4 bg-white border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <button @click="open = true"
                        class="inline-flex items-center justify-center w-9 h-9 rounded-lg
                               border border-gray-300 bg-white text-gray-700
                               hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#008362]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('images/logo.webp') }}" alt="Logo" class="h-8 w-8 rounded-lg">
                        <div>
                            <p class="text-sm font-bold text-gray-900">
                                @if ($isAdmin)
                                    Admin
                                @elseif($isSelasananManager)
                                    Selasanan
                                @elseif($isPenulis)
                                    Penulis
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <span class="text-xs text-gray-600 truncate max-w-[120px]">
                    {{ Auth::user()->name }}
                </span>
            </div>

            {{-- Mobile Drawer --}}
            <div x-show="open" x-cloak class="fixed inset-0 z-50">
                <div class="absolute inset-0 bg-gray-900/50" @click="open = false"></div>

                <div class="absolute inset-y-0 left-0 w-64 bg-white shadow-xl flex flex-col">

                    {{-- Drawer Header --}}
                    <div class="flex items-center justify-between h-14 px-4 border-b border-gray-200">
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('images/logo.webp') }}" alt="Logo" class="h-8 w-8 rounded-lg">
                            <div>
                                <p class="text-sm font-bold text-gray-900">
                                    @if ($isAdmin)
                                        Admin Al-Anwar
                                    @elseif($isSelasananManager)
                                        Pengurus Selasanan
                                    @elseif($isPenulis)
                                        Panel Penulis
                                    @endif
                                </p>
                            </div>
                        </div>
                        <button @click="open = false"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg
                                   text-gray-500 hover:bg-gray-100 focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Drawer Menu --}}
                    <div class="flex-1 overflow-y-auto py-4 px-3">

                        @if ($isAdmin)
                            {{-- Admin Menu Mobile --}}
                            <div class="mb-6">
                                <p class="px-3 mb-2 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Menu Utama
                                </p>
                                <nav class="space-y-1">
                                    <a href="{{ route('dashboard') }}"
                                        class="{{ request()->routeIs('dashboard') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                        <i class="fas fa-tachometer-alt w-5 text-center"></i>
                                        <span class="ml-3">Dashboard</span>
                                    </a>
                                    <a href="{{ route('admin.artikel.index') }}"
                                        class="{{ request()->routeIs('admin.artikel.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                        <i class="fas fa-newspaper w-5 text-center"></i>
                                        <span class="ml-3">Artikel</span>
                                    </a>
                                    <a href="{{ route('admin.events.index') }}"
                                        class="{{ request()->routeIs('admin.events.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                        <i class="fas fa-calendar-alt w-5 text-center"></i>
                                        <span class="ml-3">Agenda / Kegiatan</span>
                                    </a>
                                    <a href="{{ route('admin.announcements.index') }}"
                                        class="{{ request()->routeIs('admin.announcements.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                        <i class="fas fa-bullhorn w-5 text-center"></i>
                                        <span class="ml-3">Pengumuman</span>
                                    </a>
                                </nav>
                            </div>

                            <div>
                                <p class="px-3 mb-2 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Manajemen
                                </p>
                                <nav class="space-y-1">
                                    <a href="{{ route('admin.categories.index') }}"
                                        class="{{ request()->routeIs('admin.categories.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                        <i class="fas fa-tags w-5 text-center"></i>
                                        <span class="ml-3">Kategori</span>
                                    </a>
                                    <a href="{{ route('admin.rutinan.index') }}"
                                        class="{{ request()->routeIs('admin.rutinan.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                        <i class="fas fa-mosque w-5 text-center"></i>
                                        <span class="ml-3">Rutinan</span>
                                    </a>
                                    <a href="{{ route('manage.selasanan.index') }}"
                                        class="{{ request()->routeIs('manage.selasanan.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                        <i class="fas fa-book-reader w-5 text-center"></i>
                                        <span class="ml-3">Selasanan</span>
                                    </a>
                                    <a href="{{ route('admin.users.index') }}"
                                        class="{{ request()->routeIs('admin.users.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                        <i class="fas fa-users w-5 text-center"></i>
                                        <span class="ml-3">Users</span>
                                    </a>
                                    <a href="{{ route('admin.logs.index') }}"
                                        class="{{ request()->routeIs('admin.logs.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                        <i class="fas fa-clipboard-list w-5 text-center"></i>
                                        <span class="ml-3">Log Aktivitas</span>
                                    </a>
                                    @if (Auth::user()->isPenulis())
                                        <a href="{{ route('penulis.articles.index') }}"
                                            class="{{ request()->routeIs('penulis.articles.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                            <i class="fas fa-edit w-5 text-center"></i>
                                            <span class="ml-3">Artikel Saya</span>
                                        </a>
                                    @endif
                                </nav>
                            </div>
                        @elseif($isSelasananManager)
                            {{-- Selasanan Manager Menu Mobile --}}
                            <nav class="space-y-1">
                                <a href="{{ route('manage.selasanan.index') }}"
                                    class="{{ request()->routeIs('manage.selasanan.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                    <i class="fas fa-book-reader w-5 text-center"></i>
                                    <span class="ml-3">Manajemen Selasanan</span>
                                </a>
                                <a href="{{ route('selasanan.index') }}" target="_blank"
                                    class="{{ $linkBase . ' ' . $linkInactive }}">
                                    <i class="fas fa-external-link-alt w-5 text-center"></i>
                                    <span class="ml-3">Lihat Halaman Publik</span>
                                </a>
                                @if (Auth::user()->isPenulis())
                                    <a href="{{ route('penulis.articles.index') }}"
                                        class="{{ request()->routeIs('penulis.articles.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                        <i class="fas fa-edit w-5 text-center"></i>
                                        <span class="ml-3">Artikel Saya</span>
                                    </a>
                                @endif
                            </nav>
                        @elseif($isPenulis)
                            {{-- Penulis Menu Mobile --}}
                            <nav class="space-y-1">
                                <a href="{{ route('penulis.articles.index') }}"
                                    class="{{ request()->routeIs('penulis.articles.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                                    <i class="fas fa-edit w-5 text-center"></i>
                                    <span class="ml-3">Artikel Saya</span>
                                </a>
                                <a href="{{ route('welcome') }}" target="_blank"
                                    class="{{ $linkBase . ' ' . $linkInactive }}">
                                    <i class="fas fa-external-link-alt w-5 text-center"></i>
                                    <span class="ml-3">Lihat Website</span>
                                </a>
                            </nav>
                        @endif

                    </div>

                    {{-- Drawer Footer --}}
                    <div class="border-t border-gray-200 p-4">
                        <div class="flex items-center justify-between gap-2">
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-semibold text-gray-900 truncate">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-xs text-gray-500 truncate">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-2 text-xs font-medium rounded-lg
                                           border border-gray-300 bg-white text-gray-700 hover:bg-gray-50">
                                    <i class="fas fa-sign-out-alt mr-1"></i>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif
</nav>
