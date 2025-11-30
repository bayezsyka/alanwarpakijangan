<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Buat Pengumuman Baru</h2></x-slot>
    <div class="py-12"><div class="max-w-3xl mx-auto sm:px-6 lg:px-8"><div class="bg-white p-8 shadow-sm sm:rounded-lg">
        <form action="{{ route('admin.announcements.store') }}" method="POST" class="space-y-6">
            @csrf
            <div><label for="judul">Judul</label><input type="text" name="judul" id="judul" required class="w-full mt-1"></div>
            <div><label for="isi">Isi Pengumuman</label><textarea name="isi" id="isi" rows="5" required class="w-full mt-1"></textarea></div>
            <div class="grid grid-cols-2 gap-6">
                <div><label for="published_at">Tampilkan Mulai (Opsional)</label><input type="datetime-local" name="published_at" id="published_at" class="w-full mt-1"></div>
                <div><label for="expires_at">Sembunyikan Mulai (Opsional)</label><input type="datetime-local" name="expires_at" id="expires_at" class="w-full mt-1"></div>
            </div>
            <div class="flex justify-end"><button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">Simpan</button></div>
        </form>
    </div></div></div>
</x-app-layout>