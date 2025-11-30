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
                
                <!-- Desktop Menu -->
                <div class="hidden sm:ml-10 sm:flex space-x-1">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="px-3 py-2 rounded-lg hover:bg-gray-50 transition-all">
                        <i class="fas fa-tachometer-alt mr-2 text-gray-400"></i>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    
                    <!-- Dropdown for Management -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all"
                                :class="{ 'bg-gray-100 text-gray-900': open || {{ request()->routeIs('admin.artikel.*') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.users.*') ? 'true' : 'false' }} }">
                            <i class="fas fa-cog mr-2 text-gray-400"></i>
                            {{ __('Management') }}
                            <svg class="ml-1 h-4 w-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" 
                             class="absolute z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none transition-all duration-200"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95">
                            <div class="py-1">
                                <x-dropdown-link :href="route('admin.artikel.index')" class="flex items-center px-4 py-2 hover:bg-gray-50">
                                    <i class="fas fa-newspaper mr-2 text-gray-400"></i>
                                    {{ __('Article Management') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.categories.index')" class="flex items-center px-4 py-2 hover:bg-gray-50">
                                    <i class="fas fa-tags mr-2 text-gray-400"></i>
                                    {{ __('Category Management') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.users.index')" class="flex items-center px-4 py-2 hover:bg-gray-50">
                                    <i class="fas fa-users mr-2 text-gray-400"></i>
                                    {{ __('User Management') }}
                                </x-dropdown-link>
                            </div>
                        </div>
                    </div>
                    <x-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.*')" class="px-3 py-2 rounded-lg hover:bg-gray-50 transition-all">
                        <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                        {{ __('Events Gallery') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('admin.rutinan.index')" :active="request()->routeIs('admin.rutinan.*')" class="px-3 py-2 rounded-lg hover:bg-gray-50 transition-all">
                        <i class="fas fa-clock mr-2 text-gray-400"></i>
                        {{ __('Regular Schedule') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('admin.logs.index')" :active="request()->routeIs('admin.logs.index')" class="px-3 py-2 rounded-lg hover:bg-gray-50 transition-all">
                        <i class="fas fa-history mr-2 text-gray-400"></i>
                        {{ __('Activity Log') }}
                    </x-nav-link>
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
