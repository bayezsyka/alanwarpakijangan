<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.announcements.index') }}" class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all border border-transparent hover:border-emerald-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <span class="text-sm font-black tracking-widest uppercase">Sunting Pengumuman</span>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                {{-- Informasi Utama --}}
                <x-card>
                    <x-slot name="header">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                            <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Data Pengumuman</h3>
                        </div>
                    </x-slot>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Judul / Subjek <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" value="{{ old('title', $announcement->title) }}" required
                                   class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none">
                            @error('title') <p class="text-red-500 text-[10px] mt-2 font-bold uppercase tracking-tight">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="link" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Tautan Navigasi (Opsional)</label>
                            <div class="relative group">
                                <input type="url" name="link" id="link" value="{{ old('link', $announcement->link) }}"
                                       placeholder="https://alanwar.com/halaman-tujuan"
                                       class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-emerald-600 outline-none placeholder:text-gray-300 text-sm">
                                <div class="absolute left-4 top-4 text-gray-300 group-focus-within:text-emerald-500 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50/50 p-6 rounded-3xl border border-gray-100 border-dashed">
                             <label for="image" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4 text-center">Visual Pengumuman</label>
                            <div class="flex flex-col items-center gap-5">
                                <div class="w-full max-w-sm aspect-video bg-white rounded-2xl border-2 border-dashed border-gray-200 flex flex-col items-center justify-center text-gray-300 group hover:border-emerald-300 hover:bg-emerald-50/30 transition-all shadow-inner overflow-hidden relative" 
                                     x-data="{ imageUrl: '{{ $announcement->image_url }}' }">
                                    <template x-if="imageUrl">
                                        <img :src="imageUrl" class="w-full h-full object-cover">
                                    </template>
                                    <template x-if="!imageUrl">
                                         <div class="text-center p-6">
                                            <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            <p class="text-[10px] font-black uppercase tracking-widest">Pilih Gambar Konten</p>
                                        </div>
                                    </template>
                                    <input type="file" name="image" id="image"
                                           @change="const file = $event.target.files[0]; if(file) imageUrl = URL.createObjectURL(file)"
                                           class="absolute inset-0 opacity-0 cursor-pointer">
                                </div>
                                <div class="text-center">
                                    <p class="text-[9px] font-bold text-gray-400 mt-1 uppercase tracking-tighter italic">* Biarkan kosong jika tidak ingin mengubah gambar.</p>
                                </div>
                            </div>
                            @error('image') <p class="text-red-500 text-[10px] mt-4 font-bold text-center uppercase tracking-tight">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </x-card>

                {{-- Penjadwalan & Status --}}
                <x-card>
                    <x-slot name="header">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-6 bg-blue-500 rounded-full"></div>
                            <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Penjadwalan & Status</h3>
                        </div>
                    </x-slot>

                    <div class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="start_date" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Mulai Tampil</label>
                                <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $announcement->start_date->toDateString()) }}"
                                       class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none shadow-sm">
                                @error('start_date') <p class="text-red-500 text-[10px] mt-2 font-bold uppercase tracking-tight">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="end_date" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Berhenti Tampil</label>
                                <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $announcement->end_date->toDateString()) }}"
                                       class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none shadow-sm">
                                @error('end_date') <p class="text-red-500 text-[10px] mt-2 font-bold uppercase tracking-tight">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="flex items-center p-5 bg-emerald-50/50 rounded-2xl border border-emerald-100 shadow-sm transition-all hover:bg-emerald-50 group">
                            <div class="flex items-center h-6">
                                <input id="is_active" name="is_active" type="checkbox" value="1"
                                       class="h-6 w-6 text-emerald-600 border-emerald-200 rounded-lg focus:ring-emerald-500 focus:ring-offset-0 transition-all cursor-pointer shadow-inner"
                                       {{ old('is_active', $announcement->is_active) ? 'checked' : '' }}>
                            </div>
                            <div class="ml-4 text-sm">
                                <label for="is_active" class="font-black text-gray-800 cursor-pointer select-none uppercase tracking-widest text-xs group-hover:text-emerald-700 transition-colors">Aktifkan Pengumuman</label>
                                <p class="text-emerald-600/60 font-bold text-[10px] mt-0.5 uppercase tracking-tighter">Pesan akan ditayangkan sesuai jadwal di atas</p>
                            </div>
                        </div>
                    </div>
                </x-card>

                {{-- Footer/Aksi --}}
                <div class="flex items-center justify-between p-6 bg-white rounded-3xl border border-gray-100 shadow-sm">
                    <a href="{{ route('admin.announcements.index') }}" 
                       class="px-6 py-3 text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-gray-600 transition-colors">
                        BATALKAN PERUBAHAN
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center px-10 py-4 bg-emerald-600 rounded-2xl font-black text-xs text-white uppercase tracking-[0.2em] shadow-xl shadow-emerald-200 hover:bg-emerald-700 hover:scale-[1.02] transition-all active:scale-95">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        SIMPAN PERUBAHAN
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
