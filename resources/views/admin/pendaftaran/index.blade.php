<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 to-sky-600 rounded-xl shadow-lg">
            <div class="px-8 py-6">
                <h2 class="text-2xl font-bold text-white">Data Pendaftar Santri</h2>
                <p class="text-sky-100 mt-2">Kelola data calon santri yang telah mendaftar.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="p-8">
                    @if (session('success'))
                        <div class="mb-4 bg-emerald-50 border-l-4 border-emerald-400 p-4 rounded-r-lg">
                            <p class="font-medium text-emerald-800">{{ session('success') }}</p>
                        </div>
                    @endif
                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Nama Lengkap</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Nomor WA</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($pendaftarans as $pendaftar)
                                    <tr>
                                        <td class="py-4 px-6 whitespace-nowrap font-medium text-gray-800">{{ $pendaftar->nama_lengkap }}</td>
                                        <td class="py-4 px-6 whitespace-nowrap text-gray-600">{{ $pendaftar->nomor_wa }}</td>
                                        <td class="py-4 px-6 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $pendaftar->status == 'diterima' ? 'bg-green-100 text-green-800' : ($pendaftar->status == 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                {{ ucfirst($pendaftar->status) }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.pendaftaran.show', $pendaftar->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold mr-4">Detail</a>
                                            
                                            {{-- Form hapus sekarang memiliki ID unik --}}
                                            <form id="delete-form-{{ $pendaftar->id }}" action="{{ route('admin.pendaftaran.destroy', $pendaftar->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                
                                                {{-- Tombol ini sekarang memanggil fungsi JavaScript --}}
                                                <button type="button" onclick="confirmDelete({{ $pendaftar->id }})" class="text-red-600 hover:text-red-900 font-semibold">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="py-8 px-6 text-center text-gray-500">Belum ada data pendaftar.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">{{ $pendaftarans->links() }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk SweetAlert2 --}}
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
                    // Jika dikonfirmasi, kirim form hapus yang sesuai
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
    @endpush
</x-app-layout>