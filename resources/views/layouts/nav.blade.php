<header id="navbar"
  class="fixed top-0 right-0 w-full p-3 text-sm z-50 transition-all duration-300 ease-in-out bg-transparent">
  <nav class="grid grid-cols-3 items-center w-full">
    <!-- Kolom Kiri -->
    <div>
      <a id="navbarSlogan" class="text-m font-bold leading-tight text-white">
        MENDAMPINGI POTENSI
        <br>MEMBENTUK KARAKTER</br>
      </a>
    </div>

    <!-- Kolom Tengah: Logo -->
    <div class="flex justify-center">
      <a href="{{ url('/') }}" class="flex items-center">
        <img id="navbarLogo" src="{{ asset('images/logoarab.webp') }}"
        alt="Logo Al-Anwar"
        class="h-10 w-auto hidden sm:block" />
      </a>
    </div>

    <!-- Kolom Kanan: Menu -->
    <div class="flex justify-end items-center space-x-2">
      <a id="navArtikel" href="{{ url('artikel') }}"
        class="flex items-center gap-2 px-4 py-2 rounded-md focus:outline-none text-white hover:bg-white/10">
        Artikel
      </a>

      <!-- Dropdown Tentang Kami -->
      <div class="relative">
        <button id="dropdownNavbarLink" type="button"
          class="flex items-center gap-2 px-4 py-2 rounded-md focus:outline-none text-white hover:bg-white/10"
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
              <a href="/profil" class="block px-4 py-2 hover:bg-gray-100">Profil Pesantren</a>
            </li>
            <li>
              <a href="/galeri-acara" class="block px-4 py-2 hover:bg-gray-100">Galeri</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <script>
    // Tutup dropdown jika klik di luar elemen
    document.addEventListener('click', function (e) {
      const dropdown = document.getElementById('dropdownNavbar');
      const button = document.getElementById('dropdownNavbarLink');
      if (!button.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.add('hidden');
      }
    });

    // Navbar: top = transparan & teks putih, scroll = bg putih & teks gelap
    document.addEventListener('DOMContentLoaded', function () {
      const navbar = document.getElementById('navbar');
      const scrollThreshold = 20;
      const logo = document.getElementById('navbarLogo');
      const slogan = document.getElementById('navbarSlogan');
      const artikel = document.getElementById('navArtikel');
      const dropdownBtn = document.getElementById('dropdownNavbarLink');

      function setTopMode() {
        // transparan, tanpa shadow
        navbar.classList.remove('bg-white', 'shadow-md');
        navbar.classList.add('bg-transparent');
        
        logo.classList.add('opacity-0', 'pointer-events-none');
        logo.classList.remove('opacity-100');

        // teks putih
        slogan.classList.remove('text-gray-900', 'text-[#008362]');
        slogan.classList.add('text-white');

        artikel.classList.remove('text-gray-900', 'hover:bg-gray-100');
        artikel.classList.add('text-white', 'hover:bg-white/10');

        dropdownBtn.classList.remove('text-gray-900', 'hover:bg-gray-100');
        dropdownBtn.classList.add('text-white', 'hover:bg-white/10');
      }

      function setScrolledMode() {
        // bg putih + shadow
        navbar.classList.remove('bg-transparent');
        navbar.classList.add('bg-white', 'shadow-md');

        logo.classList.remove('opacity-0', 'pointer-events-none');
        logo.classList.add('opacity-100');

        // teks gelap (atau slogan hijau sesuai desain awalmu)
        slogan.classList.remove('text-white');
        slogan.classList.add('text-[#008362]');

        artikel.classList.remove('text-white', 'hover:bg-white/10');
        artikel.classList.add('text-gray-900', 'hover:bg-gray-100');

        dropdownBtn.classList.remove('text-white', 'hover:bg-white/10');
        dropdownBtn.classList.add('text-gray-900', 'hover:bg-gray-100');
      }

      function onScroll() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        if (scrollTop <= scrollThreshold) setTopMode();
        else setScrolledMode();
      }

      // set kondisi awal + pas scroll
      onScroll();
      window.addEventListener('scroll', onScroll);
    });
  </script>
</header>
