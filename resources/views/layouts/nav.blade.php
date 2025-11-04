<header id="navbar" class="fixed top-0 right-0 w-full p-3 text-sm transform -translate-y-full transition-transform duration-300 ease-in-out z-50 bg-white shadow-md">
    <nav class="grid grid-cols-3 items-center w-full">
        <!-- Kolom Kiri -->
        <div>
            <a class="text-m font-bold text-[#008362] leading-tight">
                MENDAMPINGI POTENSI
                <br>MEMBENTUK KARAKTER</br>
            </a>
        </div>

        <!-- Kolom Tengah: Logo -->
        <div class="flex justify-center">
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="{{ asset('images/logoarab.png') }}" alt="Logo Al-Anwar" class="h-10 w-auto hidden sm:block" />
            </a>
        </div>

        <!-- Kolom Kanan: Menu -->
        <div class="flex justify-end items-center space-x-2">
            <a href="{{ url('artikel') }}" class="flex items-center gap-2 px-4 py-2 text-gray-900 rounded-md hover:bg-gray-100 focus:outline-none">
                Artikel
            </a>

            <!-- Dropdown Tentang Kami -->
            <div class="relative">
                <button id="dropdownNavbarLink" type="button"
                    class="flex items-center gap-2 px-4 py-2 text-gray-900 rounded-md hover:bg-gray-100 focus:outline-none"
                    onclick="document.getElementById('dropdownNavbar').classList.toggle('hidden')">
                    Tentang Kami
                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <div id="dropdownNavbar"
                    class="absolute right-0 mt-2 z-20 hidden bg-white rounded-lg shadow-lg w-44 divide-y divide-gray-100">
                    <ul class="py-2 text-sm text-gray-700">
                        <li>
                            <a href="/profil"
                                class="block px-4 py-2 hover:bg-gray-100">Profil
                                Pesantren</a>
                        </li>
                        <li>
                            <a href="/galeri-acara"
                                class="block px-4 py-2 hover:bg-gray-100">Galeri</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Script: Dropdown & Scroll Animation -->
    <script>
        // Tutup dropdown jika klik di luar elemen
        document.addEventListener('click', function (e) {
            const dropdown = document.getElementById('dropdownNavbar');
            const button = document.getElementById('dropdownNavbarLink');
            if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Navbar animasi saat scroll
        document.addEventListener('DOMContentLoaded', function () {
            let lastScrollTop = 0;
            const navbar = document.getElementById('navbar');
            const scrollThreshold = 20;

            window.addEventListener('scroll', function () {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop <= scrollThreshold) {
                    navbar.classList.add('-translate-y-full');
                    navbar.classList.remove('translate-y-0');
                } else {
                    navbar.classList.remove('-translate-y-full');
                    navbar.classList.add('translate-y-0');
                }

                lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
            });
        });
    </script>
</header>
