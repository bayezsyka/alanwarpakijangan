<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-2xl font-semibold">
                Manajemen Agenda &amp; Kegiatan
            </h1>
            <p class="mt-1 text-sm text-emerald-50/90">
                Atur jadwal kegiatan dan agenda pesantren.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                {{-- <div class="bg-gray-50 px-8 py-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold text-gray-800">Daftar Acara</h3>
                        <a href="{{ route('admin.events.create') }}" class="inline-flex items-center px-6 py-3 bg-[#008362] text-white rounded-lg font-medium hover:bg-emerald-600 shadow-lg">
                            Tambah Acara Baru
                        </a>
                    </div>
                </div> --}}
                <div class="bg-gray-50 px-8 py-6 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-[#059568] p-2 rounded-lg">
                                <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800">Daftar Acara</h3>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            <a href="{{ route('admin.events.create') }}" 
                            class="inline-flex items-center px-6 py-3 bg-[#059568] text-white rounded-lg font-medium hover:bg-green-800 transition-colors duration-200 shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Tambah Acara Baru
                            </a>
                        </div>
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