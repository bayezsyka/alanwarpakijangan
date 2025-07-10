<div>
    {{-- Sub-Navigasi untuk Filter Kategori --}}
    <div class="mb-12 flex justify-center">
        <div class="inline-flex items-center bg-gray-100 p-2 rounded-full shadow-sm space-x-2">
            <button 
                wire:click="filterKategori('Artikel')"
                @class([
                    'px-6 py-2 rounded-full text-sm font-semibold transition-colors',
                    'bg-white text-green-700 shadow' => $kategori === 'Artikel',
                    'text-gray-600 hover:bg-gray-200' => $kategori !== 'Artikel',
                ])>
                Artikel
            </button>
            <button 
                wire:click="filterKategori('Opini')"
                @class([
                    'px-6 py-2 rounded-full text-sm font-semibold transition-colors',
                    'bg-white text-green-700 shadow' => $kategori === 'Opini',
                    'text-gray-600 hover:bg-gray-200' => $kategori !== 'Opini',
                ])>
                Opini
            </button>
        </div>
    </div>
    
    {{-- Daftar Artikel --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($articles as $article)
            <article class="bg-white rounded-xl overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 flex flex-col group">
                <a href="{{ route('artikel.detail', $article->slug) }}" class="block">
                    <div class="aspect-w-4 aspect-h-3 overflow-hidden">
                        @php
                            $imageUrl = $article->gambar ? asset('storage/' . $article->gambar) : 'https://via.placeholder.com/800x600/f3f4f6/6b7280?text=Al-Anwar';
                        @endphp
                        <img src="{{ $imageUrl }}" alt="{{ $article->judul }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="p-6">
                        <span @class([
                            'inline-block px-2 py-1 text-xs font-semibold rounded-full mb-3',
                            'bg-sky-100 text-sky-800' => $article->kategori == 'Artikel',
                            'bg-amber-100 text-amber-800' => $article->kategori == 'Opini',
                        ])>{{ $article->kategori }}</span>
                        <h3 class="text-xl font-semibold text-gray-900 leading-snug group-hover:text-green-600 transition-colors duration-200">
                            {{ \Illuminate\Support\Str::limit($article->judul, 60) }}
                        </h3>
                    </div>
                </a>
                <div class="p-6 pt-0 mt-auto">
                    <div class="flex items-center text-xs text-gray-500 pt-4 border-t border-gray-100">
                        <span>{{ $article->penulis }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $article->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16">
                <p class="text-gray-500">Tidak ada tulisan dalam kategori ini.</p>
            </div>
        @endforelse
    </div>

    {{-- Paginasi --}}
    @if ($articles->hasPages())
        <div class="mt-16">
            {{ $articles->links() }}
        </div>
    @endif
</div>