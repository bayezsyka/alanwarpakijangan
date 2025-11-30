@php
    $linkBase = 'flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition';
    $linkActive = 'bg-white/15 text-white shadow-inner';
    $linkIdle = 'bg-white/5 text-white hover:bg-white/10';
@endphp

<nav aria-label="Sidebar" class="z-30">
    <!-- Sidebar Desktop -->
    <aside class="hidden lg:flex fixed inset-y-0 left-0 w-72 bg-gradient-to-b from-emerald-700 via-emerald-600 to-emerald-700 text-white shadow-xl">
        <div class="flex flex-col w-full">
            <div class="px-6 py-6 border-b border-white/10 flex items-center space-x-3">
                <a href="{{ route('welcome') }}" class="flex items-center space-x-3">
                    <div class="bg-white/10 backdrop-blur p-2 rounded-xl">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-9 w-auto">
                    </div>
                    <div>
                        <p class="text-sm text-emerald-100">Panel Admin</p>
                        <p class="text-lg font-semibold">Al-Anwar</p>
                    </div>
                </a>
            </div>

            <div class="flex-1 overflow-y-auto py-6">
                <div class="px-5 text-xs uppercase tracking-[0.2em] text-emerald-100/70">Navigasi Utama</div>
                <div class="mt-3 space-y-2 px-3">
                    <a href="{{ route('dashboard') }}" class="{{ $linkBase }} {{ request()->routeIs('dashboard') ? $linkActive : $linkIdle }} justify-between w-full">
                        <div class="flex items-center space-x-3">
                            <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-white/10 text-white">
                                <i class="fas fa-home"></i>
                            </span>
                            <span>Dasbor</span>
                        </div>
                        <span class="text-xs text-emerald-100/80">Ikhtisar</span>
                    </a>
                </div>

                <div class="mt-6 px-5 text-xs uppercase tracking-[0.2em] text-emerald-100/70">Konten</div>
                <div class="mt-3 space-y-2 px-3">
                    <a href="{{ route('admin.artikel.index') }}" class="{{ $linkBase }} {{ request()->routeIs('admin.artikel.*') ? $linkActive : $linkIdle }}">
                        <span class="inline-flex items-center justify-center w-9 h-9 mr-3 rounded-lg bg-white/10 text-white">
                            <i class="fas fa-newspaper"></i>
                        </span>
                        <span>Artikel</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="{{ $linkBase }} {{ request()->routeIs('admin.categories.*') ? $linkActive : $linkIdle }}">
                        <span class="inline-flex items-center justify-center w-9 h-9 mr-3 rounded-lg bg-white/10 text-white">
                            <i class="fas fa-tags"></i>
                        </span>
                        <span>Kategori</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="{{ $linkBase }} {{ request()->routeIs('admin.users.*') ? $linkActive : $linkIdle }}">
                        <span class="inline-flex items-center justify-center w-9 h-9 mr-3 rounded-lg bg-white/10 text-white">
                            <i class="fas fa-users"></i>
                        </span>
                        <span>Pengguna</span>
                    </a>
                </div>

                <div class="mt-6 px-5 text-xs uppercase tracking-[0.2em] text-emerald-100/70">Program & Jadwal</div>
                <div class="mt-3 space-y-2 px-3 pb-4">
                    <a href="{{ route('admin.events.index') }}" class="{{ $linkBase }} {{ request()->routeIs('admin.events.*') ? $linkActive : $linkIdle }}">
                        <span class="inline-flex items-center justify-center w-9 h-9 mr-3 rounded-lg bg-white/10 text-white">
                            <i class="fas fa-images"></i>
                        </span>
                        <span>Galeri & Acara</span>
                    </a>
                    <a href="{{ route('admin.rutinan.index') }}" class="{{ $linkBase }} {{ request()->routeIs('admin.rutinan.*') ? $linkActive : $linkIdle }}">
                        <span class="inline-flex items-center justify-center w-9 h-9 mr-3 rounded-lg bg-white/10 text-white">
                            <i class="fas fa-clock"></i>
                        </span>
                        <span>Jadwal Rutinan</span>
                    </a>
                    <a href="{{ route('admin.logs.index') }}" class="{{ $linkBase }} {{ request()->routeIs('admin.logs.index') ? $linkActive : $linkIdle }}">
                        <span class="inline-flex items-center justify-center w-9 h-9 mr-3 rounded-lg bg-white/10 text-white">
                            <i class="fas fa-history"></i>
                        </span>
                        <span>Log Aktivitas</span>
                    </a>
                </div>
            </div>

            <div class="px-4 py-5 border-t border-white/10 bg-emerald-800/30">
                <div class="flex items-center space-x-3">
                    <div class="h-11 w-11 rounded-full bg-white/15 flex items-center justify-center text-white">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-emerald-100/80 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <div class="mt-4 space-y-2">
                    <a href="{{ route('profile.edit') }}" class="flex items-center justify-center w-full px-4 py-2.5 rounded-lg bg-white/10 text-sm font-semibold text-white hover:bg-white/20">
                        <i class="fas fa-user-cog mr-2"></i> Kelola Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center justify-center w-full px-4 py-2.5 rounded-lg bg-white text-emerald-700 font-semibold text-sm hover:bg-emerald-50">
                            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Sidebar Mobile -->
    <div class="lg:hidden" x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="fixed inset-0 z-40 bg-black/50" @click="sidebarOpen = false"></div>
        <aside class="fixed inset-y-0 left-0 z-50 w-72 bg-gradient-to-b from-emerald-700 via-emerald-600 to-emerald-700 text-white shadow-2xl flex flex-col">
            <div class="px-5 py-5 border-b border-white/10 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="bg-white/10 p-2 rounded-xl">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto">
                    </div>
                    <div>
                        <p class="text-xs text-emerald-100">Panel Admin</p>
                        <p class="text-base font-semibold">Al-Anwar</p>
                    </div>
                </div>
                <button @click="sidebarOpen = false" class="p-2 rounded-lg hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/40">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto py-5">
                <div class="px-5 text-xs uppercase tracking-[0.2em] text-emerald-100/70">Navigasi Utama</div>
                <div class="mt-3 space-y-2 px-3">
                    <a href="{{ route('dashboard') }}" class="{{ $linkBase }} {{ request()->routeIs('dashboard') ? $linkActive : $linkIdle }}">
                        <i class="fas fa-home mr-3"></i>
                        <span>Dasbor</span>
                    </a>
                </div>

                <div class="mt-6 px-5 text-xs uppercase tracking-[0.2em] text-emerald-100/70">Konten</div>
                <div class="mt-3 space-y-2 px-3">
                    <a href="{{ route('admin.artikel.index') }}" class="{{ $linkBase }} {{ request()->routeIs('admin.artikel.*') ? $linkActive : $linkIdle }}">
                        <i class="fas fa-newspaper mr-3"></i>
                        <span>Artikel</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="{{ $linkBase }} {{ request()->routeIs('admin.categories.*') ? $linkActive : $linkIdle }}">
                        <i class="fas fa-tags mr-3"></i>
                        <span>Kategori</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="{{ $linkBase }} {{ request()->routeIs('admin.users.*') ? $linkActive : $linkIdle }}">
                        <i class="fas fa-users mr-3"></i>
                        <span>Pengguna</span>
                    </a>
                </div>

                <div class="mt-6 px-5 text-xs uppercase tracking-[0.2em] text-emerald-100/70">Program & Jadwal</div>
                <div class="mt-3 space-y-2 px-3">
                    <a href="{{ route('admin.events.index') }}" class="{{ $linkBase }} {{ request()->routeIs('admin.events.*') ? $linkActive : $linkIdle }}">
                        <i class="fas fa-images mr-3"></i>
                        <span>Galeri & Acara</span>
                    </a>
                    <a href="{{ route('admin.rutinan.index') }}" class="{{ $linkBase }} {{ request()->routeIs('admin.rutinan.*') ? $linkActive : $linkIdle }}">
                        <i class="fas fa-clock mr-3"></i>
                        <span>Jadwal Rutinan</span>
                    </a>
                    <a href="{{ route('admin.logs.index') }}" class="{{ $linkBase }} {{ request()->routeIs('admin.logs.index') ? $linkActive : $linkIdle }}">
                        <i class="fas fa-history mr-3"></i>
                        <span>Log Aktivitas</span>
                    </a>
                </div>
            </div>

            <div class="px-4 py-5 border-t border-white/10 bg-emerald-800/30">
                <div class="flex items-center space-x-3">
                    <div class="h-11 w-11 rounded-full bg-white/15 flex items-center justify-center text-white">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-emerald-100/80 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <div class="mt-4 space-y-2">
                    <a href="{{ route('profile.edit') }}" class="flex items-center justify-center w-full px-4 py-2.5 rounded-lg bg-white/10 text-sm font-semibold text-white hover:bg-white/20">
                        <i class="fas fa-user-cog mr-2"></i> Kelola Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center justify-center w-full px-4 py-2.5 rounded-lg bg-white text-emerald-700 font-semibold text-sm hover:bg-emerald-50">
                            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </aside>
    </div>
</nav>
