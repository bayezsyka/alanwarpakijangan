<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-2xl font-semibold">
                Manajemen Pengguna
            </h1>
            <p class="mt-1 text-sm text-emerald-50/90">
                Kelola akun dan peran pengguna pada sistem admin.
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}
                {{-- <div class="p-6 text-gray-900"> --}}
                    
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    {{-- <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-semibold">Daftar Akun Admin</h3>
                        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                            Tambah User Baru
                        </a>
                    </div> --}}
                    
                    <div class="bg-gray-50 px-8 py-6 border-b border-gray-200">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="bg-[#64748b] p-2 rounded-lg">
                                     <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-800">Daftar Akun Admin</h3>
                            </div>
                            <div class="mt-4 sm:mt-0">
                                <a href="{{ route('admin.users.create') }}" 
                                class="inline-flex items-center px-6 py-3 bg-[#06b6d4] text-white rounded-lg font-medium hover:bg-cyan-600 transition-colors duration-200 shadow-lg">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Tambah User Baru
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto border border-gray-200 rounded-lg p-6 m-6">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Dibuat</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="py-4 px-6 whitespace-nowrap font-medium text-gray-900">{{ $user->name }}</td>
                                        <td class="py-4 px-6 whitespace-nowrap text-gray-600">{{ $user->email }}</td>
                                        <td class="py-4 px-6 whitespace-nowrap text-gray-600">{{ $user->created_at->format('d M Y') }}</td>
                                        <td class="py-4 px-6 whitespace-nowrap text-sm font-medium">
                                            {{-- TOMBOL EDIT --}}
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">Edit</a>
                                            
                                            @if(auth()->id() !== $user->id)
                                                <span class="mx-2 text-gray-300">|</span>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Hapus</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-4 px-6 text-center text-gray-500">
                                            Belum ada user yang ditambahkan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>
</x-app-layout>