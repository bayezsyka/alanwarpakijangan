<div class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <div class="text-center mb-12 sm:mb-16">
            <h2 class="text-4xl sm:text-5xl font-extrabold text-gray-900 mb-5 tracking-tight">
                <span class="relative inline-block">
                    <span class="relative z-10 bg-gradient-to-r from-green-500 via-green-400 to-green-300 bg-clip-text text-transparent">
                        Artikel Terbaru
                    </span>
                    <span class="absolute left-0 bottom-1 w-full h-3 bg-green-100 rounded-lg -z-0"></span>
                </span>
            </h2>
            <p class="text-lg sm:text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed mb-2">
                Temukan wawasan dan pengetahuan terbaru dari para ustadz dan santri <span class="font-semibold text-green-600">Pesantren Al-Anwar Pakijangan</span>.
            </p>
            <div class="flex justify-center gap-2 mt-4">
                <span class="inline-block w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                <span class="inline-block w-2 h-2 bg-green-300 rounded-full animate-pulse delay-150"></span>
                <span class="inline-block w-2 h-2 bg-green-200 rounded-full animate-pulse delay-300"></span>
            </div>

            <div class="relative w-full max-w-md mx-auto mt-8">
                <input 
                    wire:model.live.debounce.300ms="search"
                    type="search" 
                    name="search" 
                    placeholder="Cari artikel..."
                    class="w-full pl-5 pr-12 py-3 border border-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent shadow-sm">
                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                </div>
            </div>
        </div>

        <div class="flex-1">
            @if ($articles->isEmpty())
                <div class="bg-white rounded-xl shadow-sm p-8 text-center max-w-md mx-auto border">
                    <h3 class="text-lg font-medium text-gray-700 mb-2">Artikel tidak ditemukan</h3>
                    <p class="text-gray-500">Coba kata kunci lain atau periksa kembali pencarian Anda.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($articles as $article)
                        <article class="bg-white rounded-xl overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 flex flex-col group">
                            <a href="{{ route('artikel.detail', $article->slug) }}" class="block">
                                <div class="w-full aspect-[4/2] bg-gray-100 overflow-hidden">
                                    @php
                                        $imageUrl = $article->gambar && Illuminate\Support\Str::startsWith($article->gambar, 'http')
                                            ? $article->gambar
                                            : ($article->gambar ? asset('storage/' . $article->gambar) : 'https://via.placeholder.com/800x400/f3f4f6/6b7280?text=Al-Anwar');
                                    @endphp
                                    <img 
                                        src="{{ $imageUrl }}" 
                                        alt="{{ $article->judul }}" 
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
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
                    @endforeach
                </div>
            @endif
        </div>

        @if ($articles->hasPages())
            <div class="mt-16">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
</div>