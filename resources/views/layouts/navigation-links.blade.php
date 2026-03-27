@php
    $linkBase = 'group flex items-center h-12 text-sm font-semibold rounded-xl transition-all duration-300 border border-transparent overflow-hidden px-0';
    $linkActive = 'bg-emerald-50 text-emerald-700 border-emerald-100 shadow-sm';
    $linkInactive = 'text-gray-500 hover:bg-gray-50 hover:text-emerald-600 hover:border-gray-100';
    $isAdmin = Auth::user() && Auth::user()->isAdmin();
    $isSelasananManager = Auth::user() && Auth::user()->isSelasananManager();
    $isPenulis = Auth::user() && Auth::user()->isPenulis();
@endphp

<div class="space-y-1">
    @if ($isAdmin)
        <div class="mb-4">
            <p :class="sidebarOpen ? 'opacity-100 translate-x-0' : 'lg:opacity-0 lg:-translate-x-4'" class="px-3 mb-2 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] transition-all duration-500 overflow-hidden whitespace-nowrap">
                Menu Utama
            </p>
            <nav class="space-y-1">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                    <div class="w-12 h-12 shrink-0 flex items-center justify-center">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <span :class="sidebarOpen ? 'opacity-100 max-w-xs' : 'lg:opacity-0 lg:max-w-0'" class="whitespace-nowrap font-bold transition-all duration-500 overflow-hidden">Dashboard</span>
                </a>
                <div x-data="{ hoverMenu: false }" @mouseenter="hoverMenu = true" @mouseleave="hoverMenu = false" class="relative group">
                    <a href="{{ route('admin.artikel.index') }}" class="{{ request()->routeIs('admin.artikel.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                        <div class="w-12 h-12 shrink-0 flex items-center justify-center">
                            <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2 2h-7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div :class="sidebarOpen ? 'opacity-100 max-w-xs' : 'lg:opacity-0 lg:max-w-0'" class="whitespace-nowrap font-bold transition-all duration-500 overflow-hidden flex-1 flex items-center justify-between pr-4">
                            <span>Kelola Artikel</span>
                            <svg class="w-4 h-4 transition-transform duration-300" :class="hoverMenu ? 'rotate-180': ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </a>
                    <div x-show="hoverMenu && sidebarOpen" x-transition.opacity style="display: none;" class="pl-12 pr-4 space-y-1 pb-2">
                        <a href="{{ route('admin.artikel.index') }}" class="block px-3 py-2 text-[10px] uppercase tracking-widest font-black text-gray-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all">Semua Artikel</a>
                        <a href="{{ route('admin.artikel.index', ['s' => 'published']) }}" class="block px-3 py-2 text-[10px] uppercase tracking-widest font-black text-gray-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all">Published</a>
                        <a href="{{ route('admin.artikel.index', ['s' => 'draft']) }}" class="block px-3 py-2 text-[10px] uppercase tracking-widest font-black text-gray-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all">Draft</a>
                        <a href="{{ route('admin.artikel.index', ['s' => 'archived']) }}" class="block px-3 py-2 text-[10px] uppercase tracking-widest font-black text-gray-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all">Archived</a>
                    </div>
                    {{-- Tooltip for mini mode --}}
                    <div x-show="hoverMenu && !sidebarOpen" style="display: none;" class="absolute hidden lg:block left-full top-0 ml-2 w-48 bg-white border border-gray-100 shadow-xl shadow-gray-200/50 rounded-2xl z-50 p-2">
                        <a href="{{ route('admin.artikel.index') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 rounded-xl transition-all">Semua Artikel</a>
                        <a href="{{ route('admin.artikel.index', ['s' => 'published']) }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 rounded-xl transition-all">Published</a>
                        <a href="{{ route('admin.artikel.index', ['s' => 'draft']) }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 rounded-xl transition-all">Draft</a>
                        <a href="{{ route('admin.artikel.index', ['s' => 'archived']) }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 rounded-xl transition-all">Archived</a>
                    </div>
                </div>
                <a href="{{ route('admin.events.index') }}" class="{{ request()->routeIs('admin.events.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                    <div class="w-12 h-12 shrink-0 flex items-center justify-center">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span :class="sidebarOpen ? 'opacity-100 max-w-xs' : 'lg:opacity-0 lg:max-w-0'" class="whitespace-nowrap font-bold transition-all duration-500 overflow-hidden">Galeri Kegiatan</span>
                </a>
                <a href="{{ route('admin.announcements.index') }}" class="{{ request()->routeIs('admin.announcements.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                    <div class="w-12 h-12 shrink-0 flex items-center justify-center">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </div>
                    <span :class="sidebarOpen ? 'opacity-100 max-w-xs' : 'lg:opacity-0 lg:max-w-0'" class="whitespace-nowrap font-bold transition-all duration-500 overflow-hidden">Pengumuman</span>
                </a>
            </nav>
        </div>

        <div class="mb-4">
            <p :class="sidebarOpen ? 'opacity-100 translate-x-0' : 'lg:opacity-0 lg:-translate-x-4'" class="px-3 mb-2 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] transition-all duration-500 overflow-hidden whitespace-nowrap">
                Sistem & Master
            </p>
            <nav class="space-y-1">
                <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                    <div class="w-12 h-12 shrink-0 flex items-center justify-center">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 11h10M7 15h10" />
                        </svg>
                    </div>
                    <span :class="sidebarOpen ? 'opacity-100 max-w-xs' : 'lg:opacity-0 lg:max-w-0'" class="whitespace-nowrap font-bold transition-all duration-500 overflow-hidden">Kategori</span>
                </a>
                <a href="{{ route('admin.rutinan.index') }}" class="{{ request()->routeIs('admin.rutinan.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                    <div class="w-12 h-12 shrink-0 flex items-center justify-center">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <span :class="sidebarOpen ? 'opacity-100 max-w-xs' : 'lg:opacity-0 lg:max-w-0'" class="whitespace-nowrap font-bold transition-all duration-500 overflow-hidden">Jadwal Rutinan</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                    <div class="w-12 h-12 shrink-0 flex items-center justify-center">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <span :class="sidebarOpen ? 'opacity-100 max-w-xs' : 'lg:opacity-0 lg:max-w-0'" class="whitespace-nowrap font-bold transition-all duration-500 overflow-hidden">Manajemen User</span>
                </a>
                <a href="{{ route('admin.logs.index') }}" class="{{ request()->routeIs('admin.logs.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                    <div class="w-12 h-12 shrink-0 flex items-center justify-center">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <span :class="sidebarOpen ? 'opacity-100 max-w-xs' : 'lg:opacity-0 lg:max-w-0'" class="whitespace-nowrap font-bold transition-all duration-500 overflow-hidden">Log Aktivitas</span>
                </a>
            </nav>
        </div>
    @endif

    @if ($isAdmin || $isSelasananManager)
        <div class="mb-4">
            <p :class="sidebarOpen ? 'opacity-100 translate-x-0' : 'lg:opacity-0 lg:-translate-x-4'" class="px-3 mb-2 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] transition-all duration-500 overflow-hidden whitespace-nowrap">
                Selasanan
            </p>
            <nav class="space-y-1">
                <a href="{{ route('manage.selasanan.index') }}" class="{{ request()->routeIs('manage.selasanan.*') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                    <div class="w-12 h-12 shrink-0 flex items-center justify-center">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span :class="sidebarOpen ? 'opacity-100 max-w-xs' : 'lg:opacity-0 lg:max-w-0'" class="whitespace-nowrap font-bold transition-all duration-500 overflow-hidden">Manage Jurnal</span>
                </a>
                <a href="{{ route('selasanan.index') }}" target="_blank" class="{{ $linkBase . ' ' . $linkInactive }}">
                    <div class="w-12 h-12 shrink-0 flex items-center justify-center">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </div>
                    <span :class="sidebarOpen ? 'opacity-100 max-w-xs' : 'lg:opacity-0 lg:max-w-0'" class="whitespace-nowrap font-bold transition-all duration-500 overflow-hidden">Halaman Publik</span>
                </a>
            </nav>
        </div>
    @endif

    @if ($isPenulis)
        <div class="mb-4">
            <p :class="sidebarOpen ? 'opacity-100 translate-x-0' : 'lg:opacity-0 lg:-translate-x-4'" class="px-3 mb-2 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] transition-all duration-500 overflow-hidden whitespace-nowrap">
                Penulis
            </p>
            <nav class="space-y-1">
                <a href="{{ route('penulis.articles.index') }}" class="{{ request()->routeIs('penulis.articles.*') && !request()->has('s') ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                    <div class="w-12 h-12 shrink-0 flex items-center justify-center">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2 2h-7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span :class="sidebarOpen ? 'opacity-100 max-w-xs' : 'lg:opacity-0 lg:max-w-0'" class="whitespace-nowrap font-bold transition-all duration-500 overflow-hidden">Semua Artikel</span>
                </a>
                
                <a href="{{ route('penulis.articles.index', ['s' => 'published']) }}" class="{{ request()->query('s') === 'published' ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                    <div class="w-12 h-12 shrink-0 flex items-center justify-center">
                       <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span :class="sidebarOpen ? 'opacity-100 max-w-xs' : 'lg:opacity-0 lg:max-w-0'" class="whitespace-nowrap font-bold transition-all duration-500 overflow-hidden">Published</span>
                </a>
                
                <a href="{{ route('penulis.articles.index', ['s' => 'draft']) }}" class="{{ request()->query('s') === 'draft' ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                    <div class="w-12 h-12 shrink-0 flex items-center justify-center">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <span :class="sidebarOpen ? 'opacity-100 max-w-xs' : 'lg:opacity-0 lg:max-w-0'" class="whitespace-nowrap font-bold transition-all duration-500 overflow-hidden">Draft</span>
                </a>
                
                <a href="{{ route('penulis.articles.index', ['s' => 'archived']) }}" class="{{ request()->query('s') === 'archived' ? $linkBase . ' ' . $linkActive : $linkBase . ' ' . $linkInactive }}">
                    <div class="w-12 h-12 shrink-0 flex items-center justify-center">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                    <span :class="sidebarOpen ? 'opacity-100 max-w-xs' : 'lg:opacity-0 lg:max-w-0'" class="whitespace-nowrap font-bold transition-all duration-500 overflow-hidden">Archived</span>
                </a>
            </nav>
        </div>
    @endif

    <div class="mb-4">
        <p :class="sidebarOpen ? 'opacity-100 translate-x-0' : 'lg:opacity-0 lg:-translate-x-4'" class="px-3 mb-2 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] transition-all duration-500 overflow-hidden whitespace-nowrap">
            Pintasan
        </p>
        <nav class="space-y-1">
            <a href="{{ route('welcome') }}" target="_blank" class="{{ $linkBase . ' ' . $linkInactive }}">
                <div class="w-12 h-12 shrink-0 flex items-center justify-center">
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9h18" />
                    </svg>
                </div>
                <span :class="sidebarOpen ? 'opacity-100 max-w-xs' : 'lg:opacity-0 lg:max-w-0'" class="whitespace-nowrap font-bold transition-all duration-500 overflow-hidden">Buka Website</span>
            </a>
        </nav>
    </div>
</div>
