<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Edit Kategori</h2></x-slot>
    <div class="py-12"><div class="max-w-2xl mx-auto sm:px-6 lg:px-8"><div class="bg-white p-8 shadow-sm sm:rounded-lg">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-sm font-medium">Nama Kategori</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mt-6 flex justify-between items-center">
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin?');">@csrf @method('DELETE')<button type="submit" class="text-red-600">Hapus</button></form>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Perbarui</button>
            </div>
        </form>
    </div></div></div>
</x-app-layout>