{{-- Artikel --}}
<section class="min-h-screen">
    <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-20 sm:pt-24">
        <!-- Section Header -->
        <div class="text-center mb-6 sm:mb-10 md:mb-14">
            <div class="inline-block bg-blue-900/10 px-4 py-2 sm:px-6 sm:py-3 rounded-full mb-4 sm:mb-6">
                <h2 class="text-blue-900 text-xl sm:text-2xl md:text-3xl font-medium tracking-widerr">ARTIKEL TERBARU</h2>
            </div>
            <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto mb-4 sm:mb-6">
                Temukan wawasan dan pengetahuan terbaru dari para ustadz dan santri Pesantren Al-Anwar Pakijangan
            </p>
            <a href="/artikel" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold text-sm sm:text-base md:text-lg transition duration-300 group">
                Lihat Semua Artikel
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 ml-2 transform group-hover:translate-x-1 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>

        <!-- Articles Grid -->
        <div class="flex-1 flex items-center justify-center">
            @if (empty($articles))
                <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 md:p-12 text-center max-w-xs sm:max-w-md mx-auto">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-16 md:h-16 mx-auto mb-3 sm:mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 md:h-8 md:w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <p class="text-gray-500 text-sm sm:text-base md:text-lg">Belum ada artikel yang tersedia.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 md:gap-8 w-full">
                    @foreach ($articles as $a)
                        <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex flex-col h-full">
                            <a href="{{ url('artikel', ['id' => $a['id']]) }}" class="block overflow-hidden">
                                <img src="{{ $a['gambar'] }}" alt="{{ $a['judul'] }}" class="w-full h-32 sm:h-40 md:h-48 lg:h-56 object-cover hover:scale-110 transition-transform duration-500">
                            </a>
                            <div class="p-3 sm:p-4 md:p-6 flex-grow flex flex-col">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-2 sm:mb-4 text-xs sm:text-sm md:text-base text-gray-500">
                                    <span class="bg-primary-100 text-primary-700 px-2 sm:px-3 py-1 rounded-full font-medium mb-1 sm:mb-0">
                                        {{ date('d M Y', strtotime($a['tanggal'])) }}
                                    </span>
                                    <span class="font-medium">Oleh: {{ $a['penulis'] }}</span>
                                </div>
                                <h3 class="text-base sm:text-lg md:text-xl font-bold mb-2 sm:mb-3 text-gray-900 leading-tight">
                                    <a href="{{ url('artikel', ['id' => $a['id']]) }}" class="hover:text-primary-600 transition duration-300">
                                        {{ $a['judul'] }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 text-xs sm:text-sm md:text-base mb-3 sm:mb-4 md:mb-6 flex-grow leading-relaxed">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($a['isi']), 120, '…') }}
                                </p>
                                <a href="{{ url('artikel', ['id' => $a['id']]) }}" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold text-xs sm:text-sm md:text-base transition duration-300 mt-auto group">
                                    Baca selengkapnya
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 ml-2 transform group-hover:translate-x-1 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
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