<x-app-layout>
    <x-slot name="header">
        Informasi & Pengumuman
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-card no-padding overflow-hidden>
                <x-slot name="header">
                    <div class="flex items-center justify-between w-full">
                        <div class="flex items-center space-x-3">
                            <div class="bg-emerald-600 p-2 rounded-lg text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">Daftar Pengumuman</h3>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total: {{ $announcements->total() }} Pengumuman</p>
                            </div>
                        </div>

                        <a href="{{ route('admin.announcements.create') }}"
                           class="inline-flex items-center justify-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition-all shadow-sm shadow-emerald-100 group">
                            <svg class="w-4 h-4 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Buat Pengumuman
                        </a>
                    </div>
                </x-slot>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th scope="col" class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Keterangan Pengumuman</th>
                                <th scope="col" class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Masa Tayang</th>
                                <th scope="col" class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Status</th>
                                <th scope="col" class="px-6 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-50">
                            @forelse ($announcements as $announcement)
                                <tr class="hover:bg-emerald-50/30 transition-colors group">
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-gray-900 group-hover:text-emerald-700 transition-colors mb-1">{{ $announcement->title }}</span>
                                            @if ($announcement->link)
                                                <div class="flex items-center text-[11px] font-bold text-gray-400 truncate max-w-xs">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                                    <a href="{{ $announcement->link }}" target="_blank" class="hover:underline hover:text-emerald-600 transition-colors">{{ Str::limit($announcement->link, 40) }}</a>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="flex flex-col text-xs font-bold text-gray-600">
                                                <span class="text-[9px] uppercase tracking-tighter text-gray-400 mb-0.5">Mulai</span>
                                                {{ $announcement->start_date->locale('id')->format('d M Y') }}
                                            </div>
                                            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7"/></svg>
                                            <div class="flex flex-col text-xs font-bold text-gray-600">
                                                <span class="text-[9px] uppercase tracking-tighter text-gray-400 mb-0.5">Selesai</span>
                                                {{ $announcement->end_date->locale('id')->format('d M Y') }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        @php
                                            $isActive = $announcement->is_active
                                                && now()->startOfDay()->lte($announcement->end_date->startOfDay())
                                                && now()->startOfDay()->gte($announcement->start_date->startOfDay());
                                        @endphp
                                        @if($isActive)
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm transition-all group-hover:bg-emerald-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 mr-2 animate-pulse"></span>
                                                Aktif / Tayang
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider bg-gray-50 text-gray-400 border border-gray-100 shadow-sm transition-all group-hover:bg-gray-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400 mr-2"></span>
                                                Tidak Tayang
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-right">
                                        <div class="flex justify-end items-center gap-2">
                                            <a href="{{ route('admin.announcements.edit', $announcement) }}"
                                               class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all shadow-sm border border-transparent hover:border-emerald-100"
                                               title="Edit Pengumuman">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.announcements.destroy', $announcement) }}"
                                                  method="POST"
                                                  class="delete-form" data-name="{{ $announcement->title }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all shadow-sm border border-transparent hover:border-red-100" title="Hapus Pengumuman">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-20 h-20 bg-gray-50 rounded-3xl flex items-center justify-center mb-4 border border-gray-100 shadow-inner">
                                                <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                                                </svg>
                                            </div>
                                            <p class="text-sm font-bold text-gray-400">Belum ada pengumuman.</p>
                                            <p class="text-[10px] text-gray-300 mt-1 uppercase tracking-widest font-black">Informasikan kabar terbaru melalui popup di beranda</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($announcements->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-center">
                        <div class="bg-white px-3 py-1.5 rounded-xl border border-gray-200 shadow-sm">
                            {{ $announcements->links() }}
                        </div>
                    </div>
                @endif
            </x-card>
        </div>
    </div>

    @push('scripts')
    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const name = this.dataset.name;
                Swal.fire({
                    title: 'ELIMINASI PENGUMUMAN?',
                    html: `<p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-4">Pengumuman "${name}" akan dihapus permanen. Pesan ini tidak akan lagi muncul di modal beranda pengunjung.</p>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#059669',
                    cancelButtonColor: '#f43f5e',
                    confirmButtonText: 'YA, ELIMINASI',
                    cancelButtonText: 'BATALKAN',
                    padding: '2rem',
                    borderRadius: '2rem',
                    customClass: {
                        title: 'text-xl font-black tracking-widest text-gray-800',
                        confirmButton: 'px-8 py-3 rounded-xl font-black text-xs',
                        cancelButton: 'px-8 py-3 rounded-xl font-black text-xs'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
