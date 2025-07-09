

<footer class="bg-white dark:bg-gray-900">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
          <div class="mb-6 md:mb-0">
              <a href="https://flowbite.com/" class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" class="h-10 me-3" alt="Logo Pondok Pesantren Al-Anwar Pakijangan"/><span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Pondok Pesantren <br> Al-Anwar Pakijangan</span>
              </a>
          </div>
          <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
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
              <div>
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
</footer>
