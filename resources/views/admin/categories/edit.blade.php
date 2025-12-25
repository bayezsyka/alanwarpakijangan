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
                <button type="button" onclick="confirmDelete()" class="text-red-600 hover:text-red-800">Hapus</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Perbarui</button>
            </div>
        </form>
        <form id="delete-form" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div></div></div>

    @push('scripts')
    <script>
        function confirmDelete() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Kategori ini akan dihapus secara permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form').submit();
                }
            });
        }
    </script>
    @endpush
</x-app-layout>