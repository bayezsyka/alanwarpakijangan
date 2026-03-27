<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all border border-transparent hover:border-emerald-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <span class="text-sm font-black tracking-widest uppercase">Input Kategori</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-card class="p-8 sm:p-12 relative overflow-hidden">
                {{-- Decorative background element --}}
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-emerald-50 rounded-full blur-3xl opacity-50"></div>
                
                <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-10 relative z-10">
                    @csrf
                    <div>
                        <label for="name" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4 ml-1">Identitas Kategori <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                               placeholder="Contoh: DINAMIKA PONDOK"
                               class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[2rem] focus:bg-white focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-500 transition-all font-black text-lg text-gray-900 outline-none shadow-inner">
                        <p class="text-[9px] text-gray-400 mt-3 font-bold uppercase tracking-widest pl-2 italic">Slug URL akan di-generate secara otomatis berdasar nama.</p>
                        @error('name')
                            <p class="text-[10px] text-red-600 mt-2 font-black uppercase tracking-tight pl-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="pt-8 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <a href="{{ route('admin.categories.index') }}" 
                           class="w-full sm:w-auto px-8 py-3.5 text-[10px] font-black text-gray-400 bg-white border border-gray-100 rounded-2xl hover:bg-gray-50 hover:text-gray-600 transition-all shadow-sm uppercase tracking-widest text-center">
                            BATALKAN
                        </a>
                        <button type="submit" class="w-full sm:w-auto px-10 py-4 bg-emerald-600 text-white rounded-[1.5rem] font-black text-[10px] uppercase tracking-[0.2em] shadow-xl shadow-emerald-200 hover:bg-emerald-700 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            SIMPAN KATEGORI
                        </button>
                    </div>
                </form>
            </x-card>
            
            <div class="mt-8 text-center">
                <p class="text-[9px] font-black text-gray-300 uppercase tracking-[0.3em]">MANAJEMEN ARSIP & TAKSONOMI AL-ANWAR</p>
            </div>
        </div>
    </div>
</x-app-layout>