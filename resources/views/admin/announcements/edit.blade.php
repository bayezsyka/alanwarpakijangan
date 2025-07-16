<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Edit Pengumuman</h2></x-slot>
    <div class="py-12"><div class="max-w-3xl mx-auto sm:px-6 lg:px-8"><div class="bg-white p-8 shadow-sm sm:rounded-lg">
        <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div><label for="judul">Judul</label><input type="text" name="judul" id="judul" value="{{ old('judul', $announcement->judul) }}" required class="w-full mt-1"></div>
            <div><label for="isi">Isi Pengumuman</label><textarea name="isi" id="isi" rows="5" required class="w-full mt-1">{{ old('isi', $announcement->isi) }}</textarea></div>
            <div class="grid grid-cols-2 gap-6">
                <div><label for="published_at">Tampilkan Mulai</label><input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at', $announcement->published_at) }}" class="w-full mt-1"></div>
                <div><label for="expires_at">Sembunyikan Mulai</label><input type="datetime-local" name="expires_at" id="expires_at" value="{{ old('expires_at', $announcement->expires_at) }}" class="w-full mt-1"></div>
            </div>
            <div class="flex justify-between items-center">
                <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Yakin?');">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:text-red-900">Hapus</button></form>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Perbarui</button>
            </div>
        </form>
    </div></div></div>
</x-app-layout>