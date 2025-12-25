<header id="navbar"
  data-landing="{{ request()->is('/') ? '1' : '0' }}"
  class="fixed top-0 right-0 w-full p-3 text-sm z-50 transition-all duration-300 ease-in-out bg-white shadow-md">
  
  <nav class="grid grid-cols-3 items-center w-full">
    <!-- Kolom Kiri -->
    <div>
      <a id="navbarSlogan" class="text-m font-bold leading-tight text-[#008362]">
        MENDAMPINGI POTENSI
        <br>MEMBENTUK KARAKTER</br>
      </a>
    </div>

    <!-- Kolom Tengah: Logo -->
    <div class="flex justify-center">
      <a href="{{ url('/') }}" class="flex items-center">
        <img id="navbarLogo"
          src="{{ asset('images/logoarab.webp') }}"
          alt="Logo Al-Anwar"
          class="h-10 w-auto hidden sm:block transition-opacity duration-300 opacity-100" />
      </a>
    </div>

    <!-- Kolom Kanan: Menu -->
    <div class="flex justify-end items-center space-x-2">
      <a id="navSelasanan"
        href="{{ route('selasanan.index') }}"
        class="flex items-center gap-2 px-4 py-2 rounded-md focus:outline-none text-gray-900 hover:bg-gray-100">
        Selasanan
      </a>

      <a id="navArtikel"
        href="{{ url('artikel') }}"
        class="flex items-center gap-2 px-4 py-2 rounded-md focus:outline-none text-gray-900 hover:bg-gray-100">
        Artikel
      </a>

      <!-- Dropdown Tentang Kami -->
      <div class="relative">
        <button id="dropdownNavbarLink" type="button"
          class="flex items-center gap-2 px-4 py-2 rounded-md focus:outline-none text-gray-900 hover:bg-gray-100"
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
            <li><a href="/profil" class="block px-4 py-2 hover:bg-gray-100">Profil Pesantren</a></li>
            <li><a href="/galeri-acara" class="block px-4 py-2 hover:bg-gray-100">Galeri</a></li>
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

    document.addEventListener('DOMContentLoaded', function () {
      const navbar = document.getElementById('navbar');
      const isLanding = navbar.dataset.landing === "1";

      // Kalau bukan landing page: navbar netep (gak ada efek)
      if (!isLanding) return;

      const scrollThreshold = 20;
      const logo = document.getElementById('navbarLogo');
      const slogan = document.getElementById('navbarSlogan');
      const selasanan = document.getElementById('navSelasanan');
      const artikel = document.getElementById('navArtikel');
      const dropdownBtn = document.getElementById('dropdownNavbarLink');

      function setTopMode() {
        // transparan, tanpa shadow
        navbar.classList.remove('bg-white', 'shadow-md');
        navbar.classList.add('bg-transparent');

        // hide logo tapi tetap makan tempat
        logo.classList.add('opacity-0', 'pointer-events-none');
        logo.classList.remove('opacity-100');

        // slogan putih
        slogan.classList.remove('text-[#008362]');
        slogan.classList.add('text-white');

        // menu putih
        [selasanan, artikel, dropdownBtn].forEach(el => {
          el.classList.remove('text-gray-900', 'hover:bg-gray-100');
          el.classList.add('text-white', 'hover:bg-white/10');
        });
      }

      function setScrolledMode() {
        // bg putih + shadow
        navbar.classList.remove('bg-transparent');
        navbar.classList.add('bg-white', 'shadow-md');

        // show logo
        logo.classList.remove('opacity-0', 'pointer-events-none');
        logo.classList.add('opacity-100');

        // slogan hijau
        slogan.classList.remove('text-white');
        slogan.classList.add('text-[#008362]');

        // menu gelap
        [selasanan, artikel, dropdownBtn].forEach(el => {
          el.classList.remove('text-white', 'hover:bg-white/10');
          el.classList.add('text-gray-900', 'hover:bg-gray-100');
        });
      }

      function onScroll() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        if (scrollTop <= scrollThreshold) setTopMode();
        else setScrolledMode();
      }

      onScroll();
      window.addEventListener('scroll', onScroll);
    });
  </script>
</header>
