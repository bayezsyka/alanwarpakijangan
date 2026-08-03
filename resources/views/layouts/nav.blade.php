{{-- Announcement bar + Navbar --}}
<div id="navbarWrap" class="fixed top-0 left-0 w-full z-50">

    {{-- Announcement bar --}}
    <div id="announcementBar" class="bg-primary text-white text-[12px] hidden lg:block transition-all duration-300">
        <div class="container-editorial flex items-center justify-between h-[34px]">
            <span class="flex items-center gap-2">
                <i class="fas fa-bullhorn text-[10px] opacity-80"></i>
                Penerimaan Santri Baru Tahun Ajaran 2026/2027 M telah dibuka
            </span>
            <a href="{{ route('pendaftaran') }}" class="font-bold underline underline-offset-2 hover:text-accent transition-colors">
                Daftar Sekarang &rarr;
            </a>
        </div>
    </div>

    {{-- Navbar --}}
    <header id="navbar" data-landing="{{ request()->is('/') ? '1' : '0' }}"
            class="w-full transition-all duration-300 ease-in-out">
        <nav class="container-editorial flex items-center justify-between gap-6 min-h-[72px] lg:min-h-[82px]">

            {{-- Logo / Brand --}}
            <a href="{{ url('/') }}" class="flex items-center gap-3 shrink-0">
                <img id="navbarLogo" src="{{ asset('images/logoarab.webp') }}" alt="Logo Al-Anwar"
                     class="h-10 w-auto transition-opacity duration-300" />
                <span id="navbarSlogan" class="hidden md:block font-display font-semibold text-[15px] leading-tight text-primary transition-colors duration-300">
                    Pondok Pesantren<br>Al-Anwar Pakijangan
                </span>
            </a>

            {{-- Desktop navigation --}}
            <div class="hidden lg:flex items-center gap-8">
                <a href="{{ route('selasanan.index') }}" id="navSelasanan"
                   class="nav-link-editorial text-gray-700 hover:text-primary">Selasanan</a>
                <a href="{{ url('artikel') }}" id="navArtikel"
                   class="nav-link-editorial text-gray-700 hover:text-primary">Artikel</a>
                <a href="{{ url('galeri-acara') }}" id="navGaleri"
                   class="nav-link-editorial text-gray-700 hover:text-primary">Galeri</a>
            </div>

            {{-- Primary CTA + Mobile menu button --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('pendaftaran') }}" id="navPendaftaran"
                   class="btn btn-primary hidden sm:inline-flex !min-h-[44px] !px-5 !text-[13px]">
                    Pendaftaran
                </a>

                {{-- Mobile menu toggle (min 44x44) --}}
                <button id="mobileMenuBtn" type="button"
                        class="lg:hidden w-11 h-11 flex items-center justify-center rounded-full text-gray-900 hover:bg-black/5 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-accent"
                        aria-label="Buka menu" aria-expanded="false">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    {{-- Mobile menu --}}
    <div id="mobileMenu" class="lg:hidden hidden bg-white border-t border-black/5 shadow-soft overflow-hidden">
        <nav class="container-editorial py-2">
            <a href="{{ route('selasanan.index') }}" class="block min-h-[48px] flex items-center border-b border-black/5 px-2 text-gray-700 hover:text-primary transition">Selasanan</a>
            <a href="{{ url('artikel') }}" class="block min-h-[48px] flex items-center border-b border-black/5 px-2 text-gray-700 hover:text-primary transition">Artikel</a>
            <a href="{{ url('galeri-acara') }}" class="block min-h-[48px] flex items-center border-b border-black/5 px-2 text-gray-700 hover:text-primary transition">Galeri</a>
            <a href="{{ route('pendaftaran') }}" class="block min-h-[48px] flex items-center px-2 mt-2 font-bold text-primary">Pendaftaran &rarr;</a>
        </nav>
    </div>
</div>

{{-- Spacer to offset fixed navbar (non-landing pages) --}}
@if(!request()->is('/'))
    <div class="h-[72px] lg:h-[116px]"></div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobileBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        // ====== Mobile menu toggle ======
        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                const isHidden = mobileMenu.classList.toggle('hidden');
                mobileBtn.setAttribute('aria-expanded', !isHidden);
            });

            // Close on outside click
            document.addEventListener('click', function (e) {
                if (!mobileMenu.classList.contains('hidden')) {
                    const inside = mobileMenu.contains(e.target) || mobileBtn.contains(e.target);
                    if (!inside) {
                        mobileMenu.classList.add('hidden');
                        mobileBtn.setAttribute('aria-expanded', 'false');
                    }
                }
            });

            // Close on item click
            mobileMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                    mobileBtn.setAttribute('aria-expanded', 'false');
                });
            });

            // Close on Escape
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    mobileBtn.setAttribute('aria-expanded', 'false');
                }
            });
        }

        // ====== Scroll effect (landing page only) ======
        const navbar = document.getElementById('navbar');
        const announcementBar = document.getElementById('announcementBar');
        const isLanding = navbar.dataset.landing === "1";
        if (!isLanding) {
            navbar.classList.add('bg-white/85', 'backdrop-blur-md', 'border-b', 'border-black/5', 'shadow-sm');
            return;
        }

        const logo = document.getElementById('navbarLogo');
        const slogan = document.getElementById('navbarSlogan');
        const selasanan = document.getElementById('navSelasanan');
        const artikel = document.getElementById('navArtikel');
        const galeri = document.getElementById('navGaleri');
        const pendaftaran = document.getElementById('navPendaftaran');
        const navLinks = [selasanan, artikel, galeri].filter(Boolean);

        function isMobile() {
            return window.innerWidth < 1024;
        }

        function setTopMode() {
            // Hide announcement bar at very top on landing for immersive hero
            if (announcementBar) announcementBar.classList.add('lg:hidden');

            if (isMobile()) {
                navbar.classList.remove('bg-white/85', 'backdrop-blur-md', 'shadow-sm', 'border-b', 'border-black/5');
                navbar.classList.add('bg-white/80', 'backdrop-blur-sm');
                return;
            }

            // Desktop: transparent over hero
            navbar.classList.remove('bg-white/85', 'backdrop-blur-md', 'shadow-sm', 'border-b', 'border-black/5');

            slogan.classList.remove('text-primary', 'text-gray-700');
            slogan.classList.add('text-white');

            navLinks.forEach(el => {
                el.classList.remove('text-gray-700');
                el.classList.add('text-white/90', 'hover:text-white');
            });

            if (pendaftaran) {
                pendaftaran.classList.remove('btn-primary');
                pendaftaran.classList.add('btn-light');
            }
        }

        function setScrolledMode() {
            if (announcementBar) announcementBar.classList.remove('lg:hidden');

            if (isMobile()) {
                navbar.classList.remove('bg-white/80', 'backdrop-blur-sm');
                navbar.classList.add('bg-white/90', 'backdrop-blur-md', 'shadow-sm', 'border-b', 'border-black/5');
                return;
            }

            // Desktop: frosted white
            navbar.classList.remove('bg-white/80');
            navbar.classList.add('bg-white/85', 'backdrop-blur-md', 'shadow-sm', 'border-b', 'border-black/5');

            slogan.classList.remove('text-white');
            slogan.classList.add('text-primary');

            navLinks.forEach(el => {
                el.classList.remove('text-white/90', 'hover:text-white');
                el.classList.add('text-gray-700', 'hover:text-primary');
            });

            if (pendaftaran) {
                pendaftaran.classList.remove('btn-light');
                pendaftaran.classList.add('btn-primary');
            }
        }

        function onScroll() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollTop <= 20) setTopMode();
            else setScrolledMode();
        }

        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', onScroll);
    });
</script>
