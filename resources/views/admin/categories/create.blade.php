<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Tambah Kategori Baru</h2></x-slot>
    <div class="py-12"><div class="max-w-2xl mx-auto sm:px-6 lg:px-8"><div class="bg-white p-8 shadow-sm sm:rounded-lg">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium">Nama Kategori</label>
                <input type="text" name="name" id="name" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mt-6 flex justify-end"><button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">Simpan</button></div>
        </form>
    </div></div></div>
</x-app-layout>