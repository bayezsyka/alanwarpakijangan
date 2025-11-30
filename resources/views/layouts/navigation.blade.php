<nav x-data="{ open: false, dropdownOpen: false }" class="bg-white/90 backdrop-blur border-b border-green-100 shadow-sm sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-6">
                <a href="{{ route('welcome') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-9 w-auto" />
                    <div class="hidden sm:flex flex-col leading-tight">
                        <span class="text-sm font-semibold text-green-700">Admin Al-Anwar</span>
                        <span class="text-xs text-gray-500">Panel Pengelolaan</span>
                    </div>
                </a>

                <div class="hidden sm:flex items-center space-x-1">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i class="fas fa-house mr-2 text-green-500"></i>
                        <span>Dasbor</span>
                    </x-nav-link>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center px-3 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-green-800 hover:bg-green-50 border border-transparent hover:border-green-100"
                                :class="{ 'bg-green-50 border-green-100 text-green-800': open || {{ request()->routeIs('admin.artikel.*') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.users.*') ? 'true' : 'false' }} }">
                            <i class="fas fa-layer-group mr-2 text-green-500"></i>
                            <span>Manajemen Konten</span>
                            <svg class="ml-2 h-4 w-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false"
                             class="absolute z-10 mt-2 w-60 origin-top-left rounded-xl bg-white shadow-lg ring-1 ring-green-100 focus:outline-none"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95">
                            <div class="py-2">
                                <x-dropdown-link :href="route('admin.artikel.index')" class="flex items-center px-4 py-2 hover:bg-green-50">
                                    <i class="fas fa-newspaper mr-3 text-green-500"></i>
                                    <span>Artikel</span>
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.categories.index')" class="flex items-center px-4 py-2 hover:bg-green-50">
                                    <i class="fas fa-tags mr-3 text-green-500"></i>
                                    <span>Kategori</span>
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.users.index')" class="flex items-center px-4 py-2 hover:bg-green-50">
                                    <i class="fas fa-users mr-3 text-green-500"></i>
                                    <span>Pengguna</span>
                                </x-dropdown-link>
                            </div>
                        </div>
                    </div>

                    <x-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.*')">
                        <i class="fas fa-images mr-2 text-green-500"></i>
                        <span>Galeri & Acara</span>
                    </x-nav-link>

                    <x-nav-link :href="route('admin.rutinan.index')" :active="request()->routeIs('admin.rutinan.*')">
                        <i class="fas fa-clock mr-2 text-green-500"></i>
                        <span>Jadwal Rutin</span>
                    </x-nav-link>

                    <x-nav-link :href="route('admin.logs.index')" :active="request()->routeIs('admin.logs.index')">
                        <i class="fas fa-history mr-2 text-green-500"></i>
                        <span>Riwayat Aktivitas</span>
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-3 rounded-full border border-green-100 bg-green-50 px-3 py-1.5 text-sm font-semibold text-green-800 shadow-sm hover:shadow focus:outline-none focus:ring-2 focus:ring-green-200">
                        <div class="flex flex-col text-left leading-tight">
                            <span class="text-xs text-gray-500">Masuk sebagai</span>
                            <span>{{ Auth::user()->name }}</span>
                        </div>
                        <div class="h-9 w-9 rounded-full bg-green-100 flex items-center justify-center text-green-700 font-bold">
                            <i class="fas fa-user"></i>
                        </div>
                    </button>

                    <div x-show="open" @click.away="open = false"
                         class="origin-top-right absolute right-0 mt-2 w-56 rounded-xl shadow-lg py-2 bg-white ring-1 ring-green-100 focus:outline-none z-50"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95">
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center px-4 py-2 hover:bg-green-50">
                            <i class="fas fa-id-badge mr-3 text-green-500"></i>
                            <span>Profil</span>
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center px-4 py-2 hover:bg-green-50">
                                <i class="fas fa-sign-out-alt mr-3 text-green-500"></i>
                                <span>Keluar</span>
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-green-700 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-200 transition">
                    <span class="sr-only">Buka menu utama</span>
                    <svg class="block h-6 w-6" :class="{ 'hidden': open, 'block': !open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="hidden h-6 w-6" :class="{ 'block': open, 'hidden': !open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" @click.away="open = false"
         class="sm:hidden border-t border-green-100 bg-white/95 backdrop-blur"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">
        <div class="pt-4 pb-3 space-y-2 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center gap-3">
                <i class="fas fa-house text-green-500"></i>
                <span>Dasbor</span>
            </x-responsive-nav-link>

            <div class="px-1">
                <button @click="dropdownOpen = !dropdownOpen" class="flex items-center w-full text-left text-sm font-semibold text-gray-700 rounded-xl hover:bg-green-50 px-4 py-3 border border-transparent hover:border-green-100">
                    <i class="fas fa-layer-group mr-3 text-green-500"></i>
                    <span>Manajemen Konten</span>
                    <svg class="ml-auto h-4 w-4 transform transition-transform" :class="{ 'rotate-180': dropdownOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="dropdownOpen" class="mt-2 space-y-2 pl-10">
                    <x-responsive-nav-link :href="route('admin.artikel.index')" :active="request()->routeIs('admin.artikel.index')" class="flex items-center gap-3">
                        <i class="fas fa-newspaper text-green-500"></i>
                        <span>Artikel</span>
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')" class="flex items-center gap-3">
                        <i class="fas fa-tags text-green-500"></i>
                        <span>Kategori</span>
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="flex items-center gap-3">
                        <i class="fas fa-users text-green-500"></i>
                        <span>Pengguna</span>
                    </x-responsive-nav-link>
                </div>
            </div>

            <x-responsive-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.*')" class="flex items-center gap-3">
                <i class="fas fa-images text-green-500"></i>
                <span>Galeri & Acara</span>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.rutinan.index')" :active="request()->routeIs('admin.rutinan.*')" class="flex items-center gap-3">
                <i class="fas fa-clock text-green-500"></i>
                <span>Jadwal Rutin</span>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.logs.index')" :active="request()->routeIs('admin.logs.index')" class="flex items-center gap-3">
                <i class="fas fa-history text-green-500"></i>
                <span>Riwayat Aktivitas</span>
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-5 border-t border-green-100">
            <div class="flex items-center px-5 gap-3">
                <div class="h-11 w-11 rounded-full bg-green-100 flex items-center justify-center text-green-700">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <div class="text-base font-semibold text-green-800">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-2 px-4">
                <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center gap-3">
                    <i class="fas fa-id-badge text-green-500"></i>
                    <span>Profil</span>
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-3">
                        <i class="fas fa-sign-out-alt text-green-500"></i>
                        <span>Keluar</span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
