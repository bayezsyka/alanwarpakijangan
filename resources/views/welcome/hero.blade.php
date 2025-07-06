{{-- Home Section --}}
    <section style="background-image: url('{{ asset('images/landingpage/bgppdb.png') }}'); background-size: cover; background-position: center;" class="w-full min-h-screen flex items-center justify-center bg-no-repeat bg-cover bg-center relative">
        <div class="container mx-auto text-center max-w-6xl px-4">
            <h1 class="font-bold mb-6 text-zinc-50 leading-tight
                text-2xl
                sm:text-3xl
                md:text-4xl
                lg:text-5xl
                xl:text-6xl
                2xl:text-7xl
                ">
                Pondok Pesantren Al-Anwar Pakijangan
            </h1>
            <div class="flex flex-col text-zinc-50 sm:flex-row justify-center gap-4 sm:gap-6">
                <a class="btn-outline text-sm sm:text-base md:text-lg px-4 sm:px-6 md:px-8 py-2 sm:py-3 md:py-4 rounded-xl border-2 hover:shadow-lg transition-all duration-300"
                    href="{{ url('/informasipendaftaran') }}">
                    Informasi Pendaftaran
                </a>
                <a href="{{ url('/pendaftaran') }}" class="btn-outline text-sm sm:text-base md:text-lg px-4 sm:px-6 md:px-8 py-2 sm:py-3 md:py-4 rounded-xl border-2 hover:shadow-lg transition-all duration-300">
                    Daftar
                </a>
            </div>
        </div>
    </section>