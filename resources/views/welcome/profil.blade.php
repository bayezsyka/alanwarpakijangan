<section id="profil-pesantren" class="section bg-surface">
    <div class="container-editorial">
        <div class="grid lg:grid-cols-[0.93fr_1.07fr] gap-12 lg:gap-20 items-center">

            {{-- Left column: copy --}}
            <div data-aos="fade-right">
                <p class="eyebrow">Tentang Pesantren</p>

                <div class="section-heading">
                    <h2>Pondok Pesantren <span class="text-primary italic">"Al-Anwar Pakijangan"</span></h2>
                    <p class="description">
                        Pesantren berbasis kurikulum salaf modern yang memadukan penguatan akidah, akhlak,
                        dan ilmu pengetahuan dengan pembinaan karakter santri yang mandiri, peduli, disiplin,
                        jujur, dan inovatif. Dikenal sebagai <strong class="text-primary">"Kubah Jawa"</strong>.
                    </p>
                </div>

                {{-- Feature points with check icons --}}
                <ul class="mt-8 space-y-3">
                    <li class="flex items-start gap-3">
                        <span class="mt-1 inline-flex w-6 h-6 rounded-full bg-primary-soft text-primary items-center justify-center shrink-0">
                            <i class="fas fa-check text-[10px]"></i>
                        </span>
                        <span class="text-[15px] text-dark/80">Model kurikulum <strong>Salaf Modern</strong> &mdash; SMP &amp; Madrasah Diniyah</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 inline-flex w-6 h-6 rounded-full bg-primary-soft text-primary items-center justify-center shrink-0">
                            <i class="fas fa-check text-[10px]"></i>
                        </span>
                        <span class="text-[15px] text-dark/80">Penguatan akidah, akhlak, dan ilmu pengetahuan secara seimbang</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 inline-flex w-6 h-6 rounded-full bg-primary-soft text-primary items-center justify-center shrink-0">
                            <i class="fas fa-check text-[10px]"></i>
                        </span>
                        <span class="text-[15px] text-dark/80">Karakter: mandiri, peduli, disiplin, jujur, inovatif</span>
                    </li>
                </ul>

                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <a href="/profil" class="btn btn-primary">
                        Lihat Profil Lengkap
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                    <span class="inline-flex items-center gap-2 text-sm text-muted">
                        <i class="fas fa-phone-alt text-primary text-xs"></i>
                        0851 6160 3362
                    </span>
                </div>
            </div>

            {{-- Right column: image + stacked quote card --}}
            <div class="relative" data-aos="fade-left" data-aos-delay="100">
                <div class="overflow-hidden rounded-lg shadow-soft">
                    <img src="{{ asset('images/landingpage/bgppdb.png') }}"
                         alt="Pondok Pesantren Al-Anwar Pakijangan"
                         class="w-full h-[360px] sm:h-[440px] lg:h-[500px] object-cover" />
                </div>

                {{-- Caption strip --}}
                <div class="mt-3 flex items-center justify-between text-xs text-muted">
                    <span class="font-bold uppercase tracking-[0.14em]">Pondok Pesantren Al-Anwar</span>
                    <span>Pakijangan, Brebes</span>
                </div>

                {{-- Quote card stacked over image --}}
                <div class="absolute -top-6 -right-2 lg:-right-6 max-w-[315px] bg-surface border border-black/8 rounded-md shadow-soft p-6"
                     data-aos="zoom-in" data-aos-delay="250">
                    <i class="fas fa-quote-left text-accent text-lg mb-3"></i>
                    <p class="font-display text-[19px] leading-snug text-dark italic">
                        Menumbuhkan potensi setiap santri secara personal dan reflektif, membentuk karakter yang kokoh.
                    </p>
                    <div class="mt-4 pt-4 border-t border-black/8">
                        <p class="text-sm font-semibold text-dark">KH. Muhammad Miftah</p>
                        <p class="text-xs text-muted">Pimpinan Pondok Pesantren</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
