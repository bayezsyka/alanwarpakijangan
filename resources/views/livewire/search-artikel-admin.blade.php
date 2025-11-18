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
                            <button type="button" wire:click="openEditModal({{ $article->id }})" class="text-indigo-600 hover:text-indigo-900 font-semibold">Edit</button>
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

    {{-- Modal CRUD --}}
    @if ($showModal)
        <div class="fixed inset-0 z-40 flex items-center justify-center">
            <div class="absolute inset-0 bg-black/50" wire:click="closeModal"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-3xl w-full mx-4 overflow-y-auto max-h-[90vh]">
                <div class="flex items-start justify-between px-6 py-4 border-b">
                    <div>
                        <p class="text-sm uppercase tracking-wide text-gray-500">{{ $modalMode === 'create' ? 'Form Tambah Artikel' : 'Form Edit Artikel' }}</p>
                        <h3 class="text-2xl font-semibold text-gray-800 mt-1">
                            {{ $modalMode === 'create' ? 'Buat Artikel Baru' : 'Perbarui Artikel' }}
                        </h3>
                    </div>
                    <button type="button" wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="saveArticle" class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Artikel</label>
                            <input type="text" wire:model.defer="judul" class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            @error('judul') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <select wire:model.defer="category_id" class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                <option value="">Pilih kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                            <input type="text" wire:model.defer="penulis" class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            @error('penulis') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Konten Artikel</label>
                        <textarea wire:model.defer="isi" rows="6" class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"></textarea>
                        @error('isi') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <h4 class="text-lg font-semibold text-gray-800">Gambar Artikel</h4>
                            @if ($modalMode === 'edit' && $existingImage)
                                <label class="inline-flex items-center space-x-2 text-sm text-gray-600">
                                    <input type="checkbox" wire:model="hapus_gambar" class="rounded">
                                    <span>Hapus gambar saat ini</span>
                                </label>
                            @endif
                        </div>

                        @if ($this->previewImage)
                            <div>
                                <p class="text-sm text-gray-600 mb-2">Pratinjau</p>
                                <img src="{{ $this->previewImage }}" class="w-full h-48 object-cover rounded-xl border">
                            </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Unggah File</label>
                                <input type="file" wire:model="gambar_upload" class="w-full text-sm text-gray-600">
                                @error('gambar_upload') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">atau Masukkan URL Gambar</label>
                                <input type="url" wire:model.live.debounce.500ms="gambar_url" placeholder="https://..." class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                @error('gambar_url') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-3 pt-4 border-t">
                        <button type="button" wire:click="closeModal" class="px-5 py-2.5 rounded-lg border text-gray-600">Batal</button>
                        <button type="submit" class="px-6 py-2.5 bg-[#059568] text-white rounded-lg shadow" wire:loading.attr="disabled" wire:target="saveArticle">
                            <span wire:loading.remove wire:target="saveArticle">{{ $modalMode === 'create' ? 'Simpan Artikel' : 'Perbarui Artikel' }}</span>
                            <span wire:loading.flex wire:target="saveArticle" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                </svg>
                                Memproses...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
