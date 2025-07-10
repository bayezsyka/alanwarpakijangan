<section class="bg-gray-50 py-16 sm:py-24">
    <div class="container text-center mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
    <div class="inline-block bg-[#008362] text-white px-4 md:px-6 py-2 md:py-3 rounded-full shadow-lg">
        <span class="text-xl sm:text-2xl md:text-3xl font-medium tracking-wider">ARTIKEL</span>
    </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 pt-8">
            {{-- Pastikan loop menggunakan variabel $latestArticles --}}
            @forelse($latestArticles as $article)
                <article class="bg-white rounded-xl overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 flex flex-col group">
                    <a href="{{ route('artikel.detail', $article->slug) }}" class="block">
                        {{-- UBAH RASIO GAMBAR MENJADI 2:1 (4:2) --}}
                        <div class="relative w-full" style="padding-top: 50%;">
                            @php
                                $imageUrl = $article->gambar && Illuminate\Support\Str::startsWith($article->gambar, 'http')
                                    ? $article->gambar
                                    : ($article->gambar ? asset('storage/' . $article->gambar) : 'https://via.placeholder.com/800x400/f3f4f6/6b7280?text=Al-Anwar');
                            @endphp
                            <img 
                                src="{{ $imageUrl }}" 
                                alt="{{ $article->judul }}" 
                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 leading-snug group-hover:text-green-600 transition-colors duration-200">
                                {{ \Illuminate\Support\Str::limit($article->judul, 60) }}
                            </h3>
                        </div>
                    </a>
                    
                    <div class="p-6 pt-0 mt-auto">
                        <div class="flex items-center text-xs text-gray-500 pt-4 border-t border-gray-100">
                            <span>{{ $article->penulis }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ \Carbon\Carbon::parse($article->tanggal)->format('d M Y') }}</span>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500">Belum ada artikel untuk ditampilkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>