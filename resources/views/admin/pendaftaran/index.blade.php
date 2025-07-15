<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-[#059568] to-emerald-600 rounded-xl shadow-lg">
            <div class="px-8 py-6">
                <h2 class="text-2xl font-bold text-white">Data Pendaftar Santri</h2>
                <p class="text-emerald-100 mt-2">Kelola data calon santri yang telah mendaftar.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 bg-emerald-50 border-l-4 border-[#059568] p-4 rounded-r-lg">
                    <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="p-8">
                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="min-w-full bg-white text-sm text-left">
                            <thead class="bg-gray-50 text-gray-700 uppercase">
                                <tr>
                                    <th class="py-3 px-6">Nama Lengkap</th>
                                    <th class="py-3 px-6">Nomor WA</th>
                                    <th class="py-3 px-6">Status</th>
                                    <th class="py-3 px-6">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($pendaftarans as $pendaftar)
                                    <tr>
                                        <td class="py-4 px-6 font-medium text-gray-800">{{ $pendaftar->nama_lengkap }}</td>
                                        <td class="py-4 px-6 text-gray-600">{{ $pendaftar->nomor_wa }}</td>
                                        <td class="py-4 px-6">
                                            <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full {{ 
                                                $pendaftar->status == 'diterima' ? 'bg-green-100 text-green-800' :
                                                ($pendaftar->status == 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                {{ ucfirst($pendaftar->status) }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <a href="{{ route('admin.pendaftaran.show', $pendaftar->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold mr-4">Detail</a>
                                            <form id="delete-form-{{ $pendaftar->id }}" action="{{ route('admin.pendaftaran.destroy', $pendaftar->id) }}" method="POST" class="inline-block">
                                                @csrf @method('DELETE')
                                                <button type="button" onclick="confirmDelete({{ $pendaftar->id }})" class="text-red-600 hover:text-red-900 font-semibold">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-8 px-6 text-center text-gray-500">Belum ada data pendaftar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">{{ $pendaftarans->links() }}</div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
    @endpush
</x-app-layout>
