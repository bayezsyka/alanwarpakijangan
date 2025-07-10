<div>
    {{-- Search Bar --}}
    <div class="mb-6">
        <input 
            wire:model.live.debounce.300ms="search" 
            type="search" 
            placeholder="Ketik untuk mencari judul atau penulis..."
            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#008362]">
    </div>

    {{-- Tabel Artikel --}}
    <div class="overflow-x-auto border border-gray-200 rounded-lg">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Penulis</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Dibuat Pada</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($articles as $article)
                    <tr>
                        <td class="py-4 px-6 whitespace-nowrap font-medium text-gray-900">{{ Str::limit($article->judul, 50) }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">
                            {{-- Badge untuk Kategori --}}
                            <span @class([
                                'px-2 py-1 text-xs font-semibold rounded-full',
                                'bg-sky-100 text-sky-800' => $article->kategori == 'Artikel',
                                'bg-amber-100 text-amber-800' => $article->kategori == 'Opini',
                            ])>
                                {{ $article->kategori }}
                            </span>
                        </td>
                        <td class="py-4 px-6 whitespace-nowrap text-gray-600">{{ $article->penulis }}</td>
                        <td class="py-4 px-6 whitespace-nowrap text-gray-600">{{ $article->created_at->format('d M Y') }}</td>
                        <td class="py-4 px-6 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.artikel.edit', $article->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">Edit</a>
                            <span class="mx-2 text-gray-300">|</span>
                            
                            <button 
                                wire:click="$dispatch('show-delete-confirmation', { id: {{ $article->id }}, name: '{{ e($article->judul) }}' })"
                                type="button" 
                                class="text-red-600 hover:text-red-900 font-semibold">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 px-6 text-center text-gray-500">
                            Tidak ada artikel yang cocok dengan pencarian Anda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginasi --}}
    @if ($articles->hasPages())
        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    @endif
</div>