{{-- FOOTER LAMA --}}
{{-- <footer class="bg-white dark:bg-gray-900">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
          <div class="mb-6 md:mb-0">
              <a href="https://flowbite.com/" class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" class="h-10 me-3" alt="Logo Pondok Pesantren Al-Anwar Pakijangan"/><span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Pondok Pesantren <br> Al-Anwar Pakijangan</span>
              </a>
          </div>
          <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3"> --}}
            {{-- <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Resources</h2>
                  <ul class="text-gray-500 dark:text-gray-400 font-medium">
                      <li class="mb-4">
                          <a href="https://flowbite.com/" class="hover:underline">Flowbite</a>
                      </li>
                      <li>
                          <a href="https://tailwindcss.com/" class="hover:underline">Tailwind CSS</a>
                      </li>
                  </ul>
              </div> --}}
              {{-- <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Ikuti Kami</h2>
                  <ul class="text-gray-500 dark:text-gray-400 font-medium">
                      <li class="mb-4">
                          <a href="https://instagram.com/pesantrenalanwar" class="hover:underline ">Instagram</a>
                      </li>
                      <li>
                          <a href="https://www.youtube.com/@alanwarpakijangan5759   " class="hover:underline">Youtube</a>
                      </li>
                  </ul>
              </div>
              <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Admin</h2>
                <ul class="text-gray-500 dark:text-gray-400 font-medium">
                    @guest
                        <li class="mb-4">
                            <a href="{{ route('login') }}" class="hover:underline">Login</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                        </li>
                    @endguest
                </ul>
              </div>
          </div>
      </div>
    </div>
</footer> --}}

{{-- INI FOOTER BARU --}}
<footer class="bg-gray-100 dark:bg-gray-900 text-gray-900 pt-12 rounded-t-3xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-3 gap-14">
        <!-- Kiri -->
        <div>
            <div class="mb-4 flex items-center pb-3 border-b border-gray-300 w-fit">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Al-Anwar" class="h-14 mr-3 shrink-0">
                <h3 class="text-lg font-bold break-words">
                    Pondok Pesantren <br> Al-Anwar Pakijangan
                </h3>
            </div>
            <p class="text-sm text-justify break-words">
                Menjadi lembaga yang menumbuhkan potensi setiap santri secara personal dan reflektif, membentuk karakter yang kokoh dan bijaksana, serta menguatkan ilmu sebagai cahaya hidup yang menuntun santri menapaki jalan dunia dan akhirat secara seimbang dan bermakna.
            </p>

            <!-- Admin -->
            {{-- <div class="mt-6">
                <h4 class="text-md font-bold mb-3 border-b border-gray-300 pb-1 w-fit">Admin</h4>
                <ul class="text-sm space-y-2">
                    @guest
                        <li>
                            <a href="{{ route('login') }}" class="hover:underline break-all">Login</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('dashboard') }}" class="hover:underline break-all">Dashboard</a>
                        </li>
                    @endguest
                </ul>
            </div> --}}
        </div>

        <!-- Tengah -->
        <div>
            <h4 class="text-lg font-bold mb-3 border-b border-gray-300 pb-1 w-fit">Kontak</h4>
            <ul class="text-sm space-y-2">
                <li class="break-words">
                    <i class="fas fa-phone"></i> Telepon : (0283) 870290
                </li>
                {{-- 
                <li>
                    <i class="fab fa-whatsapp mr-2"></i>WhatsApp : 08119080707
                </li>
                <li>
                    <i class="fas fa-envelope mr-2"></i>humasassalaam@gmail.com
                </li>
                --}}
            </ul>

            <h4 class="text-lg font-bold mt-6 mb-3 border-b border-gray-300 pb-1 w-fit">Alamat Lengkap</h4>
            <p class="text-sm text-justify break-words">
                Jl. Raya Pakijangan R. Bulakamba No.08, RT.04/RW.02, Pakijangan, Kec. Bulakamba, Kabupaten Brebes, Jawa Tengah 52253
            </p>

            <!-- Sosial Media -->
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

    <!-- Copyright -->
    <div class="text-center mt-8 text-sm text-gray-700 py-4 rounded-b-2xl break-words">
        © {{ date('Y') }} Pondok Pesantren Al-Anwar Pakijangan. All rights reserved.
    </div>
</footer>
