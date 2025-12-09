<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-[#059568] to-emerald-600 rounded-xl shadow-lg">
            <div class="px-8 py-6">
                <h2 class="text-2xl font-bold text-white">
                    Tambah Pengumuman Baru
                </h2>
                <p class="text-emerald-100 mt-2">
                    Pengumuman ini akan tampil sebagai popup di landing page.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-2xl p-8">
                <form action="{{ route('admin.announcements.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Judul / Subjek Pengumuman
                            </label>
                            <input type="text" name="title"
                                   value="{{ old('title') }}"
                                   class="block w-full rounded-lg border-gray-300 focus:ring-[#059568] focus:border-[#059568]">
                            @error('title')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Link (opsional)
                            </label>
                            <input type="url" name="link"
                                   placeholder="https://contoh.com/halaman"
                                   value="{{ old('link') }}"
                                   class="block w-full rounded-lg border-gray-300 focus:ring-[#059568] focus:border-[#059568]">
                            <p class="text-xs text-gray-500 mt-1">
                                Jika diisi, gambar akan bisa diklik. Jika kosong, gambar hanya tampil saja.
                            </p>
                            @error('link')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Gambar Pengumuman
                            </label>
                            <input type="file" name="image"
                                   accept=".jpg,.jpeg,.png,.webp,.svg"
                                   class="block w-full text-sm text-gray-700">
                            <p class="text-xs text-gray-500 mt-1">
                                Format: JPG, JPEG, PNG, WEBP, atau SVG. Max 2 MB.
                            </p>
                            @error('image')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal Mulai Tampil
                                </label>
                                <input type="date" name="start_date"
                                       value="{{ old('start_date', $defaultStart) }}"
                                       class="block w-full rounded-lg border-gray-300 focus:ring-[#059568] focus:border-[#059568]">
                                @error('start_date')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal Selesai Tampil
                                </label>
                                <input type="date" name="end_date"
                                       value="{{ old('end_date', $defaultEnd) }}"
                                       class="block w-full rounded-lg border-gray-300 focus:ring-[#059568] focus:border-[#059568]">
                                <p class="text-xs text-gray-500 mt-1">
                                    Default-nya 1 bulan dari hari ini, bisa diubah.
                                </p>
                                @error('end_date')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center">
                            <input id="is_active" type="checkbox" name="is_active" value="1"
                                   class="rounded border-gray-300 text-[#059568] focus:ring-[#059568]"
                                   {{ old('is_active', 1) ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 text-sm text-gray-700">
                                Aktif (ditampilkan sesuai jadwal)
                            </label>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-3">
                        <a href="{{ route('admin.announcements.index') }}"
                           class="px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-5 py-2 rounded-lg bg-[#059568] text-sm font-medium text-white hover:bg-emerald-700 shadow">
                            Simpan Pengumuman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
