<x-app-layout>
    <x-slot name="header">
        Kegiatan & Galeri
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-card no-padding overflow-hidden>
                <x-slot name="header">
                    <div class="flex items-center justify-between w-full">
                        <div class="flex items-center space-x-3">
                            <div class="bg-emerald-600 p-2 rounded-lg text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">Daftar Galeri Kegiatan</h3>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total: {{ $events->total() }} Kegiatan</p>
                            </div>
                        </div>

                        <a href="{{ route('admin.events.create') }}"
                           class="inline-flex items-center justify-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition-all shadow-sm shadow-emerald-100 group">
                            <svg class="w-4 h-4 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Galeri Baru
                        </a>
                    </div>
                </x-slot>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th scope="col" class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Judul Acara</th>
                                <th scope="col" class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Tanggal</th>
                                <th scope="col" class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Koleksi Foto</th>
                                <th scope="col" class="px-6 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-50">
                            @forelse ($events as $event)
                                <tr class="hover:bg-emerald-50/30 transition-colors group">
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 mr-4 shadow-inner group-hover:scale-110 transition-transform">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <span class="text-sm font-bold text-gray-900 group-hover:text-emerald-700 transition-colors">{{ $event->nama_acara }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex flex-col">
                                            <span class="text-xs font-bold text-gray-700 leading-none mb-1">
                                                {{ $event->tanggal ? \Carbon\Carbon::parse($event->tanggal)->locale('id')->translatedFormat('d M Y') : '-' }}
                                            </span>
                                            <span class="text-[10px] font-bold text-gray-400">📅 Waktu Kegiatan</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-center whitespace-nowrap font-medium">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-white border border-emerald-100 text-emerald-700 shadow-sm group-hover:bg-emerald-600 group-hover:text-white transition-all">
                                            {{ $event->photos_count }} Foto
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-right">
                                        <div class="flex justify-end items-center gap-2">
                                            <a href="{{ route('admin.events.edit', $event->id) }}"
                                               class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all shadow-sm border border-transparent hover:border-emerald-100"
                                               title="Edit Galeri">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="inline-block delete-form" data-name="{{ $event->nama_acara }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all shadow-sm border border-transparent hover:border-red-100" title="Hapus Galeri">
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
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <p class="text-sm font-bold text-gray-400">Belum ada galeri kegiatan.</p>
                                            <p class="text-[10px] text-gray-300 mt-1 uppercase tracking-widest font-black">Mulai unggah foto kegiatan Anda hari ini</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($events->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-center">
                        <div class="bg-white px-3 py-1.5 rounded-xl border border-gray-200 shadow-sm">
                            {{ $events->links() }}
                        </div>
                    </div>
                @endif
            </x-card>
        </div>
    </div>

    @push('scripts')
        <script>
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    const name = this.dataset.name;
                    Swal.fire({
                        title: 'ELIMINASI GALERI?',
                        html: `<p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-4">Seluruh dokumentasi visual "${name}" akan dihapus permanen dari memori digital pesantren.</p>`,
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