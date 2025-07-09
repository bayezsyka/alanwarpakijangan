<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-[#008362] to-emerald-600 rounded-xl shadow-lg">
            <div class="px-8 py-6">
                <h2 class="text-2xl font-bold text-white">
                    {{ __('Manajemen Galeri Acara') }}
                </h2>
                <p class="text-emerald-100 mt-2">Kelola semua galeri acara publikasi Anda</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 bg-emerald-50 border-l-4 border-[#008362] p-4 rounded-r-lg">
                    <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-8 py-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold text-gray-800">Daftar Acara</h3>
                        <a href="{{ route('admin.events.create') }}" class="inline-flex items-center px-6 py-3 bg-[#008362] text-white rounded-lg font-medium hover:bg-emerald-600 shadow-lg">
                            Tambah Acara Baru
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Nama Acara</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase">Jumlah Foto</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($events as $event)
                                <tr>
                                    <td class="py-4 px-6 font-medium text-gray-900">{{ $event->nama_acara }}</td>
                                    <td class="py-4 px-6 text-gray-600">{{ $event->tanggal ? \Carbon\Carbon::parse($event->tanggal)->format('d M Y') : '-' }}</td>
                                    <td class="py-4 px-6 text-gray-600 text-center">{{ $event->photos_count }}</td>
                                    <td class="py-4 px-6 text-sm font-medium">
                                        <a href="{{ route('admin.events.edit', $event->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <span class="mx-2 text-gray-300">|</span>
                                        {{-- TOMBOL HAPUS BARU --}}
                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 px-6 text-center text-gray-500">
                                        Belum ada acara yang ditambahkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if ($events->hasPages())
                    <div class="p-6 border-t">
                        {{ $events->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Script untuk SweetAlert konfirmasi hapus
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function (event) {
                    event.preventDefault(); // Mencegah form dikirim secara langsung

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Acara dan semua fotonya akan dihapus permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Jika dikonfirmasi, kirim form
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>