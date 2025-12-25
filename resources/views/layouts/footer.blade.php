<footer class="bg-gray-100 text-gray-900 pt-12 rounded-t-3xl">

    <!-- ===================== -->
    <!-- DESKTOP: ASLI (JANGAN DIUBAH) -->
    <!-- ===================== -->
    <div class="hidden sm:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-3 gap-14">
            <!-- Kiri -->
            <div>
                <div class="mb-4 flex items-center pb-3 border-b border-gray-300 w-fit">
                    <img src="{{ asset('images/logo.webp') }}" alt="Logo Al-Anwar" class="h-14 mr-3 shrink-0">
                    <h3 class="text-lg font-bold break-words">
                        Pondok Pesantren <br> Al-Anwar Pakijangan
                    </h3>
                </div>
                <p class="text-sm text-justify break-words">
                    Menjadi lembaga yang menumbuhkan potensi setiap santri secara personal dan reflektif, membentuk karakter yang kokoh dan bijaksana, serta menguatkan ilmu sebagai cahaya hidup yang menuntun santri menapaki jalan dunia dan akhirat secara seimbang dan bermakna.
                </p>

                {{-- ADMIN (tetap) --}}
                {{-- ... --}}
            </div>

            <!-- Tengah -->
            <div>
                <h4 class="text-lg font-bold mb-3 border-b border-gray-300 pb-1 w-fit">Kontak</h4>
                <ul class="text-sm space-y-2">
                    <li class="break-words">
                        <i class="fas fa-phone"></i> Telepon : (0283) 870290
                    </li>
                </ul>

                <h4 class="text-lg font-bold mt-6 mb-3 border-b border-gray-300 pb-1 w-fit">Alamat Lengkap</h4>
                <p class="text-sm text-justify break-words">
                    Jl. Raya Pakijangan R. Bulakamba No.08, RT.04/RW.02, Pakijangan, Kec. Bulakamba, Kabupaten Brebes, Jawa Tengah 52253
                </p>

                <h4 class="text-lg font-bold mt-6 mb-3 border-b border-gray-300 pb-1 w-fit">Ikuti Kami</h4>
                <div class="flex space-x-4 mt-4 text-xl text-gray-700">
                    <a href="https://www.youtube.com/@alanwarpakijangan5759"
                       class="transition-all duration-200 hover:text-red-600 hover:scale-110 break-all"
                       target="_blank" rel="noopener">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="https://instagram.com/pesantrenalanwar"
                       class="transition-all duration-200 hover:text-pink-600 hover:scale-110 break-all"
                       target="_blank" rel="noopener">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

            <!-- Kanan: Google Maps -->
            <div>
                <h4 class="text-lg font-bold mb-3 border-b border-gray-300 pb-1 w-fit">Lokasi Kami</h4>
                <div class="overflow-x-auto rounded-lg">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.156106881118!2d108.959621074996!3d-6.8718910931268296!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6faf88434cb6dd%3A0x6162e8b5c0c73026!2sPondok%20Pesantren%20Al%20Anwar%20Pakijangan!5e0!3m2!1sid!2sid!4v1754168591726!5m2!1sid!2sid"
                        width="100%" height="250" style="border:0; min-width:250px;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>

        <div class="text-center mt-8 text-sm text-gray-700 py-4 rounded-b-2xl break-words">
            © {{ date('Y') }} Pondok Pesantren Al-Anwar Pakijangan. All rights reserved.
        </div>
    </div>

    <!-- ===================== -->
    <!-- MOBILE: RINGKAS + MODERN -->
    <!-- ===================== -->
    <div class="sm:hidden px-4 pb-6">
        <!-- Card footer -->
        <div class="bg-white/70 backdrop-blur rounded-2xl p-4 shadow-sm border border-gray-200">
            <!-- Header kecil -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.webp') }}" alt="Logo Al-Anwar" class="h-10 w-10 shrink-0">
                <div class="leading-tight">
                    <p class="font-bold text-base">Pondok Pesantren</p>
                    <p class="font-bold text-base text-[#008362]">Al-Anwar Pakijangan</p>
                </div>
            </div>

            <!-- Quick actions -->
            <div class="grid grid-cols-3 gap-2 mt-4 text-sm">
                <a href="tel:0283870290"
                   class="flex items-center justify-center gap-2 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 transition">
                    <i class="fas fa-phone"></i>
                    <span>Telp</span>
                </a>

                <a href="https://instagram.com/pesantrenalanwar"
                   target="_blank" rel="noopener"
                   class="flex items-center justify-center gap-2 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 transition">
                    <i class="fab fa-instagram"></i>
                    <span>IG</span>
                </a>

                <a href="https://www.youtube.com/@alanwarpakijangan5759"
                   target="_blank" rel="noopener"
                   class="flex items-center justify-center gap-2 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 transition">
                    <i class="fab fa-youtube"></i>
                    <span>YT</span>
                </a>
            </div>

            <!-- Alamat ringkas -->
            <div class="mt-4 text-sm text-gray-700">
                <p class="font-semibold mb-1">Alamat</p>
                <p class="leading-relaxed">
                    Jl. Raya Pakijangan R. Bulakamba No.08, Pakijangan, Bulakamba, Brebes
                </p>
            </div>

            <!-- Button maps -->
            <a href="https://www.google.com/maps?q=Pondok+Pesantren+Al+Anwar+Pakijangan"
               target="_blank" rel="noopener"
               class="mt-4 inline-flex w-full items-center justify-center gap-2 py-2.5 rounded-xl bg-[#008362] text-white font-semibold hover:opacity-90 transition">
                <i class="fas fa-map-marker-alt"></i>
                <span>Buka Lokasi di Google Maps</span>
            </a>
        </div>

        <!-- Copyright mobile -->
        <div class="text-center mt-4 text-xs text-gray-600">
            © {{ date('Y') }} Al-Anwar Pakijangan
        </div>
    </div>

</footer>
