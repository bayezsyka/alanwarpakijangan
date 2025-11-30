<nav x-data="{ open: false }" class="relative z-40">

    {{-- SIDEBAR DESKTOP --}}
    <div class="hidden lg:flex lg:flex-col lg:fixed lg:inset-y-0 lg:left-0 lg:w-64
                bg-gradient-to-b from-emerald-800 via-emerald-700 to-emerald-600
                text-emerald-50 shadow-xl">

        {{-- Logo + brand --}}
        <div class="flex items-center justify-between h-16 px-4 border-b border-emerald-500/30">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}"
                     alt="Logo"
                     class="h-10 w-10 rounded-2xl bg-white/10 p-1.5">
                <div>
                    <p class="text-sm font-semibold tracking-wide">Admin Al-Anwar</p>
                    <p class="text-[11px] text-emerald-100/80">Panel Pengelolaan</p>
                </div>
            </a>
        </div>

        @php
            $linkBase = 'group flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 border';
            $linkActive = 'bg-emerald-900/40 text-white border-emerald-300/60 shadow-inner';
            $linkInactive = 'text-emerald-100/80 border-transparent hover:bg-emerald-900/30 hover:border-emerald-300/30 hover:text-white';
        @endphp

        {{-- Menu scrollable --}}
        <div class="flex-1 overflow-y-auto py-4 space-y-6">

            {{-- Menu utama --}}
            <div>
                <p class="px-4 mb-2 text-[11px] font-semibold uppercase tracking-[0.18em] text-emerald-100/60">
                    Menu utama
                </p>

                <nav class="space-y-1">
                    <a href="{{ route('dashboard') }}"
                       class="{{ request()->routeIs('dashboard') ? $linkBase.' '.$linkActive : $linkBase.' '.$linkInactive }}">
                        <i class="fas fa-tachometer-alt mr-3 text-emerald-200 group-hover:text-emerald-100"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.artikel.index') }}"
                       class="{{ request()->routeIs('admin.artikel.*') ? $linkBase.' '.$linkActive : $linkBase.' '.$linkInactive }}">
                        <i class="fas fa-newspaper mr-3 text-emerald-200 group-hover:text-emerald-100"></i>
                        <span>Artikel</span>
                    </a>

                    <a href="{{ route('admin.events.index') }}"
                       class="{{ request()->routeIs('admin.events.*') ? $linkBase.' '.$linkActive : $linkBase.' '.$linkInactive }}">
                        <i class="fas fa-calendar-alt mr-3 text-emerald-200 group-hover:text-emerald-100"></i>
                        <span>Agenda / Kegiatan</span>
                    </a>
                </nav>
            </div>

            {{-- Manajemen --}}
            <div>
                <p class="px-4 mb-2 text-[11px] font-semibold uppercase tracking-[0.18em] text-emerald-100/60">
                    Manajemen
                </p>

                <nav class="space-y-1">
                    <a href="{{ route('admin.categories.index') }}"
                       class="{{ request()->routeIs('admin.categories.*') ? $linkBase.' '.$linkActive : $linkBase.' '.$linkInactive }}">
                        <i class="fas fa-tags mr-3 text-emerald-200 group-hover:text-emerald-100"></i>
                        <span>Kategori</span>
                    </a>

                    <a href="{{ route('admin.rutinan.index') }}"
                       class="{{ request()->routeIs('admin.rutinan.*') ? $linkBase.' '.$linkActive : $linkBase.' '.$linkInactive }}">
                        <i class="fas fa-mosque mr-3 text-emerald-200 group-hover:text-emerald-100"></i>
                        <span>Rutinan</span>
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                       class="{{ request()->routeIs('admin.users.*') ? $linkBase.' '.$linkActive : $linkBase.' '.$linkInactive }}">
                        <i class="fas fa-users mr-3 text-emerald-200 group-hover:text-emerald-100"></i>
                        <span>Users</span>
                    </a>

                    <a href="{{ route('admin.logs.index') }}"
                       class="{{ request()->routeIs('admin.logs.*') ? $linkBase.' '.$linkActive : $linkBase.' '.$linkInactive }}">
                        <i class="fas fa-clipboard-list mr-3 text-emerald-200 group-hover:text-emerald-100"></i>
                        <span>Log Aktivitas</span>
                    </a>
                </nav>
            </div>
        </div>

        {{-- Footer user + logout --}}
        <div class="border-t border-emerald-500/30 px-4 py-3">
            <div class="flex items-center justify-between gap-3 text-xs">
                <div>
                    <p class="font-semibold text-emerald-50">
                        {{ Auth::user()->name ?? 'Admin' }}
                    </p>
                    <p class="text-emerald-100/80">
                        {{ Auth::user()->email ?? '' }}
                    </p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center px-3 py-2 text-[11px] font-semibold rounded-xl
                                   border border-emerald-300/50 bg-emerald-900/40 hover:bg-emerald-900/60">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- TOP BAR + DRAWER MOBILE --}}
    <div class="lg:hidden">

        {{-- Top bar (mobile) --}}
        <div class="flex items-center justify-between h-14 px-4 bg-white shadow-sm">
            <div class="flex items-center gap-2">
                <button @click="open = true"
                        class="inline-flex items-center justify-center w-9 h-9 rounded-xl
                               border border-emerald-100 bg-emerald-50 text-emerald-700
                               focus:outline-none focus:ring-2 focus:ring-emerald-500/70">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M4 6h16M4 12h16M4 18h10" />
                    </svg>
                </button>
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}"
                         alt="Logo"
                         class="h-8 w-8 rounded-2xl bg-emerald-50 p-1">
                    <div>
                        <p class="text-sm font-semibold text-emerald-800">Admin Al-Anwar</p>
                        <p class="text-[11px] text-emerald-500">Dashboard</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <span class="text-xs text-gray-500">
                    {{ Auth::user()->name ?? '' }}
                </span>
            </div>
        </div>

        {{-- Drawer mobile --}}
        <div x-show="open" x-cloak class="fixed inset-0 z-50">
            <div class="absolute inset-0 bg-emerald-950/40" @click="open = false"></div>

            <div class="absolute inset-y-0 left-0 w-64
                        bg-gradient-to-b from-emerald-800 via-emerald-700 to-emerald-600
                        shadow-xl flex flex-col">

                <div class="flex items-center justify-between h-14 px-4 border-b border-emerald-500/30">
                    <div class="flex items-center gap-2 text-emerald-50">
                        <img src="{{ asset('images/logo.png') }}"
                             alt="Logo"
                             class="h-8 w-8 rounded-2xl bg-white/10 p-1">
                        <div>
                            <p class="text-sm font-semibold">Admin Al-Anwar</p>
                            <p class="text-[11px] text-emerald-100/70">Panel Pengelolaan</p>
                        </div>
                    </div>
                    <button @click="open = false"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-xl
                                   bg-emerald-900/40 text-emerald-50
                                   focus:outline-none focus:ring-2 focus:ring-emerald-300/80">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto py-4 space-y-6 text-emerald-50">
                    <nav class="px-2 space-y-1">
                        <a href="{{ route('dashboard') }}"
                           class="group flex items-center px-3 py-2.5 rounded-xl text-sm font-medium border
                                  {{ request()->routeIs('dashboard')
                                        ? 'bg-emerald-900/40 text-white border-emerald-300/60'
                                        : 'text-emerald-100/90 border-transparent hover:bg-emerald-900/30 hover:border-emerald-300/30' }}">
                            <i class="fas fa-tachometer-alt mr-3 text-emerald-200 group-hover:text-emerald-100"></i>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('admin.artikel.index') }}"
                           class="group flex items-center px-3 py-2.5 rounded-xl text-sm font-medium border
                                  {{ request()->routeIs('admin.artikel.*')
                                        ? 'bg-emerald-900/40 text-white border-emerald-300/60'
                                        : 'text-emerald-100/90 border-transparent hover:bg-emerald-900/30 hover:border-emerald-300/30' }}">
                            <i class="fas fa-newspaper mr-3 text-emerald-200 group-hover:text-emerald-100"></i>
                            <span>Artikel</span>
                        </a>

                        <a href="{{ route('admin.events.index') }}"
                           class="group flex items-center px-3 py-2.5 rounded-xl text-sm font-medium border
                                  {{ request()->routeIs('admin.events.*')
                                        ? 'bg-emerald-900/40 text-white border-emerald-300/60'
                                        : 'text-emerald-100/90 border-transparent hover:bg-emerald-900/30 hover:border-emerald-300/30' }}">
                            <i class="fas fa-calendar-alt mr-3 text-emerald-200 group-hover:text-emerald-100"></i>
                            <span>Agenda / Kegiatan</span>
                        </a>

                        <a href="{{ route('admin.categories.index') }}"
                           class="group flex items-center px-3 py-2.5 rounded-xl text-sm font-medium border
                                  {{ request()->routeIs('admin.categories.*')
                                        ? 'bg-emerald-900/40 text-white border-emerald-300/60'
                                        : 'text-emerald-100/90 border-transparent hover:bg-emerald-900/30 hover:border-emerald-300/30' }}">
                            <i class="fas fa-tags mr-3 text-emerald-200 group-hover:text-emerald-100"></i>
                            <span>Kategori</span>
                        </a>

                        <a href="{{ route('admin.rutinan.index') }}"
                           class="group flex items-center px-3 py-2.5 rounded-xl text-sm font-medium border
                                  {{ request()->routeIs('admin.rutinan.*')
                                        ? 'bg-emerald-900/40 text-white border-emerald-300/60'
                                        : 'text-emerald-100/90 border-transparent hover:bg-emerald-900/30 hover:border-emerald-300/30' }}">
                            <i class="fas fa-mosque mr-3 text-emerald-200 group-hover:text-emerald-100"></i>
                            <span>Rutinan</span>
                        </a>

                        <a href="{{ route('admin.users.index') }}"
                           class="group flex items-center px-3 py-2.5 rounded-xl text-sm font-medium border
                                  {{ request()->routeIs('admin.users.*')
                                        ? 'bg-emerald-900/40 text-white border-emerald-300/60'
                                        : 'text-emerald-100/90 border-transparent hover:bg-emerald-900/30 hover:border-emerald-300/30' }}">
                            <i class="fas fa-users mr-3 text-emerald-200 group-hover:text-emerald-100"></i>
                            <span>Users</span>
                        </a>

                        <a href="{{ route('admin.logs.index') }}"
                           class="group flex items-center px-3 py-2.5 rounded-xl text-sm font-medium border
                                  {{ request()->routeIs('admin.logs.*')
                                        ? 'bg-emerald-900/40 text-white border-emerald-300/60'
                                        : 'text-emerald-100/90 border-transparent hover:bg-emerald-900/30 hover:border-emerald-300/30' }}">
                            <i class="fas fa-clipboard-list mr-3 text-emerald-200 group-hover:text-emerald-100"></i>
                            <span>Log Aktivitas</span>
                        </a>
                    </nav>
                </div>

                <div class="border-t border-emerald-500/30 px-4 py-3">
                    <div class="flex items-center justify-between gap-3 text-xs">
                        <div>
                            <p class="font-semibold text-emerald-50">
                                {{ Auth::user()->name ?? 'Admin' }}
                            </p>
                            <p class="text-emerald-100/80">
                                {{ Auth::user()->email ?? '' }}
                            </p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center px-3 py-2 text-[11px] font-semibold rounded-xl
                                           border border-emerald-300/50 bg-emerald-900/40 hover:bg-emerald-900/60">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</nav>
