<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pondok Pesantren Al-Anwar Pakijangan</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<header id="navbar" class="fixed top-0 right-0 w-full p-4 text-sm not-has-[nav]:hidden transform -translate-y-full transition-transform duration-300 ease-in-out z-50 bg-white dark:bg-gray-900 shadow-md">
    @if (Route::has('login'))
        <nav class="flex items-center justify-end gap-4">
            <a
                href="{{ url('/artikel') }}"
                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
            >
                Artikel
            </a>
            @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                >
                    Log in
                </a>
                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</header>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex items-center lg:justify-center min-h-screen flex-col">

    {{-- Home Section --}}
    <section style="background-image: url('{{ asset('images/landingpage/bgppdb.png') }}'); background-size: cover; background-position: center;" class="w-full min-h-screen flex items-center justify-center bg-no-repeat bg-cover bg-center relative">
        <div class="container mx-auto text-center max-w-6xl">
            <h1 class="text-3xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-6 text-zinc-50 leading-tight">
                Pondok Pesantren Al-Anwar Pakijangan
            </h1>
            <div class="flex flex-col text-zinc-50 sm:flex-row justify-center gap-4 sm:gap-6">
                <a href="#pendaftaran" class="btn-primary text-base sm:text-lg px-6 sm:px-8 py-3 sm:py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    Daftar Sekarang
                </a>
                <a href="artikel.php" class="btn-outline text-base sm:text-lg px-6 sm:px-8 py-3 sm:py-4 rounded-xl border-2 hover:shadow-lg transition-all duration-300">
                    Artikel Kami
                </a>
            </div>
        </div>
    </section>

    {{-- Artikel --}}
    <section class="min-h-screen">
        <div class="container mx-auto max-w-7xl p-8 pt-24">
            <!-- Section Header -->
            <div class="text-center mb-8 sm:mb-12 md:mb-16">
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 sm:mb-6">
                    Artikel Terbaru
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-gray-600 max-w-3xl mx-auto mb-6 sm:mb-8">
                    Temukan wawasan dan pengetahuan terbaru dari para ustadz dan santri Pesantren Al-Anwar Pakijangan
                </p>
                <a href="artikel.php" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold text-base sm:text-lg transition duration-300 group">
                    Lihat Semua Artikel
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transform group-hover:translate-x-1 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>

            <!-- Articles Grid -->
            <div class="flex-1 flex items-center justify-center">
                <?php if (empty($articles)): ?>
                    <div class="bg-white rounded-2xl shadow-lg p-8 sm:p-12 text-center max-w-md mx-auto">
                        <div class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <p class="text-gray-500 text-base sm:text-lg">Belum ada artikel yang tersedia.</p>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 w-full">
                        <?php foreach ($articles as $a): ?>
                            <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex flex-col h-full">
                                <a href="artikel.php?id=<?= htmlspecialchars($a["id"]); ?>" class="block overflow-hidden">
                                    <img src="<?= htmlspecialchars($a["gambar"]); ?>" alt="<?= htmlspecialchars($a["judul"]); ?>" class="w-full h-40 sm:h-48 md:h-56 object-cover hover:scale-110 transition-transform duration-500">
                                </a>
                                <div class="p-4 sm:p-6 flex-grow flex flex-col">
                                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 text-xs sm:text-sm text-gray-500">
                                        <span class="bg-primary-100 text-primary-700 px-2 sm:px-3 py-1 rounded-full font-medium mb-2 sm:mb-0">
                                            <?= date("d M Y", strtotime($a["tanggal"])); ?>
                                        </span>
                                        <span class="font-medium">Oleh: <?= htmlspecialchars($a["penulis"]); ?></span>
                                    </div>
                                    <h3 class="text-lg sm:text-xl font-bold mb-3 text-gray-900 leading-tight">
                                        <a href="artikel.php?id=<?= htmlspecialchars($a["id"]); ?>" class="hover:text-primary-600 transition duration-300">
                                            <?= htmlspecialchars($a["judul"]); ?>
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 text-sm sm:text-base mb-4 sm:mb-6 flex-grow leading-relaxed">
                                        <?= nl2br(htmlspecialchars(substr($a["isi"], 0, 120))); ?>…
                                    </p>
                                    <a href="artikel.php?id=<?= htmlspecialchars($a["id"]); ?>" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold text-sm sm:text-base transition duration-300 mt-auto group">
                                        Baca selengkapnya
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transform group-hover:translate-x-1 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let lastScrollTop = 0;
    const navbar = document.getElementById('navbar');
    const scrollThreshold = 100; // Minimum scroll distance to trigger navbar

    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // Jika scroll masih di atas threshold, sembunyikan navbar
        if (scrollTop <= scrollThreshold) {
            navbar.classList.add('-translate-y-full');
            navbar.classList.remove('translate-y-0');
        }
        // Jika scroll ke bawah dan melebihi threshold, tampilkan navbar
        else if (scrollTop > lastScrollTop && scrollTop > scrollThreshold) {
            navbar.classList.remove('-translate-y-full');
            navbar.classList.add('translate-y-0');
        }
        // Jika scroll ke atas tapi masih di atas threshold, sembunyikan navbar
        else if (scrollTop < lastScrollTop && scrollTop > scrollThreshold) {
            navbar.classList.remove('-translate-y-full');
            navbar.classList.add('translate-y-0');
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    });
});
</script>
</html>
