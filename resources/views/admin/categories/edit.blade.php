<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all border border-transparent hover:border-emerald-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <span class="text-sm font-black tracking-widest uppercase">Sunting Kategori</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-card class="p-8 sm:p-12 relative overflow-hidden">
                {{-- Decorative background element --}}
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-emerald-50 rounded-full blur-3xl opacity-50"></div>
                
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" id="edit-category-form" class="space-y-10 relative z-10">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="name" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4 ml-1">Identitas Kategori <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required autofocus
                               placeholder="Contoh: DINAMIKA PONDOK"
                               class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[2rem] focus:bg-white focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-500 transition-all font-black text-lg text-gray-900 outline-none shadow-inner">
                        <div class="mt-4 flex flex-wrap gap-3 pl-2">
                             <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest italic">SLUG AKTIF: {{ $category->slug }}</p>
                             <span class="text-[9px] text-emerald-600/50 font-black uppercase tracking-widest">• {{ number_format($category->articles_count) }} KONTEN TERKAIT</span>
                        </div>
                        @error('name')
                            <p class="text-[10px] text-red-600 mt-2 font-black uppercase tracking-tight pl-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="pt-8 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-6">
                        <button type="button" @click="confirmDelete('{{ $category->name }}')" 
                                class="w-full sm:w-auto px-6 py-3.5 text-[10px] font-black text-red-400 hover:text-red-600 hover:bg-red-50 border border-transparent hover:border-red-100 rounded-2xl transition-all uppercase tracking-widest text-center">
                            ELIMINASI KATEGORI
                        </button>
                        
                        <div class="flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto">
                            <a href="{{ route('admin.categories.index') }}" 
                               class="w-full sm:w-auto px-8 py-3.5 text-[10px] font-black text-gray-400 bg-white border border-gray-100 rounded-2xl hover:bg-gray-50 hover:text-gray-600 transition-all shadow-sm uppercase tracking-widest text-center">
                                BATAL
                            </a>
                            <button type="submit" class="w-full sm:w-auto px-10 py-4 bg-emerald-600 text-white rounded-[1.5rem] font-black text-[10px] uppercase tracking-[0.2em] shadow-xl shadow-emerald-200 hover:bg-emerald-700 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                SIMPAN PERUBAHAN
                            </button>
                        </div>
                    </div>
                </form>
                
                <form id="delete-form" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </x-card>
            
            <div class="mt-8 text-center">
                <p class="text-[9px] font-black text-gray-300 uppercase tracking-[0.3em]">TAKSONOMI ARSIP AL-ANWAR • ID#{{ $category->id }}</p>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDelete(name) {
            Swal.fire({
                title: 'ELIMINASI KATEGORI?',
                html: `<p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-4">Kategori "${name}" akan dihapus permanen. Pastikan tidak ada artikel kritis yang kehilangan navigasi.</p>`,
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
                    document.getElementById('delete-form').submit();
                }
            });
        }
    </script>
    <style>
        .animate-scaleIn { animation: scaleIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
        @keyframes scaleIn { 0% { opacity: 0; transform: scale(0.95) translateY(10px); } 100% { opacity: 1; transform: scale(1) translateY(0); } }
    </style>
    @endpush
</x-app-layout>