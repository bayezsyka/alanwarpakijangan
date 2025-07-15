<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-[#059568] to-emerald-600 rounded-xl shadow-lg">
            <div class="px-8 py-6">
                <h2 class="text-2xl font-bold text-white">
                    Detail Pendaftar: {{ $pendaftaran->nama_lengkap }}
                </h2>
                <p class="text-emerald-100 mt-2">NIK: {{ $pendaftaran->nik }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-400 p-4 rounded-r-lg">
                    <p class="font-medium text-emerald-800">{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Kolom Kiri: Data Diri & Orang Tua --}}
                <div class="lg:col-span-2 space-y-8">
                    <x-admin.card title="Data Diri Calon Santri">
                        <x-admin.description label="Nama Lengkap" :value="$pendaftaran->nama_lengkap" />
                        <x-admin.description label="Jenis Kelamin" :value="$pendaftaran->jenis_kelamin" />
                        <x-admin.description label="NIK" :value="$pendaftaran->nik" />
                        <x-admin.description label="NISN" :value="$pendaftaran->nisn ?? '-'" />
                        <x-admin.description label="Tempat, Tanggal Lahir" :value="$pendaftaran->tempat_lahir . ', ' . \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->format('d F Y')" />
                        <x-admin.description label="Nomor WhatsApp" :value="$pendaftaran->nomor_wa" />
                        <x-admin.description label="Alamat Lengkap" :value="$pendaftaran->alamat" />
                        <x-admin.description label="Asal Sekolah" :value="$pendaftaran->asal_sekolah" />
                        <x-admin.description label="Tahun Lulus" :value="$pendaftaran->tahun_lulus" />
                    </x-admin.card>

                    <x-admin.card title="Data Orang Tua / Wali">
                        <x-admin.section label="Data Ayah">
                            <x-admin.description label="Nama" :value="$pendaftaran->nama_ayah" />
                            <x-admin.description label="Pekerjaan" :value="$pendaftaran->pekerjaan_ayah" />
                            <x-admin.description label="Telepon" :value="$pendaftaran->telepon_ayah" />
                        </x-admin.section>

                        <x-admin.section label="Data Ibu">
                            <x-admin.description label="Nama" :value="$pendaftaran->nama_ibu" />
                            <x-admin.description label="Pekerjaan" :value="$pendaftaran->pekerjaan_ibu" />
                            <x-admin.description label="Telepon" :value="$pendaftaran->telepon_ibu" />
                        </x-admin.section>

                        @if($pendaftaran->nama_wali)
                            <x-admin.section label="Data Wali">
                                <x-admin.description label="Nama" :value="$pendaftaran->nama_wali" />
                                <x-admin.description label="Pekerjaan" :value="$pendaftaran->pekerjaan_wali" />
                                <x-admin.description label="Telepon" :value="$pendaftaran->telepon_wali" />
                                <x-admin.description label="Hubungan" :value="$pendaftaran->hubungan_wali" />
                            </x-admin.section>
                        @endif
                    </x-admin.card>
                </div>

                {{-- Kolom Kanan: Berkas, Status, Aksi --}}
                <div class="space-y-8">
                    <x-admin.card title="Berkas Pendaftaran">
                        <x-admin.image label="Foto Santri" :src="asset('storage/' . $pendaftaran->foto_santri)" />
                        <x-admin.link label="Scan Kartu Keluarga (KK)" :href="asset('storage/' . $pendaftaran->scan_kk)" />
                        <x-admin.link label="Scan Ijazah / SKL" :href="asset('storage/' . $pendaftaran->scan_ijazah)" />
                    </x-admin.card>

                    <x-admin.card title="Status Pendaftaran">
                        <form action="{{ route('admin.pendaftaran.update_status', $pendaftaran->id) }}" method="POST" class="space-y-4">
                            @csrf @method('PATCH')
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Ubah Status</label>
                                <select name="status" id="status" class="w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="pending" @selected($pendaftaran->status == 'pending')>Pending</option>
                                    <option value="diterima" @selected($pendaftaran->status == 'diterima')>Diterima</option>
                                    <option value="ditolak" @selected($pendaftaran->status == 'ditolak')>Ditolak</option>
                                </select>
                            </div>
                            <button type="submit" class="w-full bg-[#059568] text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-800">Simpan Status</button>
                        </form>
                    </x-admin.card>

                    <x-admin.card title="Tindakan Berbahaya" color="red">
                        <form id="delete-detail-form" action="{{ route('admin.pendaftaran.destroy', $pendaftaran->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="button" onclick="confirmDeleteDetail()" class="w-full bg-red-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-red-700">
                                Hapus Data Pendaftar Ini
                            </button>
                        </form>
                    </x-admin.card>
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
