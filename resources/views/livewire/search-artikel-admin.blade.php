<div>
    <div class="mb-8">
        <input 
            wire:model.live.debounce.300ms="search" 
            type="search" 
            placeholder="Ketik untuk mencari judul atau penulis..."
            class="w-full pl-5 pr-12 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#008362] focus:border-transparent transition-all duration-200">
    </div>

    @if ($articles->isEmpty())
        <div class="text-center py-16">
            <h3 class="text-xl font-semibold text-gray-400">Artikel tidak ditemukan</h3>
            <p class="text-gray-500">Coba gunakan kata kunci lain.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($articles as $article)
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-200 overflow-hidden group">
                    {{-- ... (Struktur kartu artikel sama seperti sebelumnya) ... --}}
                    <div class="relative overflow-hidden">
                        @if ($article->gambar)
                            @php
                                $imageUrl = Illuminate\Support\Str::startsWith($article->gambar, 'http') ? $article->gambar : asset('storage/' . $article->gambar);
                            @endphp
                            <img src="{{ $imageUrl }}" alt="{{ $article->judul }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                <span class="text-sm text-gray-500">No Image</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h4 class="text-lg font-semibold text-gray-800 mb-3 line-clamp-2 group-hover:text-[#008362]">{{ $article->judul }}</h4>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                           <span>{{ $article->penulis }}</span> &nbsp; &middot; &nbsp; <span>{{ \Carbon\Carbon::parse($article->tanggal)->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                            <a href="{{ route('admin.artikel.edit', $article->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200">Edit</a>
                            <form action="{{ route('admin.artikel.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Yakin?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-50 text-red-600 rounded-lg text-sm font-medium hover:bg-red-100">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if($articles->hasPages())
        <div class="pt-8 mt-8 border-t border-gray-200">
            {{ $articles->links('vendor.pagination.tailwind') }}
        </div>
    @endif
</div>