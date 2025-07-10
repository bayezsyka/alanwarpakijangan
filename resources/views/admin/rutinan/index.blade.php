<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Jadwal Rutinan') }}
        </h2>
    </x-slot>

    {{-- Komponen Alpine.js untuk mengontrol semua logika halaman --}}
    <div x-data="rutinanPage()">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                {{-- Notifikasi Sukses atau Error --}}
                @if (session('success'))
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="flex justify-end mb-4">
                    <a href="{{ route('admin.rutinan.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-sm">
                        + Tambah Jadwal Baru
                    </a>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="space-y-8">
                        @foreach ($days as $day_of_week => $dayName)
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 border-b pb-2 mb-4">{{ $dayName }}</h3>
                                @forelse ($groupedRutinans->get($day_of_week, collect()) as $rutinan)
                                    <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $rutinan->nama_acara }}</p>
                                            <p class="text-sm text-gray-500">{{ $rutinan->tempat }} - {{ \Carbon\Carbon::parse($rutinan->waktu)->format('H:i') }} WIB</p>
                                        </div>
                                        <div class="flex items-center space-x-4 text-sm">
                                            <a href="{{ route('admin.rutinan.edit', $rutinan->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">Edit</a>
                                            <button @click="openModal({{ json_encode($rutinan) }})" type="button" class="text-green-600 hover:text-green-900 font-semibold">
                                                Libur
                                            </button>
                                            <form action="{{ route('admin.rutinan.destroy', $rutinan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini secara permanen?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500 px-3">Kosong</p>
                                @endforelse
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Pop-up Cerdas --}}
        <div
            x-show="isModalOpen"
            x-transition
            @keydown.escape.window="isModalOpen = false"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 z-40 flex items-center justify-center"
            aria-labelledby="modal-title"
            role="dialog"
            aria-modal="true"
        >
            <div 
                @click.outside="isModalOpen = false"
                class="bg-white rounded-xl shadow-xl w-full max-w-lg"
            >
                <div class="p-6 border-b">
                    <h3 class="text-lg font-semibold" id="modal-title">Kelola Jadwal Libur</h3>
                    <p class="text-sm text-gray-600" x-text="selectedEvent.nama_acara"></p>
                </div>
                <div class="p-6 space-y-6">
                    {{-- 1. Daftar Libur yang Sudah Ada (dengan tombol batalkan) --}}
                    <div>
                        <h4 class="text-md font-semibold text-gray-700 mb-2">Tanggal Libur Terjadwal:</h4>
                        <div class="space-y-2 max-h-32 overflow-y-auto pr-2">
                            <template x-if="selectedEvent.exceptions && selectedEvent.exceptions.length > 0">
                                <template x-for="exception in selectedEvent.exceptions" :key="exception.id">
                                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded-md">
                                        <p x-text="new Date(exception.libur_date + 'T00:00:00').toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })"></p>
                                        <form :action="`/admin/rutinan/exceptions/${exception.id}`" method="POST" onsubmit="return confirm('Yakin ingin membatalkan jadwal libur ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold">Batalkan</button>
                                        </form>
                                    </div>
                                </template>
                            </template>
                            <template x-if="!selectedEvent.exceptions || selectedEvent.exceptions.length === 0">
                                <p class="text-sm text-gray-500">Belum ada tanggal libur yang diatur.</p>
                            </template>
                        </div>
                    </div>
                    
                    {{-- 2. Tombol Cepat untuk Tambah Libur --}}
                    <div class="border-t pt-6">
                        <h4 class="text-md font-semibold text-gray-700 mb-2">Pilih Cepat (5 Minggu ke Depan):</h4>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="date in suggestedDates" :key="date.value">
                                <form :action="`/admin/rutinan/${selectedEvent.id}/exceptions`" method="POST">
                                    @csrf
                                    <input type="hidden" name="libur_date" :value="date.value">
                                    <button type="submit" class="px-3 py-1 bg-gray-200 text-gray-800 rounded-full text-sm hover:bg-gray-300" x-text="date.display"></button>
                                </form>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 p-4 flex justify-end rounded-b-xl">
                    <button @click="isModalOpen = false" class="px-4 py-2 text-sm bg-white border rounded-lg hover:bg-gray-100">Tutup</button>
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
                dayNames: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],

                openModal(event) {
                    this.selectedEvent = event;
                    this.calculateSuggestedDates(event.day_of_week);
                    this.isModalOpen = true;
                },

                calculateSuggestedDates(targetDayOfWeek) {
                    let suggestions = [];
                    let currentDate = new Date();
                    
                    while (suggestions.length < 5) {
                        currentDate.setDate(currentDate.getDate() + 1);
                        if (currentDate.getDay() == targetDayOfWeek) {
                            suggestions.push({
                                display: currentDate.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' }),
                                value: `${currentDate.getFullYear()}-${String(currentDate.getMonth() + 1).padStart(2, '0')}-${String(currentDate.getDate()).padStart(2, '0')}`
                            });
                        }
                    }
                    this.suggestedDates = suggestions;
                }
            }
        }
        // Inisialisasi Alpine.js
        document.addEventListener('alpine:init', () => {
            Alpine.data('rutinanPage', rutinanPage);
        });
    </script>
    @endpush
</x-app-layout>