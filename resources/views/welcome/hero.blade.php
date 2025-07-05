{{-- Home Section --}}
    <section style="background-image: url('{{ asset('images/landingpage/bgppdb.png') }}'); background-size: cover; background-position: center;" class="w-full min-h-screen flex items-center justify-center bg-no-repeat bg-cover bg-center relative">
        <div class="container mx-auto text-center max-w-6xl">
            <h1 class="text-3xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-6 text-zinc-50 leading-tight">
                Pondok Pesantren Al-Anwar Pakijangan
            </h1>
            <div class="flex flex-col text-zinc-50 sm:flex-row justify-center gap-4 sm:gap-6">
                <a class="btn-outline text-base sm:text-lg px-6 sm:px-8 py-3 sm:py-4 rounded-xl border-2 hover:shadow-lg transition-all duration-300"
                    href="{{ url('/informasipendaftaran') }}">
                    Informasi Pendaftaran
                </a>
                <a href="{{ url('/pendaftaran') }}" class="btn-outline text-base sm:text-lg px-6 sm:px-8 py-3 sm:py-4 rounded-xl border-2 hover:shadow-lg transition-all duration-300">
                    Daftar
                </a>
            </div>
        </div>
    </section>