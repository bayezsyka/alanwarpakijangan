<header id="navbar" class="fixed top-0 right-0 w-full p-3 text-sm not-has-[nav]:hidden transform -translate-y-full transition-transform duration-300 ease-in-out z-50 bg-white dark:bg-gray-900 shadow-md">
        <nav class="grid grid-cols-3 items-center w-full">
            <div>
                <a class="text-m font-bold text-sky-900">
                    MENDAMPINGI POTENSI
                    <br>MEMBENTUK KARAKTER</br>
                </a>
            </div>
            <div class="flex justify-center">
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ asset('images/logoarab.png') }}" alt="Logo Al-Anwar" class="h-10 w-auto" />
                </a>
            </div>
            <div class="flex justify-end">
                <div>
                    <a href="{{ url('artikel') }}" class="flex items-center gap-2 px-4 py-2 text-gray-900 dark:text-white rounded-sm hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                        Artikel
                    </a>
                </div>
                <!-- Dropdown -->
                <div class="relative group">
                    <button id="dropdownNavbarLink" type="button"
                        class="flex items-center gap-2 px-4 py-2 text-gray-900 dark:text-white rounded-sm hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none"
                        onclick="document.getElementById('dropdownNavbar').classList.toggle('hidden')">
                        Tentang Kami
                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <div id="dropdownNavbar"
                        class="absolute right-0 mt-2 z-20 hidden bg-white dark:bg-gray-700 rounded-lg shadow-lg w-44 divide-y divide-gray-100 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                            {{-- <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Piagam Statistik Pesantren</a>
                            </li> --}}
                            <li>
                                <a href="/profil" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profil Pesantren</a>
                            </li>
                            {{-- <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Visi, Misi, dan Tujuan</a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
            <script>
                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    const dropdown = document.getElementById('dropdownNavbar');
                    const button = document.getElementById('dropdownNavbarLink');
                    if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                        dropdown.classList.add('hidden');
                    }
                });

                document.addEventListener('DOMContentLoaded', function() {
                    let lastScrollTop = 0;
                    const navbar = document.getElementById('navbar');
                    const scrollThreshold = 20; // Minimum scroll distance to trigger navbar

                    window.addEventListener('scroll', function() {
                        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                        if (scrollTop <= scrollThreshold) {
                            navbar.classList.add('-translate-y-full');
                            navbar.classList.remove('translate-y-0');
                        } else if (scrollTop > lastScrollTop && scrollTop > scrollThreshold) {
                            navbar.classList.remove('-translate-y-full');
                            navbar.classList.add('translate-y-0');
                        } else if (scrollTop < lastScrollTop && scrollTop > scrollThreshold) {
                            navbar.classList.remove('-translate-y-full');
                            navbar.classList.add('translate-y-0');
                        }

                        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
                    });
                });
            </script>
            </script>
        </nav>
</header>