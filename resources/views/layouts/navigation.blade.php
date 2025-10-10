<nav x-data="{ open: false, dropdownOpen: false }" class="bg-white shadow-sm">
    <!-- Primary Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo and Desktop Menu -->
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('welcome') }}" class="flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto transition-transform hover:scale-105" />
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
                    
                    {{-- <x-nav-link :href="route('admin.pendaftaran.index')" :active="request()->routeIs('admin.pendaftaran.*')" class="px-3 py-2 rounded-lg hover:bg-gray-50 transition-all">
                        <i class="fas fa-user-plus mr-2 text-gray-400"></i>
                        {{ __('Registrations') }}
                    </x-nav-link> --}}
                    
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
            
            <!-- User Profile Dropdown -->
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 max-w-xs rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                        <div class="relative h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                            <svg class="h-6 w-6 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 14.75c2.67 0 8 1.34 8 4v1.25H4v-1.25c0-2.66 5.33-4 8-4zm0-9.5c-2.22 0-4 1.78-4 4s1.78 4 4 4 4-1.78 4-4-1.78-4-4-4zm0 6c-1.11 0-2-.89-2-2s.89-2 2-2 2 .89 2 2-.89 2-2 2z"/>
                            </svg>
                        </div>
                    </button>
                    
                    <div x-show="open" @click.away="open = false" 
                         class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 transition-all duration-200"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95">
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center px-4 py-2 hover:bg-gray-50">
                            <i class="fas fa-user-circle mr-2 text-gray-400"></i>
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" 
                                            class="flex items-center px-4 py-2 hover:bg-gray-50">
                                <i class="fas fa-sign-out-alt mr-2 text-gray-400"></i>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 transition duration-150 ease-in-out">
                    <span class="sr-only">Open main menu</span>
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
    
    <!-- Mobile Menu -->
    <div x-show="open" @click.away="open = false" 
         class="sm:hidden transition-all duration-300 ease-in-out"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center px-3 py-2 rounded-md">
                <i class="fas fa-tachometer-alt mr-3 text-gray-400"></i>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            <div class="px-3 py-2">
                <button @click="dropdownOpen = !dropdownOpen" class="flex items-center w-full text-left text-sm font-medium text-gray-600 rounded-md hover:bg-gray-50 px-3 py-2">
                    <i class="fas fa-cog mr-3 text-gray-400"></i>
                    {{ __('Management') }}
                    <svg class="ml-auto h-4 w-4 transform transition-transform" :class="{ 'rotate-180': dropdownOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                
                <div x-show="dropdownOpen" class="mt-2 space-y-1 pl-11">
                    <x-responsive-nav-link :href="route('admin.artikel.index')" :active="request()->routeIs('admin.artikel.index')" class="flex items-center px-3 py-2 rounded-md">
                        <i class="fas fa-newspaper mr-3 text-gray-400"></i>
                        {{ __('Article Management') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')" class="flex items-center px-3 py-2 rounded-md">
                        <i class="fas fa-tags mr-3 text-gray-400"></i>
                        {{ __('Category Management') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="flex items-center px-3 py-2 rounded-md">
                        <i class="fas fa-users mr-3 text-gray-400"></i>
                        {{ __('User Management') }}
                    </x-responsive-nav-link>
                </div>
            </div>
            
            <x-responsive-nav-link :href="route('admin.pendaftaran.index')" :active="request()->routeIs('admin.pendaftaran.*')" class="flex items-center px-3 py-2 rounded-md">
                <i class="fas fa-user-plus mr-3 text-gray-400"></i>
                {{ __('Registrations') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.*')" class="flex items-center px-3 py-2 rounded-md">
                <i class="fas fa-calendar-alt mr-3 text-gray-400"></i>
                {{ __('Events Gallery') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('admin.rutinan.index')" :active="request()->routeIs('admin.rutinan.*')" class="flex items-center px-3 py-2 rounded-md">
                <i class="fas fa-clock mr-3 text-gray-400"></i>
                {{ __('Regular Schedule') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('admin.logs.index')" :active="request()->routeIs('admin.logs.index')" class="flex items-center px-3 py-2 rounded-md">
                <i class="fas fa-history mr-3 text-gray-400"></i>
                {{ __('Activity Log') }}
            </x-responsive-nav-link>
        </div>
        
        <!-- Mobile User Menu -->
        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="flex items-center px-5">
                <div class="flex-shrink-0">
                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                        <svg class="h-8 w-8 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 14.75c2.67 0 8 1.34 8 4v1.25H4v-1.25c0-2.66 5.33-4 8-4zm0-9.5c-2.22 0-4 1.78-4 4s1.78 4 4 4 4-1.78 4-4-1.78-4-4-4zm0 6c-1.11 0-2-.89-2-2s.89-2 2-2 2 .89 2 2-.89 2-2 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1 px-2">
                <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center px-3 py-2 rounded-md">
                    <i class="fas fa-user-circle mr-3 text-gray-400"></i>
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" 
                                          class="flex items-center px-3 py-2 rounded-md">
                        <i class="fas fa-sign-out-alt mr-3 text-gray-400"></i>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>