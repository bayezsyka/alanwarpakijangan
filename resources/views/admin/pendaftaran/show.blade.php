<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 to-sky-600 rounded-xl shadow-lg">
            <div class="px-8 py-6">
                <h2 class="text-2xl font-bold text-white">
                    Detail Pendaftar: {{ $pendaftaran->nama_lengkap }}
                </h2>
                <p class="text-sky-100 mt-2">NIK: {{ $pendaftaran->nik }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-400 p-4 rounded-r-lg">
                    <p class="font-medium text-emerald-800">{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b font-semibold text-gray-800">Data Diri Calon Santri</div>
                        <dl class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-6">
                            <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt><dd class="mt-1 text-base text-gray-900">{{ $pendaftaran->nama_lengkap }}</dd></div>
                            <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">Jenis Kelamin</dt><dd class="mt-1 text-base text-gray-900">{{ $pendaftaran->jenis_kelamin }}</dd></div>
                            <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">NIK</dt><dd class="mt-1 text-base text-gray-900">{{ $pendaftaran->nik }}</dd></div>
                            <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">NISN</dt><dd class="mt-1 text-base text-gray-900">{{ $pendaftaran->nisn ?? '-' }}</dd></div>
                            <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">Tempat, Tanggal Lahir</dt><dd class="mt-1 text-base text-gray-900">{{ $pendaftaran->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->format('d F Y') }}</dd></div>
                            <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">Nomor WhatsApp</dt><dd class="mt-1 text-base text-gray-900">{{ $pendaftaran->nomor_wa }}</dd></div>
                            <div class="sm:col-span-2"><dt class="text-sm font-medium text-gray-500">Alamat Lengkap</dt><dd class="mt-1 text-base text-gray-900 whitespace-pre-wrap">{{ $pendaftaran->alamat }}</dd></div>
                             <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">Asal Sekolah</dt><dd class="mt-1 text-base text-gray-900">{{ $pendaftaran->asal_sekolah }}</dd></div>
                            <div class="sm:col-span-1"><dt class="text-sm font-medium text-gray-500">Tahun Lulus</dt><dd class="mt-1 text-base text-gray-900">{{ $pendaftaran->tahun_lulus }}</dd></div>
                        </dl>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b font-semibold text-gray-800">Data Orang Tua / Wali</div>
                        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-8">
                            <dl class="space-y-4">
                                <div class="font-medium text-gray-700">Data Ayah</div>
                                <div><dt class="text-xs text-gray-500">Nama</dt><dd>{{ $pendaftaran->nama_ayah }}</dd></div>
                                <div><dt class="text-xs text-gray-500">Pekerjaan</dt><dd>{{ $pendaftaran->pekerjaan_ayah }}</dd></div>
                                <div><dt class="text-xs text-gray-500">Telepon</dt><dd>{{ $pendaftaran->telepon_ayah }}</dd></div>
                            </dl>
                            <dl class="space-y-4">
                                <div class="font-medium text-gray-700">Data Ibu</div>
                                <div><dt class="text-xs text-gray-500">Nama</dt><dd>{{ $pendaftaran->nama_ibu }}</dd></div>
                                <div><dt class="text-xs text-gray-500">Pekerjaan</dt><dd>{{ $pendaftaran->pekerjaan_ibu }}</dd></div>
                                <div><dt class="text-xs text-gray-500">Telepon</dt><dd>{{ $pendaftaran->telepon_ibu }}</dd></div>
                            </dl>
                            @if($pendaftaran->nama_wali)
                            <dl class="sm:col-span-2 space-y-4 pt-6 border-t mt-6">
                                <div class="font-medium text-gray-700">Data Wali</div>
                                <div><dt class="text-xs text-gray-500">Nama</dt><dd>{{ $pendaftaran->nama_wali }}</dd></div>
                                <div><dt class="text-xs text-gray-500">Pekerjaan</dt><dd>{{ $pendaftaran->pekerjaan_wali }}</dd></div>
                                <div><dt class="text-xs text-gray-500">Telepon</dt><dd>{{ $pendaftaran->telepon_wali }}</dd></div>
                                <div><dt class="text-xs text-gray-500">Hubungan</dt><dd>{{ $pendaftaran->hubungan_wali }}</dd></div>
                            </dl>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b font-semibold text-gray-800">Berkas Pendaftaran</div>
                        <div class="p-6 space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-2">Foto Santri</p>
                                <img src="{{ asset('storage/' . $pendaftaran->foto_santri) }}" alt="Foto Santri" class="w-full rounded-lg border">
                                <a href="{{ asset('storage/' . $pendaftaran->foto_santri) }}" target="_blank" class="text-sm text-blue-600 hover:underline mt-2 inline-block">Lihat Ukuran Penuh</a>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-2">Scan Kartu Keluarga (KK)</p>
                                <a href="{{ asset('storage/' . $pendaftaran->scan_kk) }}" target="_blank" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 border">
                                    <i class="fas fa-file-pdf text-red-500 text-xl mr-3"></i>
                                    <span class="text-sm text-gray-800">Lihat/Unduh Berkas KK</span>
                                </a>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-2">Scan Ijazah / SKL</p>
                                <a href="{{ asset('storage/' . $pendaftaran->scan_ijazah) }}" target="_blank" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 border">
                                    <i class="fas fa-file-alt text-blue-500 text-xl mr-3"></i>
                                    <span class="text-sm text-gray-800">Lihat/Unduh Berkas Ijazah</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b font-semibold text-gray-800">Status Pendaftaran</div>
                        <div class="p-6">
                            <form action="{{ route('admin.pendaftaran.update_status', $pendaftaran->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="space-y-4">
                                    <div>
                                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Ubah Status</label>
                                        <select id="status" name="status" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                            <option value="pending" @selected($pendaftaran->status == 'pending')>Pending</option>
                                            <option value="diterima" @selected($pendaftaran->status == 'diterima')>Diterima</option>
                                            <option value="ditolak" @selected($pendaftaran->status == 'ditolak')>Ditolak</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                        Simpan Status
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b font-semibold text-red-600">Tindakan Berbahaya</div>
                        <div class="p-6">
                            <p class="text-sm text-gray-600 mb-4">Menghapus data pendaftar tidak dapat diurungkan.</p>
                            <form id="delete-detail-form" action="{{ route('admin.pendaftaran.destroy', $pendaftaran->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDeleteDetail()" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                                    Hapus Data Pendaftar Ini
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
        function confirmDeleteDetail() {
            Swal.fire({
                title: 'APAKAH ANDA YAKIN?',
                text: "Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus Data Ini',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-detail-form').submit();
                }
            })
        }
    </script>
    @endpush
</x-app-layout>