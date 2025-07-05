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
                <a href="artikel" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold text-base sm:text-lg transition duration-300 group">
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