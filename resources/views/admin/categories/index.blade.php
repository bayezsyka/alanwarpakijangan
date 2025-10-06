<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Manajemen Kategori</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end mb-4"><a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg">+ Tambah Kategori</a></div>
        <div class="bg-white shadow-sm sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50"><tr><th class="px-6 py-3 text-left ...">Nama Kategori</th><th class="px-6 py-3 text-left ...">Slug</th><th class="px-6 py-3 text-center ...">Jumlah Artikel</th><th class="px-6 py-3 text-left ...">Aksi</th></tr></thead>
                <tbody class="divide-y">
                    @forelse($categories as $category)
                    <tr>
                        <td class="px-6 py-4 font-medium">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-gray-500 font-mono">{{ $category->slug }}</td>
                        <td class="px-6 py-4 text-center">{{ $category->articles_count }}</td>
                        <td class="px-6 py-4 text-sm"><a href="{{ route('admin.categories.edit', $category->id) }}" class="text-indigo-600">Edit</a></td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-6 py-4 text-center">Belum ada kategori.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div></div>
</x-app-layout>