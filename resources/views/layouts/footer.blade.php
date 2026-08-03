<footer class="bg-[#0d0d0b] text-white pt-20 pb-8">
    <div class="container-editorial">
        <div class="grid md:grid-cols-[1.8fr_1fr_1fr_1fr] gap-10 md:gap-16">

            {{-- Brand + description --}}
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logo.webp') }}" alt="Logo Al-Anwar" class="h-14 w-auto shrink-0">
                    <h3 class="font-display text-lg font-semibold leading-tight">
                        Pondok Pesantren<br>Al-Anwar Pakijangan
                    </h3>
                </div>
                <p class="text-sm text-white/60 leading-relaxed max-w-sm">
                    Menjadi lembaga yang menumbuhkan potensi setiap santri secara personal dan reflektif,
                    membentuk karakter yang kokoh dan bijaksana, serta menguatkan ilmu sebagai cahaya hidup.
                </p>

                {{-- Social --}}
                <div class="flex gap-4 mt-6">
                    <a href="https://www.youtube.com/@alanwarpakijangan5759"
                       class="w-10 h-10 flex items-center justify-center rounded-full border border-white/15 text-white/70 hover:text-white hover:border-white/40 hover:-translate-y-0.5 transition" target="_blank" rel="noopener" aria-label="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="https://instagram.com/pesantrenalanwar"
                       class="w-10 h-10 flex items-center justify-center rounded-full border border-white/15 text-white/70 hover:text-white hover:border-white/40 hover:-translate-y-0.5 transition" target="_blank" rel="noopener" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

            {{-- Navigasi --}}
            <div>
                <h4 class="text-[11px] font-bold uppercase tracking-[0.14em] text-white/50 mb-4">Navigasi</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('welcome') }}" class="text-white/75 hover:text-white transition">Beranda</a></li>
                    <li><a href="{{ route('selasanan.index') }}" class="text-white/75 hover:text-white transition">Selasanan</a></li>
                    <li><a href="{{ url('artikel') }}" class="text-white/75 hover:text-white transition">Artikel</a></li>
                    <li><a href="{{ url('galeri-acara') }}" class="text-white/75 hover:text-white transition">Galeri</a></li>
                </ul>
            </div>

            {{-- Kontak --}}
            <div>
                <h4 class="text-[11px] font-bold uppercase tracking-[0.14em] text-white/50 mb-4">Kontak</h4>
                <ul class="space-y-3 text-sm text-white/75">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-phone mt-1 text-accent text-xs"></i>
                        <span>(0283) 870290</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-location-dot mt-1 text-accent text-xs"></i>
                        <span>Jl. Raya Pakijangan R. Bulakamba No.08, RT.04/RW.02, Pakijangan, Bulakamba, Brebes, Jawa Tengah 52253</span>
                    </li>
                </ul>
            </div>

            {{-- Lokasi --}}
            <div>
                <h4 class="text-[11px] font-bold uppercase tracking-[0.14em] text-white/50 mb-4">Lokasi</h4>
                <div class="overflow-hidden rounded-sm border border-white/10">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.156106881118!2d108.959621074996!3d-6.8718910931268296!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6faf88434cb6dd%3A0x6162e8b5c0c73026!2sPondok%20Pesantren%20Al%20Anwar%20Pakijangan!5e0!3m2!1sid!2sid!4v1754168591726!5m2!1sid!2sid"
                        width="100%" height="160" style="border:0; min-width:200px;" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="grayscale opacity-80"></iframe>
                </div>
            </div>
        </div>

        {{-- Footer bottom --}}
        <div class="mt-16 pt-6 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-white/50">
            <p>&copy; {{ date('Y') }} Pondok Pesantren Al-Anwar Pakijangan. All rights reserved.</p>
            <p>Mendampingi Potensi, Membentuk Karakter</p>
        </div>
    </div>

    {{-- Mobile quick actions (compact) --}}
    <div class="md:hidden px-4 mt-8">
        <div class="grid grid-cols-3 gap-2 text-xs">
            <a href="tel:0283870290" class="flex items-center justify-center gap-2 py-2.5 rounded-md bg-white/5 border border-white/10 text-white/80">
                <i class="fas fa-phone text-accent"></i> Telp
            </a>
            <a href="https://instagram.com/pesantrenalanwar" target="_blank" rel="noopener" class="flex items-center justify-center gap-2 py-2.5 rounded-md bg-white/5 border border-white/10 text-white/80">
                <i class="fab fa-instagram text-accent"></i> IG
            </a>
            <a href="https://www.youtube.com/@alanwarpakijangan5759" target="_blank" rel="noopener" class="flex items-center justify-center gap-2 py-2.5 rounded-md bg-white/5 border border-white/10 text-white/80">
                <i class="fab fa-youtube text-accent"></i> YT
            </a>
        </div>
    </div>
</footer>
