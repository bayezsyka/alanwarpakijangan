<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-[#008362] to-emerald-600 rounded-xl shadow-lg">
            <div class="px-8 py-6">
                <h2 class="text-2xl font-bold text-white">
                    {{ __('Manajemen Artikel') }}
                </h2>
                <p class="text-emerald-100 mt-2">Kelola semua artikel publikasi Anda</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 bg-emerald-50 border-l-4 border-[#008362] rounded-r-lg p-6 shadow-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-[#008362] mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <!-- Header Section -->
                <div class="bg-gray-50 px-8 py-6 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-[#008362] p-2 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800">Daftar Artikel</h3>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            <a href="{{ route('admin.artikel.create') }}" 
                               class="inline-flex items-center px-6 py-3 bg-[#008362] text-white rounded-lg font-medium hover:bg-emerald-600 transition-colors duration-200 shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Tambah Artikel Baru
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-8">
                    @forelse ($articles as $article)
                        @if ($loop->first)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @endif
                        
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-200 overflow-hidden group">
                            <!-- Image Section -->
                            <div class="relative overflow-hidden">
                                @if ($article->gambar)
                                    @php
                                        $isUrl = Illuminate\Support\Str::startsWith($article->gambar, 'http');
                                        $imageUrl = $isUrl ? $article->gambar : asset('storage/' . $article->gambar);
                                    @endphp
                                    <img src="{{ $imageUrl }}" alt="{{ $article->judul }}" 
                                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <div class="text-center">
                                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="text-sm text-gray-500">No Image</span>
                                        </div>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-opacity duration-200"></div>
                            </div>
                            
                            <!-- Content Section -->
                            <div class="p-6">
                                <h4 class="text-lg font-semibold text-gray-800 mb-3 line-clamp-2 group-hover:text-[#008362] transition-colors duration-200">
                                    {{ $article->judul }}
                                </h4>
                                
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span class="mr-4">{{ $article->penulis }}</span>
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($article->tanggal)->format('d M Y') }}</span>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                    <a href="{{ route('admin.artikel.edit', $article->id) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-[#008362] text-white rounded-lg text-sm font-medium hover:bg-emerald-600 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.artikel.destroy', $article->id) }}" method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus artikel ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg text-sm font-medium hover:bg-red-600 transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        @if ($loop->last)
                            </div>
                        @endif
                    @empty
                        <div class="text-center py-16">
                            <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-400 mb-2">Belum ada artikel</h3>
                            <p class="text-gray-500 mb-6">Mulai dengan menambahkan artikel pertama Anda</p>
                            <a href="{{ route('admin.artikel.create') }}" 
                               class="inline-flex items-center px-6 py-3 bg-[#008362] text-white rounded-lg font-medium hover:bg-emerald-600 transition-colors duration-200 shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Tambah Artikel Pertama
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($articles->hasPages())
                    <div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-sm text-gray-700">
                                <span>Menampilkan</span>
                                <span class="font-medium mx-1">{{ $articles->firstItem() }}</span>
                                <span>sampai</span>
                                <span class="font-medium mx-1">{{ $articles->lastItem() }}</span>
                                <span>dari</span>
                                <span class="font-medium mx-1">{{ $articles->total() }}</span>
                                <span>artikel</span>
                            </div>
                            <div class="custom-pagination">
                                {{ $articles->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .custom-pagination nav {
            display: flex;
            justify-content: center;
            align-items: center;
            space-x: 1;
        }
        
        .custom-pagination .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 0.5rem;
        }
        
        .custom-pagination .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 0.75rem;
            margin: 0;
            text-decoration: none;
            color: #6b7280;
            background-color: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }
        
        .custom-pagination .page-link:hover {
            background-color: #008362;
            color: white;
            border-color: #008362;
        }
        
        .custom-pagination .page-item.active .page-link {
            background-color: #008362;
            color: white;
            border-color: #008362;
        }
        
        .custom-pagination .page-item.disabled .page-link {
            color: #9ca3af;
            background-color: #f9fafb;
            border-color: #e5e7eb;
            cursor: not-allowed;
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-app-layout>