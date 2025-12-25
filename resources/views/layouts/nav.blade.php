<header id="navbar"
  data-landing="{{ request()->is('/') ? '1' : '0' }}"
  class="fixed top-0 right-0 w-full p-3 text-sm z-50 transition-all duration-300 ease-in-out bg-white shadow-md">

  <!-- ===== DESKTOP: PERSIS PUNYA KAMU (JANGAN DIUBAH) ===== -->
  <nav class="hidden sm:grid grid-cols-3 items-center w-full">
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

      <a id="navGaleri"
        href="{{ url('galeri-acara') }}"
        class="flex items-center gap-2 px-4 py-2 rounded-md focus:outline-none text-gray-900 hover:bg-gray-100">
        Galeri
      </a>

      <!-- Dropdown Tentang Kami -->
      <!-- <div class="relative">
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
      </div> -->
    </div>
  </nav>

  <!-- ===== MOBILE: BARU (logo kiri + hamburger kanan) ===== -->
  <div class="sm:hidden flex items-center justify-between w-full">
    <a href="{{ url('/') }}" class="flex items-center">
      <img
        src="{{ asset('images/logoarab.webp') }}"
        alt="Logo Al-Anwar"
        class="h-9 w-auto" />
    </a>

    <button id="mobileMenuBtn" type="button"
      class="p-2 rounded-md text-gray-900 hover:bg-gray-100 focus:outline-none"
      aria-label="Open menu">
      <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
  </div>

  <div id="mobileMenu"
    class="sm:hidden hidden mt-2 bg-white rounded-lg shadow-lg divide-y divide-gray-100 overflow-hidden">
    <div class="py-2 text-sm text-gray-700">
      <a href="{{ route('selasanan.index') }}" class="block px-4 py-3 hover:bg-gray-100">Selasanan</a>
      <a href="{{ url('artikel') }}" class="block px-4 py-3 hover:bg-gray-100">Artikel</a>
      <!-- <a href="/profil" class="block px-4 py-3 hover:bg-gray-100">Profil Pesantren</a> -->
      <a href="/galeri-acara" class="block px-4 py-3 hover:bg-gray-100">Galeri</a>
    </div>
  </div>

  <script>
    // ====== tetap: tutup dropdown desktop kalau klik luar (punyamu) ======
    document.addEventListener('click', function (e) {
      const dropdown = document.getElementById('dropdownNavbar');
      const button = document.getElementById('dropdownNavbarLink');
      if (button && dropdown && !button.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.add('hidden');
      }
    });

    document.addEventListener('DOMContentLoaded', function () {
      // ====== MOBILE MENU ======
      const mobileBtn = document.getElementById('mobileMenuBtn');
      const mobileMenu = document.getElementById('mobileMenu');

      if (mobileBtn && mobileMenu) {
        mobileBtn.addEventListener('click', function (e) {
          e.stopPropagation();
          mobileMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function (e) {
          if (!mobileMenu.classList.contains('hidden')) {
            const inside = mobileMenu.contains(e.target) || mobileBtn.contains(e.target);
            if (!inside) mobileMenu.classList.add('hidden');
          }
        });
      }

      // ====== SCROLL EFFECT: desktop tetap punyamu, MOBILE topmode dipaksa putih ======
      const navbar = document.getElementById('navbar');
      const isLanding = navbar.dataset.landing === "1";
      if (!isLanding) return;

      const scrollThreshold = 20;
      const logo = document.getElementById('navbarLogo');
      const slogan = document.getElementById('navbarSlogan');
      const selasanan = document.getElementById('navSelasanan');
      const artikel = document.getElementById('navArtikel');
      const dropdownBtn = document.getElementById('dropdownNavbarLink');
      const galeri = document.getElementById('navGaleri');

      function isMobile() {
        return window.innerWidth < 640; // tailwind sm
      }

      function setTopMode() {
        if (isMobile()) {
          // MOBILE: dipaksa putih saat topmode
          navbar.classList.remove('bg-transparent');
          navbar.classList.add('bg-white');
          navbar.classList.remove('shadow-md');
          return;
        }

        // DESKTOP: persis punyamu
        navbar.classList.remove('bg-white', 'shadow-md');
        navbar.classList.add('bg-transparent');

        logo.classList.add('opacity-0', 'pointer-events-none');
        logo.classList.remove('opacity-100');

        slogan.classList.remove('text-[#008362]');
        slogan.classList.add('text-white');

        [selasanan, artikel, galeri].forEach(el => {
          el.classList.remove('text-gray-900', 'hover:bg-gray-100');
          el.classList.add('text-white', 'hover:bg-white/10');
        });
      }

      function setScrolledMode() {
        if (isMobile()) {
          // MOBILE: putih + shadow saat scroll
          navbar.classList.remove('bg-transparent');
          navbar.classList.add('bg-white', 'shadow-md');
          return;
        }

        // DESKTOP: persis punyamu
        navbar.classList.remove('bg-transparent');
        navbar.classList.add('bg-white', 'shadow-md');

        logo.classList.remove('opacity-0', 'pointer-events-none');
        logo.classList.add('opacity-100');

        slogan.classList.remove('text-white');
        slogan.classList.add('text-[#008362]');

        [selasanan, artikel, galeri].forEach(el => {
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
      window.addEventListener('resize', onScroll);
    });
  </script>
</header>
