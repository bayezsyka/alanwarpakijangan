<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manajemen Pengumuman</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.announcements.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">+ Tambah Pengumuman</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($announcements as $announcement)
                            <tr>
                                <td class="px-6 py-4">{{ $announcement->judul }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        // Logika baru yang lebih aman untuk cek status
                                        $now = now();
                                        $isPublished = !$announcement->published_at || $now->isAfter($announcement->published_at);
                                        $isNotExpired = !$announcement->expires_at || $now->isBefore($announcement->expires_at);
                                        $isActive = $isPublished && $isNotExpired;
                                    @endphp

                                    @if($isActive)
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Ditampilkan</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    <a href="{{ route('admin.announcements.edit', $announcement->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="px-6 py-4 text-center text-gray-500">Belum ada pengumuman.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>