<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-gray-800 uppercase tracking-tight">Kelola Artikel</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-card no-padding>
                <x-slot name="header">
                    <div class="flex items-center justify-between w-full">
                        <div class="flex items-center space-x-3">
                            <div class="bg-emerald-600 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Daftar Artikel</h3>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.artikel.trash') }}"
                               class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-500 text-xs font-bold rounded-xl transition-all group">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Sampah
                            </a>
                            <a href="{{ route('admin.artikel.create') }}"
                               class="inline-flex items-center justify-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition-all shadow-sm shadow-emerald-100 group">
                                <svg class="w-4 h-4 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Tulis Artikel Baru
                            </a>
                        </div>
                    </div>
                </x-slot>

                <div class="p-4 sm:p-6">
                    @livewire('article-management-table')
                </div>
            </x-card>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('show-delete-confirmation', (data) => {
                Swal.fire({
                    title: 'ELIMINASI ARTIKEL?',
                    html: `<p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-4">Artikel "${data.name}" akan dihapus permanen dari arsip digital Al-Anwar.</p>`,
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
                        Livewire.dispatch('delete-artikel', { id: data.id });
                    }
                });
            });

            Livewire.on('article-deleted', (message) => {
                Swal.fire({
                    title: 'MANIFESTASI BERHASIL',
                    text: message,
                    icon: 'success',
                    confirmButtonColor: '#059669',
                    borderRadius: '2rem',
                    customClass: {
                        title: 'text-lg font-black tracking-widest text-gray-800',
                        confirmButton: 'px-8 py-3 rounded-xl font-black text-xs'
                    }
                });
            });

            Livewire.on('status-updated', (message) => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "bottom-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: message
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
