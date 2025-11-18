<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-[#059568] to-emerald-600 rounded-xl shadow-lg">
            <div class="px-8 py-6">
                <h2 class="text-2xl font-bold text-white">
                    {{ __('Manajemen Artikel') }}
                </h2>
                <p class="text-emerald-100 mt-2">Kelola semua artikel publikasi Anda</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 bg-emerald-50 border-l-4 border-[#059568] rounded-r-lg p-6 shadow-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-[#059568] mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-8 py-6 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-[#059568] p-2 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800">Daftar Artikel</h3>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            <button type="button"
                                    onclick="Livewire.dispatch('open-create-modal')"
                                    class="inline-flex items-center px-6 py-3 bg-[#059568] text-white rounded-lg font-medium hover:bg-green-800 transition-colors duration-200 shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Tambah Artikel Baru
                            </button>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    @livewire('search-artikel-admin')
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('show-delete-confirmation', (data) => {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    html: `Anda akan menghapus artikel: <br><strong>${data.name}</strong>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('delete-artikel', { id: data.id });
                    }
                });
            });

            Livewire.on('article-deleted', (message) => {
                Swal.fire('Berhasil!', message, 'success');
            });

            Livewire.on('article-saved', (event) => {
                Swal.fire('Berhasil!', event.message, 'success');
            });
        });
    </script>
    @endpush
</x-app-layout>
