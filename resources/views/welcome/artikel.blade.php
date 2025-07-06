<section class="min-h-screen">
    <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-20 sm:pt-24">
        <div class="text-center mb-6 sm:mb-10 md:mb-14">
            <div class="inline-block bg-blue-900/10 px-4 py-2 sm:px-6 sm:py-3 rounded-full mb-4 sm:mb-6">
                <h2 class="text-blue-900 text-xl sm:text-2xl md:text-3xl font-medium tracking-widerr">ARTIKEL TERBARU</h2>
            </div>
        </div>
        <div class="flex-1 flex items-center justify-center">
            @if ($articles->isEmpty())
                <div class="bg-white rounded-2xl shadow-lg p-8 sm:p-12 text-center max-w-md mx-auto">
                    <p class="text-gray-500 text-base sm:text-lg">Belum ada artikel yang tersedia.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 w-full">
                    @foreach ($articles as $a)
                        <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex flex-col h-full">
                            <a href="{{ route('artikel.detail', $a->id) }}" class="block overflow-hidden">
                                @php
                                    $imageUrl = $a->gambar && Illuminate\Support\Str::startsWith($a->gambar, 'http')
                                        ? $a->gambar
                                        : ($a->gambar ? asset('storage/' . $a->gambar) : 'https://via.placeholder.com/400x250?text=Al-Anwar');
                                @endphp
                                <img src="{{ $imageUrl }}" alt="{{ $a->judul }}" class="w-full h-48 object-cover hover:scale-110 transition-transform duration-500">
                            </a>
                            <div class="p-4 sm:p-6 flex-grow flex flex-col">
                                <h3 class="text-lg sm:text-xl font-bold mb-3 text-gray-900 leading-tight">
                                    <a href="{{ route('artikel.detail', $a->id) }}" class="hover:text-blue-600 transition duration-300">
                                        {{ $a->judul }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 text-sm sm:text-base mb-4 sm:mb-6 flex-grow leading-relaxed">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($a->isi), 100) }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>