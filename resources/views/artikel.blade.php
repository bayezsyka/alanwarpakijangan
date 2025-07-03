<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artikel - Pesantren Al-Anwar</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles for the button, replace with your actual styles if different */
        .btn-primary {
            background-color: #f53003; /* A shade of red/orange */
            color: #ffffff;
            border: none;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #e02a00;
        }
        .btn-outline {
            border-color: #f53003; /* A shade of red/orange */
            color: #f53003;
            background-color: transparent;
        }
        .btn-outline:hover {
            background-color: #f53003;
            color: #ffffff;
        }
    </style>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex flex-col">

    <header class="w-full lg:max-w-4xl pt-6 max-w-[335px] text-sm mb-6 not-has-[nav]:hidden mx-auto px-4 lg:px-0">
        {{-- Mengatur tata letak navbar dengan logo di kiri dan navigasi di kanan --}}
        <nav class="flex items-center justify-between gap-4">
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Pesantren Al-Anwar" class="h-10 w-auto">
            </a>

            {{-- Bagian navigasi lainnya --}}
            <div class="flex items-center gap-4">
                <a
                    href="{{ route('artikel') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                >
                    Artikel
                </a>
                @if (Route::has('login'))
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
                @endif
            </div>
        </nav>
    </header>

    <main class="flex-grow">
        <section class="py-8 sm:py-12 px-4 sm:px-6 lg:px-8 bg-gray-50 pt-16 pb-16">
            <div class="container mx-auto max-w-7xl">
                <div class="text-center mb-8 sm:mb-12 md:mb-16">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 sm:mb-6">
                        Artikel Terbaru
                    </h2>
                    <p class="text-base sm:text-lg md:text-xl text-gray-600 max-w-3xl mx-auto mb-6 sm:mb-8">
                        Temukan wawasan dan pengetahuan terbaru dari para ustadz dan santri Pesantren Al-Anwar Pakijangan
                    </p>
                    <div class="relative w-full max-w-md mx-auto">
                        <input type="text" placeholder="Cari artikel..." class="w-full pl-4 pr-10 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex-1 flex items-center justify-center">
                    @if (empty($articles))
                        <div class="bg-white rounded-2xl shadow-lg p-8 sm:p-12 text-center max-w-md mx-auto">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 1 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <p class="text-gray-500 text-base sm:text-lg">Belum ada artikel yang tersedia.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 w-full">
                            @foreach ($articles as $article)
                                <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex flex-col h-full">
                                    <a href="{{ route('artikel.detail', ['id' => $article['id']]) }}" class="block overflow-hidden">
                                        <img src="{{ htmlspecialchars($article['gambar']) }}" alt="{{ htmlspecialchars($article['judul']) }}" class="w-full h-40 sm:h-48 md:h-56 object-cover hover:scale-110 transition-transform duration-500">
                                    </a>
                                    <div class="p-4 sm:p-6 flex-grow flex flex-col">
                                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 text-xs sm:text-sm text-gray-500">
                                            <span class="bg-blue-100 text-blue-700 px-2 sm:px-3 py-1 rounded-full font-medium mb-2 sm:mb-0">
                                                {{ date("d M Y", strtotime($article['tanggal'])) }}
                                            </span>
                                            <span class="font-medium">Oleh: {{ htmlspecialchars($article['penulis']) }}</span>
                                        </div>
                                        <h3 class="text-lg sm:text-xl font-bold mb-3 text-gray-900 leading-tight">
                                            <a href="{{ route('artikel.detail', ['id' => $article['id']]) }}" class="hover:text-blue-600 transition duration-300">
                                                {{ htmlspecialchars($article['judul']) }}
                                            </a>
                                        </h3>
                                        <p class="text-gray-600 text-sm sm:text-base mb-4 sm:mb-6 flex-grow leading-relaxed">
                                            {{ nl2br(htmlspecialchars(substr($article['isi'], 0, 120))) }}…
                                        </p>
                                        <a href="{{ route('artikel.detail', ['id' => $article['id']]) }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold text-sm sm:text-base transition duration-300 mt-auto group">
                                            Baca selengkapnya
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transform group-hover:translate-x-1 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>
</html>