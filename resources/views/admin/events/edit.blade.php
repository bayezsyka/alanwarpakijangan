<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Acara: {{ $event->nama_acara }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    @if ($errors->any())
                        <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md">
                            <ul class="mt-2 list-disc list-inside text-sm">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PUT')
                        {{-- Detail Acara --}}
                        <div class="p-6 bg-gray-50 rounded-xl border">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Acara</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="nama_acara" class="block font-medium text-sm text-gray-700">Nama Acara <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_acara" id="nama_acara" value="{{ old('nama_acara', $event->nama_acara) }}" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label for="tanggal" class="block font-medium text-sm text-gray-700">Tanggal (Opsional)</label>
                                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $event->tanggal) }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label for="deskripsi" class="block font-medium text-sm text-gray-700">Deskripsi (Opsional)</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">{{ old('deskripsi', $event->deskripsi) }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Manajemen Foto --}}
                        <div class="p-6 bg-gray-50 rounded-xl border">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Kelola Foto</h3>
                            <div class="mb-4">
                                <label class="block font-medium text-sm text-gray-700 mb-2">Foto Saat Ini</label>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                    @forelse($event->photos as $photo)
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $photo->file_path) }}" class="w-full h-32 object-cover rounded-lg shadow-md">
                                            <div class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                <label class="flex items-center text-white text-xs cursor-pointer">
                                                    <input type="checkbox" name="delete_photos[]" value="{{ $photo->id }}" class="mr-2 h-4 w-4 rounded text-red-500"> Hapus
                                                </label>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="col-span-full text-sm text-gray-500">Tidak ada foto.</p>
                                    @endforelse
                                </div>
                            </div>
                            <div class="mt-6">
                                <label for="photos" class="block font-medium text-sm text-gray-700">Tambah Foto Baru (Opsional)</label>
                                <input type="file" name="photos[]" id="photos" multiple class="mt-1 block w-full text-sm">
                            </div>
                        </div>

                        <div class="flex justify-end pt-6 border-t">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md">Perbarui Acara</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>