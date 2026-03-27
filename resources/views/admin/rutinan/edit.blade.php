<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.rutinan.index') }}" class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all border border-transparent hover:border-emerald-100 shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Revisi Agenda Rutin
                </h2>
                <p class="text-sm text-gray-500 mt-1">Sesuaikan parameter atau detail operasional untuk agenda rutin yang sudah ada.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('admin.rutinan.update', $rutinan->id) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                {{-- Informasi Utama --}}
                <x-card>
                    <x-slot name="header">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                            <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Parameter Utama</h3>
                        </div>
                    </x-slot>
                    
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <div class="md:col-span-4">
                                <label for="nama_acara" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Nama Kegiatan / Agenda <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_acara" id="nama_acara" value="{{ old('nama_acara', $rutinan->nama_acara) }}" required autofocus
                                       class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none">
                                @error('nama_acara') <p class="text-red-500 text-[10px] mt-2 font-bold uppercase tracking-tight">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="day_of_week" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Hari Pelaksanaan <span class="text-red-500">*</span></label>
                                <div class="relative group">
                                    <select name="day_of_week" id="day_of_week" required 
                                            class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none appearance-none cursor-pointer">
                                        <option value="6" @selected(old('day_of_week', $rutinan->day_of_week) == 6)>Sabtu</option>
                                        <option value="0" @selected(old('day_of_week', $rutinan->day_of_week) == 0)>Minggu</option>
                                        <option value="1" @selected(old('day_of_week', $rutinan->day_of_week) == 1)>Senin</option>
                                        <option value="2" @selected(old('day_of_week', $rutinan->day_of_week) == 2)>Selasa</option>
                                        <option value="3" @selected(old('day_of_week', $rutinan->day_of_week) == 3)>Rabu</option>
                                        <option value="4" @selected(old('day_of_week', $rutinan->day_of_week) == 4)>Kamis</option>
                                        <option value="5" @selected(old('day_of_week', $rutinan->day_of_week) == 5)>Jumat</option>
                                    </select>
                                    <div class="absolute right-4 top-4 text-emerald-600 pointer-events-none group-hover:scale-110 transition-transform">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </div>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="waktu" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Est. Waktu Mulai (WIB) <span class="text-red-500">*</span></label>
                                <input type="time" name="waktu" id="waktu" value="{{ old('waktu', \Carbon\Carbon::parse($rutinan->waktu)->format('H:i')) }}" required 
                                       class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none shadow-sm">
                            </div>

                            <div class="md:col-span-4">
                                <label for="tempat" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Titik Lokasi Pertemuan <span class="text-red-500">*</span></label>
                                <div class="relative group">
                                    <input type="text" name="tempat" id="tempat" value="{{ old('tempat', $rutinan->tempat) }}" required 
                                           class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none">
                                    <div class="absolute left-4 top-4 text-emerald-400 group-focus-within:text-emerald-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-card>

                {{-- Konteks Tambahan --}}
                <x-card>
                     <x-slot name="header">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-6 bg-blue-500 rounded-full"></div>
                            <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Detail Literasi</h3>
                        </div>
                    </x-slot>

                    <div class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="pengisi" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Pemateri / Mudarris (Opsional)</label>
                                <input type="text" name="pengisi" id="pengisi" value="{{ old('pengisi', $rutinan->pengisi) }}" 
                                       class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none">
                            </div>
                            <div>
                                <label for="kitab" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Kitab / Referensi Utama (Opsional)</label>
                                <input type="text" name="kitab" id="kitab" value="{{ old('kitab', $rutinan->kitab) }}" 
                                       class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none">
                            </div>
                            <div class="md:col-span-2">
                                <label for="isi" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Catatan Operasional</label>
                                <textarea name="isi" id="isi" rows="3" 
                                          class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none min-h-[100px]">{{ old('isi', $rutinan->isi) }}</textarea>
                            </div>
                        </div>
                    </div>
                </x-card>

                {{-- Footer/Aksi --}}
                <div class="flex items-center justify-between p-6 bg-white rounded-3xl border border-gray-100 shadow-sm">
                    <a href="{{ route('admin.rutinan.index') }}" 
                       class="px-6 py-3 text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-gray-600 transition-colors">
                        BATALKAN REVISI
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center px-10 py-4 bg-emerald-600 rounded-2xl font-black text-xs text-white uppercase tracking-[0.2em] shadow-xl shadow-emerald-200 hover:bg-emerald-700 hover:scale-[1.02] transition-all active:scale-95">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        SIMPAN PERUBAHAN JADWAL
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>