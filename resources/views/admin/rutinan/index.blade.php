<x-app-layout>
    <x-slot name="header">
        Agenda Rutinan
    </x-slot>

    <div x-data="rutinanPage()" class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if ($errors->any())
                <div class="mb-8 p-5 bg-red-50 border border-red-100 rounded-2xl flex items-start gap-4">
                    <div class="bg-red-500 text-white p-2 rounded-xl shadow-lg ring-4 ring-red-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-[10px] font-black text-red-800 uppercase tracking-[0.2em] mb-1">Terjadi Kendala</h3>
                        <ul class="text-xs font-bold text-red-600/80 space-y-0.5 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <x-card no-padding overflow-hidden>
                <x-slot name="header">
                    <div class="flex items-center justify-between w-full">
                        <div class="flex items-center space-x-3">
                            <div class="bg-emerald-600 p-2 rounded-lg text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Pilar Jadwal Mingguan</h3>
                        </div>

                        <a href="{{ route('admin.rutinan.create') }}"
                           class="inline-flex items-center justify-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition-all shadow-sm shadow-emerald-100 group">
                            <svg class="w-4 h-4 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Jadwal Baru
                        </a>
                    </div>
                </x-slot>

                <div class="p-8 space-y-12">
                    @foreach ($days as $day_of_week => $dayName)
                        <div class="space-y-6">
                            <div class="flex items-center gap-4">
                                <h4 class="text-sm font-black text-emerald-700 uppercase tracking-[0.3em] flex items-center shrink-0">
                                    {{ $dayName }}
                                </h4>
                                <div class="h-px bg-gray-100 flex-1"></div>
                                <span class="text-[10px] font-black text-gray-300 uppercase tracking-widest">
                                    {{ $groupedRutinans->get($day_of_week, collect())->count() }} KEGIATAN
                                </span>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                                @forelse ($groupedRutinans->get($day_of_week, collect()) as $rutinan)
                                    <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm flex items-center justify-between hover:border-emerald-200 hover:shadow-xl hover:shadow-emerald-500/5 transition-all group relative overflow-hidden">
                                        {{-- Accent Background --}}
                                        <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-gray-50 rounded-full opacity-0 group-hover:opacity-100 scale-50 group-hover:scale-100 transition-all duration-500"></div>

                                        <div class="flex items-center gap-4 relative z-10">
                                            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-all shadow-inner group-hover:rotate-6">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-black text-gray-800 group-hover:text-emerald-700 transition-colors uppercase tracking-tight">{{ $rutinan->nama_acara }}</p>
                                                <div class="flex items-center gap-4 mt-1.5">
                                                    <span class="text-[10px] font-bold text-gray-400 flex items-center uppercase tracking-tighter">
                                                        <svg class="w-3.5 h-3.5 mr-1 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        </svg>
                                                        {{ $rutinan->tempat }}
                                                    </span>
                                                    <span class="text-[10px] font-black text-emerald-600/60 flex items-center uppercase tracking-widest bg-emerald-50 px-2 py-0.5 rounded-lg border border-emerald-100/50">
                                                        {{ \Carbon\Carbon::parse($rutinan->waktu)->format('H:i') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-1.5 relative z-10 opacity-0 group-hover:opacity-100 translate-x-4 group-hover:translate-x-0 transition-all duration-300">
                                            <a href="{{ route('admin.rutinan.edit', $rutinan->id) }}"
                                               class="p-2.5 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all shadow-sm border border-transparent hover:border-emerald-100"
                                               title="Sunting">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <button @click="openModal({{ json_encode($rutinan) }})"
                                                    type="button"
                                                    class="p-2.5 text-gray-400 hover:text-amber-600 hover:bg-amber-50 rounded-xl transition-all shadow-sm border border-transparent hover:border-amber-100"
                                                    title="Manajemen Libur">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </button>
                                            <form action="{{ route('admin.rutinan.destroy', $rutinan->id) }}" method="POST" class="delete-form-rutinan" data-name="{{ $rutinan->nama_acara }}">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all shadow-sm border border-transparent hover:border-red-100" title="Eliminasi">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-span-full py-10 bg-gray-50/50 rounded-[2rem] border-2 border-dashed border-gray-100 text-center">
                                        <p class="text-[10px] font-black text-gray-300 uppercase tracking-[0.3em]">Hening: Tidak Ada Agenda</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-card>
        </div>

        {{-- Modal Manajemen Libur Premium --}}
        <div x-show="isModalOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @keydown.escape.window="isModalOpen = false"
             class="fixed inset-0 bg-gray-900/80 backdrop-blur-md z-[60] flex items-center justify-center p-4"
             x-cloak>
            
            <div @click.outside="isModalOpen = false"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 scale-90 translate-y-8"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 class="bg-white rounded-[3rem] shadow-2xl w-full max-w-lg overflow-hidden border border-gray-100 relative">
                
                {{-- Modal Header --}}
                <div class="p-8 pb-6 text-center border-b border-gray-50">
                    <div class="w-20 h-20 bg-emerald-50 text-emerald-600 rounded-[2rem] flex items-center justify-center mx-auto mb-5 shadow-inner">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-gray-800 uppercase tracking-widest">Penjadwalan Libur</h3>
                    <p class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] mt-2" x-text="selectedEvent.nama_acara"></p>
                    
                    <button @click="isModalOpen = false" class="absolute top-8 right-8 text-gray-300 hover:text-gray-900 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <div class="p-8 space-y-10">
                    {{-- Daftar Libur Aktif --}}
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4 block">Timeline Libur Mendatang</label>
                        <div class="space-y-3 max-h-56 overflow-y-auto pr-2 custom-scrollbar">
                            <template x-if="selectedEvent.exceptions && selectedEvent.exceptions.length > 0">
                                <template x-for="exception in selectedEvent.exceptions" :key="exception.id">
                                    <div class="flex items-center justify-between p-4 bg-gray-50/50 border border-gray-100 rounded-2xl hover:bg-white hover:border-red-100 transition-all group">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-xl bg-red-50 text-red-500 flex items-center justify-center mr-3 group-hover:bg-red-500 group-hover:text-white transition-all shadow-inner">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            </div>
                                            <p class="text-xs font-black text-gray-700 uppercase tracking-tight" x-text="new Date(exception.libur_date + 'T00:00:00').toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' })"></p>
                                        </div>
                                        <form :action="`/admin/rutinan/exceptions/${exception.id}`" method="POST" class="delete-exception-form">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-300 hover:text-red-600 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </template>
                            </template>
                            <template x-if="!selectedEvent.exceptions || selectedEvent.exceptions.length === 0">
                                <div class="py-12 bg-gray-50/30 rounded-3xl border border-dashed border-gray-100 text-center">
                                    <p class="text-[9px] font-black text-gray-300 uppercase tracking-[0.2em]">Agenda Berjalan Normal</p>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Quick Action Libur --}}
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4 block">Tambahkan Presensi Libur (5 Pekan)</label>
                        <div class="grid grid-cols-2 gap-3">
                            <template x-for="date in suggestedDates" :key="date.value">
                                <form :action="`/admin/rutinan/${selectedEvent.id}/exceptions`" method="POST">
                                    @csrf
                                    <input type="hidden" name="libur_date" :value="date.value">
                                    <button type="submit" class="w-full p-4 bg-white border border-gray-100 rounded-2xl text-[10px] font-black text-gray-600 uppercase tracking-widest hover:bg-emerald-600 hover:text-white hover:border-emerald-600 hover:shadow-xl hover:shadow-emerald-500/20 transition-all text-center">
                                        <span x-text="date.display"></span>
                                    </button>
                                </form>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-center">
                    <button @click="isModalOpen = false" class="px-10 py-3 text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-gray-900 transition-colors">
                        KELUAR MODAL
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function rutinanPage() {
            return {
                isModalOpen: false,
                selectedEvent: { exceptions: [] },
                suggestedDates: [],
                openModal(eventData) {
                    this.selectedEvent = eventData;
                    this.calculateSuggestedDates(eventData.day_of_week);
                    this.isModalOpen = true;
                },
                calculateSuggestedDates(targetDayOfWeek) {
                    let suggestions = [];
                    let currentDate = new Date();
                    // Advance to tomorrow first to avoid suggesting today if it already passed
                    currentDate.setDate(currentDate.getDate() + 1);
                    while (suggestions.length < 5) {
                        if (currentDate.getDay() == targetDayOfWeek) {
                            suggestions.push({
                                display: currentDate.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }),
                                value: `${currentDate.getFullYear()}-${String(currentDate.getMonth() + 1).padStart(2, '0')}-${String(currentDate.getDate()).padStart(2, '0')}`
                            });
                        }
                        currentDate.setDate(currentDate.getDate() + 1);
                    }
                    this.suggestedDates = suggestions;
                }
            }
        }
        document.addEventListener('alpine:init', () => { Alpine.data('rutinanPage', rutinanPage); });

        // Global Alert Handler
        const showConfirm = (title, html, confirmText, callback) => {
            Swal.fire({
                title: title.toUpperCase(),
                html: `<p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">${html}</p>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#059669',
                cancelButtonColor: '#f43f5e',
                confirmButtonText: confirmText.toUpperCase(),
                cancelButtonText: 'BATAL',
                padding: '2rem',
                borderRadius: '2rem',
                customClass: {
                    title: 'text-xl font-black tracking-widest text-gray-800'
                }
            }).then((result) => { if (result.isConfirmed) callback(); });
        };

        document.addEventListener('click', (e) => {
            const deleteForm = e.target.closest('.delete-form-rutinan');
            if (deleteForm) {
                e.preventDefault();
                showConfirm('Hapus Agenda?', `Agenda "<strong>${deleteForm.dataset.name}</strong>" akan dihapus permanen.`, 'Ya, Hapus', () => deleteForm.submit());
            }

            const exceptionForm = e.target.closest('.delete-exception-form');
            if (exceptionForm) {
                e.preventDefault();
                showConfirm('Hapus Libur?', 'Aktifkan kembali rutinan pada tanggal ini?', 'Ya, Aktifkan', () => exceptionForm.submit());
            }
        });
    </script>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #10b981; }
        @keyframes scaleIn { 0% { opacity: 0; transform: scale(0.9) translateY(10px); } 100% { opacity: 1; transform: scale(1) translateY(0); } }
        .animate-scaleIn { animation: scaleIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
    </style>
    @endpush
</x-app-layout>