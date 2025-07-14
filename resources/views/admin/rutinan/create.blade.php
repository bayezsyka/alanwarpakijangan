<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($rutinan) ? 'Edit Jadwal Rutinan' : 'Tambah Jadwal Rutinan Baru' }}
        </h2> --}}
        <div class="rounded-xl shadow-lg" style="background: linear-gradient(93deg, #10b981, #14b8a6)">
            <div class="px-8 py-6">
                <h2 class="text-2xl font-bold text-white">
                    {{ isset($rutinan) ? 'Edit Jadwal Rutinan' : 'Tambah Jadwal Rutinan Baru' }}
                </h2>
                <p class="text-emerald-100 mt-2">Kelola jadwal rutinan pesantren Anda!</p>
            </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <form action="{{ isset($rutinan) ? route('admin.rutinan.update', $rutinan->id) : route('admin.rutinan.store') }}" method="POST" class="space-y-6">
                        @csrf
                        @if(isset($rutinan))
                            @method('PUT')
                        @endif

                        <div>
                            <label for="nama_acara" class="block text-sm font-medium">Nama Acara <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_acara" id="nama_acara" value="{{ old('nama_acara', $rutinan->nama_acara ?? '') }}" required class="w-full mt-1 rounded-md border-gray-300">
                        </div>
                        
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="day_of_week" class="block text-sm font-medium">Hari <span class="text-red-500">*</span></label>
                                <select name="day_of_week" id="day_of_week" required class="w-full mt-1 rounded-md border-gray-300">
                                    <option value="6" @selected(old('day_of_week', $rutinan->day_of_week ?? '') == 6)>Sabtu</option>
                                    <option value="0" @selected(old('day_of_week', $rutinan->day_of_week ?? '') == 0)>Minggu</option>
                                    <option value="1" @selected(old('day_of_week', $rutinan->day_of_week ?? '') == 1)>Senin</option>
                                    <option value="2" @selected(old('day_of_week', $rutinan->day_of_week ?? '') == 2)>Selasa</option>
                                    <option value="3" @selected(old('day_of_week', $rutinan->day_of_week ?? '') == 3)>Rabu</option>
                                    <option value="4" @selected(old('day_of_week', $rutinan->day_of_week ?? '') == 4)>Kamis</option>
                                    <option value="5" @selected(old('day_of_week', $rutinan->day_of_week ?? '') == 5)>Jumat</option>
                                </select>
                            </div>
                            <div>
                                <label for="waktu" class="block text-sm font-medium">Waktu <span class="text-red-500">*</span></label>
                                <input type="time" name="waktu" id="waktu" value="{{ old('waktu', $rutinan->waktu ?? '') }}" required class="w-full mt-1 rounded-md border-gray-300">
                            </div>
                        </div>

                        <div>
                            <label for="tempat" class="block text-sm font-medium">Tempat <span class="text-red-500">*</span></label>
                            <input type="text" name="tempat" id="tempat" value="{{ old('tempat', $rutinan->tempat ?? '') }}" required class="w-full mt-1 rounded-md border-gray-300">
                        </div>
                        
                        <div>
                            <label for="pengisi" class="block text-sm font-medium">Pengisi (Opsional)</label>
                            <input type="text" name="pengisi" id="pengisi" value="{{ old('pengisi', $rutinan->pengisi ?? '') }}" class="w-full mt-1 rounded-md border-gray-300">
                        </div>
                        
                        <div>
                            <label for="kitab" class="block text-sm font-medium">Kitab (Opsional)</label>
                            <input type="text" name="kitab" id="kitab" value="{{ old('kitab', $rutinan->kitab ?? '') }}" class="w-full mt-1 rounded-md border-gray-300">
                        </div>

                        <div>
                            <label for="isi" class="block text-sm font-medium">Keterangan (Opsional)</label>
                            <textarea name="isi" id="isi" rows="4" class="w-full mt-1 rounded-md border-gray-300">{{ old('isi', $rutinan->isi ?? '') }}</textarea>
                        </div>

                        <div class="flex justify-end pt-4 border-t">
                            <a href="{{ route('admin.rutinan.index') }}" class="px-4 py-2 text-sm text-gray-700">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">Simpan Jadwal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>