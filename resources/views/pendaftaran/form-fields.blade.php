{{-- DATA DIRI SANTRI --}}
<fieldset class="space-y-6">
    <legend class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 w-full">Data Diri Santri</legend>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
        <div class="md:col-span-2">
            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
            <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}" required class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Sesuai Akta Kelahiran">
        </div>
        <div>
            <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">NIK <span class="text-red-500">*</span></label>
            <input type="text" name="nik" id="nik" value="{{ old('nik') }}" required pattern="\d{16}" title="NIK harus terdiri dari 16 digit angka." class="w-full border-gray-300 rounded-md shadow-sm" placeholder="16 digit angka">
        </div>
        <div>
            <label for="nisn" class="block text-sm font-medium text-gray-700 mb-1">NISN</label>
            <input type="text" name="nisn" id="nisn" value="{{ old('nisn') }}" pattern="\d{10}" title="NISN harus terdiri dari 10 digit angka." class="w-full border-gray-300 rounded-md shadow-sm" placeholder="10 digit angka (jika ada)">
        </div>
        <div>
            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
            <select name="jenis_kelamin" id="jenis_kelamin" required class="w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Pilih...</option>
                <option value="Laki-laki" @selected(old('jenis_kelamin') == 'Laki-laki')>Laki-laki</option>
                <option value="Perempuan" @selected(old('jenis_kelamin') == 'Perempuan')>Perempuan</option>
            </select>
        </div>
        <div>
            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}" required class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Brebes">
        </div>
        <div class="md:col-span-2">
            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required class="w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="md:col-span-2">
            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
            <textarea name="alamat" id="alamat" rows="3" required class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Jl. Pesantren No. 1, Desa Pakijangan, Kec. Bulakamba, Kab. Brebes">{{ old('alamat') }}</textarea>
        </div>
    </div>
</fieldset>

{{-- DATA ORANG TUA & WALI --}}
<fieldset class="space-y-6">
    <legend class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 w-full">Data Orang Tua & Wali</legend>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
        <div class="space-y-4 p-4 bg-gray-50 rounded-lg border">
            <h4 class="font-medium text-gray-800">Data Ayah</h4>
            <div><label for="nama_ayah" class="block text-sm mb-1">Nama Ayah <span class="text-red-500">*</span></label><input type="text" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah') }}" required class="w-full border-gray-300 rounded-md"></div>
            <div><label for="pekerjaan_ayah" class="block text-sm mb-1">Pekerjaan Ayah <span class="text-red-500">*</span></label><input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" required class="w-full border-gray-300 rounded-md"></div>
            <div><label for="telepon_ayah" class="block text-sm mb-1">Telepon Ayah <span class="text-red-500">*</span></label><input type="tel" name="telepon_ayah" id="telepon_ayah" value="{{ old('telepon_ayah') }}" required class="w-full border-gray-300 rounded-md" placeholder="Contoh: 081234567890"></div>
        </div>
        <div class="space-y-4 p-4 bg-gray-50 rounded-lg border">
            <h4 class="font-medium text-gray-800">Data Ibu</h4>
            <div><label for="nama_ibu" class="block text-sm mb-1">Nama Ibu <span class="text-red-500">*</span></label><input type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu') }}" required class="w-full border-gray-300 rounded-md"></div>
            <div><label for="pekerjaan_ibu" class="block text-sm mb-1">Pekerjaan Ibu <span class="text-red-500">*</span></label><input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" required class="w-full border-gray-300 rounded-md"></div>
            <div><label for="telepon_ibu" class="block text-sm mb-1">Telepon Ibu <span class="text-red-500">*</span></label><input type="tel" name="telepon_ibu" id="telepon_ibu" value="{{ old('telepon_ibu') }}" required class="w-full border-gray-300 rounded-md" placeholder="Contoh: 081234567890"></div>
        </div>
        <div class="md:col-span-2 space-y-4 p-4 bg-gray-50 rounded-lg border">
            <h4 class="font-medium text-gray-800">Data Wali (Opsional)</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <input type="text" name="nama_wali" placeholder="Nama Wali" value="{{ old('nama_wali') }}" class="w-full border-gray-300 rounded-md">
                <input type="text" name="pekerjaan_wali" placeholder="Pekerjaan Wali" value="{{ old('pekerjaan_wali') }}" class="w-full border-gray-300 rounded-md">
                <input type="tel" name="telepon_wali" placeholder="Telepon Wali" value="{{ old('telepon_wali') }}" class="w-full border-gray-300 rounded-md">
                <input type="text" name="hubungan_wali" placeholder="Hubungan dengan Santri" value="{{ old('hubungan_wali') }}" class="w-full border-gray-300 rounded-md">
            </div>
        </div>
    </div>
</fieldset>

{{-- RIWAYAT PENDIDIKAN & BERKAS --}}
<fieldset class="space-y-6">
    <legend class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 w-full">Riwayat Pendidikan & Berkas</legend>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
        <div><label for="asal_sekolah" class="block text-sm mb-1">Asal Sekolah <span class="text-red-500">*</span></label><input type="text" name="asal_sekolah" id="asal_sekolah" value="{{ old('asal_sekolah') }}" required class="w-full border-gray-300 rounded-md"></div>
        <div><label for="tahun_lulus" class="block text-sm mb-1">Tahun Lulus <span class="text-red-500">*</span></label><input type="number" name="tahun_lulus" id="tahun_lulus" value="{{ old('tahun_lulus') }}" required class="w-full border-gray-300 rounded-md" placeholder="Contoh: 2024" min="1950" max="2030"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div><label for="foto_santri" class="block text-sm font-medium text-gray-700 mb-1">Foto Santri (JPG/PNG) <span class="text-red-500">*</span></label><input type="file" name="foto_santri" id="foto_santri" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"></div>
        <div><label for="scan_kk" class="block text-sm font-medium text-gray-700 mb-1">Scan KK (PDF/JPG) <span class="text-red-500">*</span></label><input type="file" name="scan_kk" id="scan_kk" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"></div>
        <div><label for="scan_ijazah" class="block text-sm font-medium text-gray-700 mb-1">Scan Ijazah (PDF/JPG) <span class="text-red-500">*</span></label><input type="file" name="scan_ijazah" id="scan_ijazah" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"></div>
    </div>
</fieldset>