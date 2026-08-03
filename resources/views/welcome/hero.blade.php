{{-- Hero Section --}}
<section class="relative overflow-hidden bg-surface-alt">
    {{-- Decorative arch (desktop only, no pointer events) --}}
    <div class="hidden md:block absolute top-[-120px] right-[-80px] w-[420px] h-[420px] border border-accent/20 rounded-full pointer-events-none" aria-hidden="true"></div>
    <div class="hidden md:block absolute bottom-[-160px] left-[-100px] w-[360px] h-[360px] border border-primary/15 rounded-full pointer-events-none" aria-hidden="true"></div>

    <div class="container-editorial relative z-10 py-16 lg:py-24">
        <div class="hero-grid grid lg:grid-cols-[0.95fr_1.05fr] items-center gap-12 lg:gap-16">

            {{-- Left column: copy --}}
            <div data-aos="fade-right">
                <p class="eyebrow">Pondok Pesantren Salaf Modern</p>

                <h1 class="font-display font-semibold leading-[1.03] tracking-[-0.045em] text-dark
                           text-[clamp(44px,13vw,62px)] lg:text-[clamp(48px,6.2vw,78px)]">
                    Mendampingi Potensi,<br>
                    <em class="not-italic text-primary italic">Membentuk Karakter</em>
                </h1>

                <p class="mt-6 max-w-lg text-[17px] lg:text-[18px] leading-[1.7] text-muted">
                    Pesantren berbasis kurikulum salaf modern yang memadukan penguatan akidah, akhlak,
                    dan ilmu pengetahuan untuk membentuk generasi yang mandiri, peduli, disiplin, jujur, dan inovatif.
                </p>

                <div class="hero-actions mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('pendaftaran') }}" class="btn btn-primary">
                        Pendaftaran Santri Baru
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                    <a href="{{ route('selasanan.index') }}" class="btn btn-outline">
                        Lihat Kajian Selasanan
                    </a>
                </div>

                {{-- Supporting indicator --}}
                <div class="mt-10 flex flex-wrap items-center gap-x-8 gap-y-3 text-sm text-muted">
                    <span class="flex items-center gap-2">
                        <i class="fas fa-graduation-cap text-primary"></i>
                        SMP &amp; Madrasah Diniyah
                    </span>
                    <span class="hidden sm:inline-block w-px h-4 bg-black/10"></span>
                    <span class="flex items-center gap-2">
                        <i class="fas fa-location-dot text-primary"></i>
                        Brebes, Jawa Tengah
                    </span>
                </div>
            </div>

            {{-- Right column: large visual --}}
            <div class="relative" data-aos="fade-left" data-aos-delay="100">
                <div class="relative overflow-hidden shadow-soft"
                     style="border-radius: 230px 230px 26px 26px;">
                    <img src="{{ asset('images/landingpage/bgppdb.png') }}"
                         alt="Pondok Pesantren Al-Anwar Pakijangan"
                         class="w-full h-[420px] sm:h-[520px] lg:h-[600px] object-cover" />

                    {{-- Gradient overlay bottom --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/70 via-dark/10 to-transparent"></div>

                    {{-- Caption --}}
                    <div class="absolute bottom-0 left-0 right-0 p-6 lg:p-8">
                        <p class="text-white/80 text-xs font-bold uppercase tracking-[0.14em] mb-1">Tahun Ajaran</p>
                        <p class="text-white font-display text-2xl lg:text-3xl font-semibold">2026 / 2027 M</p>
                    </div>
                </div>

                {{-- Floating info card --}}
                <div class="absolute -bottom-6 -left-4 lg:-left-8 bg-surface border border-black/8 rounded-md shadow-card p-5 w-[200px]"
                     data-aos="zoom-in" data-aos-delay="300">
                    <p class="text-[11px] font-bold uppercase tracking-[0.14em] text-accent mb-1">Pendaftaran Dibuka</p>
                    <p class="font-display text-xl font-semibold text-dark">PPDB 2026</p>
                    <a href="{{ route('pendaftaran') }}" class="mt-2 inline-flex items-center gap-1.5 text-xs font-bold text-primary hover:gap-2.5 transition-all">
                        Info lengkap <i class="fas fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
