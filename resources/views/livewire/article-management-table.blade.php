<div>
    {{-- Filter & Search --}}
    <div class="flex flex-col md:flex-row gap-4 mb-8">
        {{-- Search Bar --}}
        <div class="flex-1 relative group">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-emerald-500 text-gray-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input 
                wire:model.live.debounce.300ms="search" 
                type="search" 
                placeholder="Cari judul artikel..."
                class="w-full pl-11 pr-4 py-3.5 border border-gray-100 rounded-2xl bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none text-sm font-medium shadow-inner">
        </div>

        {{-- Category Filter --}}
        <div class="w-full md:w-64 relative">
             <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-emerald-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
            </div>
            <select 
                wire:model.live="category"
                class="w-full pl-11 pr-4 py-3.5 border border-gray-100 rounded-2xl bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all outline-none text-sm font-bold text-gray-700 shadow-inner appearance-none">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>


    </div>

    {{-- Tabel Artikel --}}
    <div class="overflow-x-auto rounded-xl border border-gray-100 shadow-sm">
        <table class="min-w-full divide-y divide-gray-100">
            <thead>
                <tr class="bg-gray-50/50">
                    <th scope="col" class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Info Artikel</th>
                    <th scope="col" class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Kategori</th>
                    <th scope="col" class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Statistik</th>
                    <th scope="col" class="px-6 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-50">
                @forelse ($articles as $article)
                    <tr class="hover:bg-emerald-50/30 transition-colors group">
                        <td class="px-6 py-5">
                            <div class="flex items-start gap-4">
                                {{-- Thumbnail --}}
                                <div class="shrink-0">
                                    @if($article->gambar)
                                        <img src="{{ Str::startsWith($article->gambar, 'http') ? $article->gambar : asset('storage/' . $article->gambar) }}" 
                                             class="w-14 h-10 object-cover rounded-lg shadow-sm border border-gray-100 group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-14 h-10 bg-gray-50 rounded-lg flex items-center justify-center text-gray-200 border border-gray-100">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @endif
                                </div>
                                
                                {{-- Details --}}
                                <div class="flex flex-col min-w-0">
                                    <span class="text-sm font-bold text-gray-900 group-hover:text-emerald-700 transition-colors line-clamp-1 mb-0.5">
                                        {{ $article->judul }}
                                    </span>
                                    <div class="flex items-center gap-2">
                                        @if($is_admin)
                                            <span class="text-[10px] font-bold text-gray-400 flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                                {{ $article->penulis ?? ($article->user->name ?? 'Admin') }}
                                            </span>
                                            <span class="text-[10px] text-gray-300">•</span>
                                        @endif
                                        <span class="text-[10px] font-bold text-gray-400 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            {{ $article->created_at->format('d/m/y') }}
                                        </span>
                                        <span class="text-[10px] text-gray-300">•</span>
                                        
                                        <button type="button" onclick="changeStatusDialog({{ $article->id }}, '{{ $article->status }}')" class="focus:outline-none focus:ring-2 focus:ring-emerald-500/50 rounded transition-all">
                                            @if($article->status === 'published')
                                                <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded text-[9px] font-black uppercase tracking-wider hover:bg-emerald-200 transition-colors flex items-center gap-1.5 shadow-sm border border-emerald-200/50">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> PUBLISH
                                                </span>
                                            @elseif($article->status === 'draft')
                                                <span class="px-2 py-0.5 bg-gray-100 text-gray-600 rounded text-[9px] font-black uppercase tracking-wider hover:bg-gray-200 transition-colors flex items-center gap-1.5 shadow-sm border border-gray-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> DRAFT
                                                </span>
                                            @else
                                                <span class="px-2 py-0.5 bg-amber-100 text-amber-700 rounded text-[9px] font-black uppercase tracking-wider hover:bg-amber-200 transition-colors flex items-center gap-1.5 shadow-sm border border-amber-200/50">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> ARSIP
                                                </span>
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            @if($article->category)
                                <span class="bg-gray-50 text-gray-600 border border-gray-100 px-3 py-1 text-[10px] font-black uppercase tracking-wider rounded-lg shadow-sm group-hover:bg-emerald-50 group-hover:text-emerald-700 group-hover:border-emerald-100 transition-all duration-300">
                                    {{ $article->category->name }}
                                </span>
                            @else
                                <span class="text-[10px] text-gray-300 italic">Tanpa Kategori</span>
                            @endif
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                             <div class="flex items-center text-gray-400 text-[10px] font-bold">
                                <svg class="w-3.5 h-3.5 mr-1.5 opacity-40 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                {{ number_format($article->views) }} <span class="ml-1 opacity-60">Views</span>
                            </div>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap text-right">
                            <div class="flex justify-end items-center gap-2">
                                @php
                                    $editRoute = $is_admin ? route('admin.artikel.edit', $article) : route('penulis.articles.edit', $article);
                                @endphp
                                <a href="{{ $editRoute }}" 
                                   class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all shadow-sm border border-transparent hover:border-emerald-100"
                                   title="Edit Artikel">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <button type="button"
                                        wire:click="$dispatch('show-delete-confirmation', { id: {{ $article->id }}, name: '{{ addslashes($article->judul) }}' })"
                                        class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all shadow-sm border border-transparent hover:border-red-100"
                                        title="Hapus Artikel">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </td>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="p-4 bg-gray-50 rounded-full mb-4">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2 2h-7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                                <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Data Kosong</p>
                                <p class="text-xs text-gray-300 mt-1 uppercase tracking-tighter">Silakan gunakan parameter pencarian lain</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginasi --}}
    @if ($articles->hasPages())
        <div class="mt-8 flex justify-center">
            <div class="bg-white px-4 py-2 border border-gray-100 rounded-2xl shadow-sm">
                {{ $articles->links() }}
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    window.changeStatusDialog = function(id, currentStatus) {
        Swal.fire({
            title: 'STATUS KONTEN',
            input: 'select',
            inputOptions: {
                'published': 'Publish',
                'draft': 'Draft',
                'archived': 'Arsip'
            },
            inputValue: currentStatus,
            showCancelButton: true,
            confirmButtonText: 'UPDATE',
            cancelButtonText: 'BATAL',
            confirmButtonColor: '#059669',
            cancelButtonColor: '#f43f5e',
            padding: '1.5rem',
            borderRadius: '1.5rem',
            customClass: {
                title: 'text-sm font-black tracking-widest text-gray-800 uppercase',
                confirmButton: 'px-6 py-2 rounded-xl font-black text-[10px] uppercase tracking-wider',
                cancelButton: 'px-6 py-2 rounded-xl font-black text-[10px] uppercase tracking-wider',
                input: '!w-[90%] mx-auto px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl font-bold text-xs text-gray-700 outline-none mt-2 shadow-sm'
            }
        }).then((result) => {
            if (result.isConfirmed && result.value && result.value !== currentStatus) {
                Livewire.first().updateStatus(id, result.value);
            }
        });
    };
</script>
@endpush
