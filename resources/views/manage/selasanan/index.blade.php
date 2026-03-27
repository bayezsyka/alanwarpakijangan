<x-app-layout>
    <x-slot name="header">
        Selasanan Pon
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Sidebar: Info Minggu Aktif --}}
                <div class="space-y-6">
                    <x-card class="relative overflow-hidden bg-white/50 backdrop-blur-sm">
                        <x-slot name="header">
                            <div class="flex items-center gap-3">
                                <div class="w-1 h-4 bg-emerald-500 rounded-full"></div>
                                <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Minggu Berjalan</h3>
                            </div>
                        </x-slot>
                        <div class="space-y-6 relative z-10">
                            <div>
                                <p class="text-3xl font-black text-gray-900 leading-tight">
                                    {{ \Carbon\Carbon::create($currentYear, $currentMonth, 1)->locale('id')->translatedFormat('F Y') }}
                                </p>
                                <div class="flex flex-wrap items-center gap-2 mt-3">
                                    <span class="px-3 py-1 bg-emerald-600 text-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-lg shadow-emerald-100 border border-emerald-500">PEKAN KE-{{ $currentWeek }}</span>
                                    <span class="text-[10px] font-bold text-gray-400 bg-gray-50 px-2 py-1 rounded-lg border border-gray-100 flex items-center uppercase tracking-tighter">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                        {{ \Carbon\Carbon::parse($currentMondayDate)->locale('id')->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                            </div>

                            <div class="pt-6 border-t border-gray-50">
                                @if($currentEntry)
                                    <div class="p-6 rounded-[2rem] bg-gradient-to-br from-emerald-50/50 to-white border border-emerald-100 shadow-sm relative group overflow-hidden">
                                        <div class="absolute -right-6 -bottom-6 opacity-5 group-hover:scale-110 transition-transform group-hover:rotate-12 duration-700">
                                            <svg class="w-32 h-32 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                        </div>
                                        <div class="relative z-10">
                                            <div class="flex items-start gap-4 mb-4">
                                                <div class="bg-emerald-600 text-white p-2.5 rounded-2xl shadow-xl shadow-emerald-200 shrink-0 group-hover:rotate-6 transition-transform">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="text-[10px] font-black text-emerald-700 uppercase tracking-[0.2em] mb-1">Status: Terdaftar</p>
                                                    <h4 class="text-sm font-black text-gray-800 line-clamp-2 leading-tight uppercase tracking-tight group-hover:text-emerald-700 transition-colors">{{ $currentEntry->title }}</h4>
                                                </div>
                                            </div>
                                            <a href="{{ route('manage.selasanan.edit', $currentEntry->id) }}"
                                               class="w-full inline-flex items-center justify-center px-4 py-3 bg-white border border-emerald-100 text-[10px] font-black text-emerald-700 rounded-2xl hover:bg-emerald-600 hover:text-white transition-all shadow-sm hover:shadow-lg hover:shadow-emerald-200">
                                                SUNTING DOKUMENTASI
                                                <svg class="w-3.5 h-3.5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-8 rounded-[2rem] bg-amber-50/30 border-2 border-dashed border-amber-100 shadow-sm text-center group">
                                         <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform shadow-inner">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                        </div>
                                        <p class="text-[10px] font-black text-amber-800 uppercase tracking-widest mb-1">Misi Tertunda</p>
                                        <p class="text-[10px] font-bold text-gray-400 leading-relaxed uppercase tracking-tighter italic">Belum ada entry dokumentasi untuk target pekan ini.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </x-card>
                </div>

                {{-- Main Content: Riwayat --}}
                <div class="lg:col-span-2">
                    <x-card no-padding overflow-hidden>
                        <x-slot name="header">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 w-full">
                                <div class="flex items-center gap-3">
                                    <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Pustaka Jurnal</h3>
                                </div>
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('manage.selasanan.create', ['monday_date' => $currentMondayDate]) }}"
                                       class="inline-flex items-center justify-center px-4 py-2 bg-emerald-50 text-emerald-700 text-[10px] font-black rounded-xl hover:bg-emerald-600 hover:text-white transition-all shadow-sm border border-emerald-100 uppercase tracking-widest">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        Input Jurnal
                                    </a>
                                    <form class="flex items-center gap-2" method="GET" action="{{ route('manage.selasanan.index') }}">
                                        <div class="relative group">
                                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                                <svg class="w-3.5 h-3.5 text-gray-300 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                </svg>
                                            </div>
                                            <input name="q" value="{{ request('q') }}" placeholder="Cari..."
                                                   class="pl-10 pr-4 py-2 text-[11px] font-bold text-gray-700 bg-gray-50 border border-transparent rounded-xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 w-full md:w-48 transition-all outline-none" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </x-slot>

                        <div class="overflow-x-auto overflow-y-hidden">
                            <table class="min-w-full divide-y divide-gray-100">
                                <thead>
                                    <tr class="bg-gray-50/50">
                                        <th scope="col" class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.3em]">Pekan & Identitas</th>
                                        <th scope="col" class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.3em]">Substansi Kajian</th>
                                        <th scope="col" class="px-8 py-5 text-center text-[10px] font-black text-gray-400 uppercase tracking-[0.3em]">Privasi</th>
                                        <th scope="col" class="px-8 py-5 text-right text-[10px] font-black text-gray-400 uppercase tracking-[0.3em]">Navigasi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-50">
                                    @forelse($entries as $e)
                                        <tr class="hover:bg-emerald-50/30 transition-all group">
                                            <td class="px-8 py-6 whitespace-nowrap">
                                                <div class="flex flex-col">
                                                    <span class="text-xs font-black text-emerald-700 tracking-tighter group-hover:scale-105 transition-transform origin-left">MINGGU {{ $e->week_of_month }}</span>
                                                    <div class="flex items-center gap-2 mt-1">
                                                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest border border-gray-100 px-2 py-0.5 rounded-md">{{ $e->monday_date->locale('id')->translatedFormat('d M Y') }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-8 py-6">
                                                <div class="flex flex-col max-w-sm">
                                                    <span class="text-sm font-black text-gray-800 group-hover:text-emerald-950 transition-colors line-clamp-1 leading-tight mb-2 uppercase tracking-tight">{{ $e->title }}</span>
                                                    <div class="flex items-center gap-4">
                                                        <span class="text-[9px] font-black text-emerald-600/60 uppercase tracking-widest flex items-center bg-gray-50 px-2.5 py-1 rounded-lg border border-gray-200/50">
                                                            <svg class="w-3.5 h-3.5 mr-1.5 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                                            {{ $e->speaker }}
                                                        </span>
                                                        @if($e->audio_path)
                                                            <span class="text-[9px] font-black text-amber-600 uppercase tracking-widest flex items-center bg-amber-50 px-2.5 py-1 rounded-lg border border-amber-100 shadow-inner">
                                                                <svg class="w-3.5 h-3.5 mr-1.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" /></svg>
                                                                AUDIO
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-8 py-6 whitespace-nowrap text-center">
                                                @if($e->is_published)
                                                    <div class="inline-flex items-center px-4 py-1.5 rounded-2xl text-[9px] font-black uppercase tracking-widest bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm relative group/status">
                                                        <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-emerald-500 rounded-full border-2 border-white animate-ping"></span>
                                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 mr-2"></span>
                                                        PUBLISHED
                                                    </div>
                                                @else
                                                    <div class="inline-flex items-center px-4 py-1.5 rounded-2xl text-[9px] font-black uppercase tracking-widest bg-gray-50 text-gray-400 border border-gray-100 shadow-sm">
                                                        OFFLINE
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-8 py-6 whitespace-nowrap text-right">
                                                <div class="flex justify-end items-center gap-2.5">
                                                    <a href="{{ route('manage.selasanan.edit', $e->id) }}"
                                                       class="p-2.5 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-[1rem] transition-all shadow-sm border border-transparent hover:border-emerald-100"
                                                       title="SUNTING">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                    </a>
                                                    <form method="POST" action="{{ route('manage.selasanan.destroy', $e->id) }}"
                                                          class="delete-form" data-name="{{ $e->title }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="p-2.5 text-gray-400 hover:text-red-600 hover:bg-red-100/50 rounded-[1rem] transition-all shadow-sm border border-transparent hover:border-red-100" title="ELIMINASI">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-8 py-24 text-center">
                                                <div class="flex flex-col items-center">
                                                    <div class="w-20 h-20 bg-gray-50/50 rounded-[2rem] flex items-center justify-center mb-6 border border-dashed border-gray-100 shadow-inner group-hover:scale-110 transition-transform">
                                                        <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                                    </div>
                                                    <p class="text-[10px] font-black text-gray-300 uppercase tracking-[0.3em]">Hening: Tidak Ada Riwayat Jurnal</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($entries->hasPages())
                            <div class="px-8 py-6 bg-gray-50 border-t border-gray-50">
                                {{ $entries->links() }}
                            </div>
                        @endif
                    </x-card>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('click', (e) => {
            const deleteForm = e.target.closest('.delete-form');
            if (deleteForm) {
                e.preventDefault();
                Swal.fire({
                    title: 'ELIMINASI JURNAL?',
                    html: `<p class="text-xs font-black text-gray-400 uppercase tracking-widest mt-4">Seluruh data literasi dan aset audio "${deleteForm.dataset.name}" akan dihapus permanen dari server.</p>`,
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
                    if (result.isConfirmed) deleteForm.submit();
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
