<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-[#059568] to-emerald-600 rounded-xl shadow-lg">
            <div class="px-8 py-6">
                <h2 class="text-2xl font-bold text-white">
                    Manajemen Pengumuman Landing Page
                </h2>
                <p class="text-emerald-100 mt-2">
                    Atur popup pengumuman yang tampil untuk pengunjung baru.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 bg-emerald-50 border-l-4 border-[#059568] p-4 rounded-r-lg">
                    <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-8 py-6 border-b border-gray-200 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="bg-[#059568] p-2 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13 16h-1v-4H9m4-4H9m10 4a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Daftar Pengumuman</h3>
                    </div>
                    <a href="{{ route('admin.announcements.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-[#059568] text-white text-sm font-medium rounded-lg hover:bg-emerald-700 shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Tambah Pengumuman
                    </a>
                </div>

                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Judul</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Periode</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($announcements as $announcement)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <div class="font-semibold text-gray-800">
                                            {{ $announcement->title }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            @if ($announcement->link)
                                                Link: {{ $announcement->link }}
                                            @else
                                                Tidak ada link
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ $announcement->start_date->format('d M Y') }}
                                        &mdash;
                                        {{ $announcement->end_date->format('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @php
                                            $isNow = $announcement->is_active
                                                && now()->toDateString() >= $announcement->start_date->toDateString()
                                                && now()->toDateString() <= $announcement->end_date->toDateString();
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                            {{ $isNow ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">
                                            {{ $isNow ? 'Tayang' : 'Tidak Tayang' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="inline-flex gap-2">
                                            <a href="{{ route('admin.announcements.edit', $announcement) }}"
                                               class="px-3 py-1.5 text-xs font-medium rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.announcements.destroy', $announcement) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-3 py-1.5 text-xs font-medium rounded-lg bg-red-50 text-red-700 hover:bg-red-100">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-gray-500 text-sm">
                                        Belum ada pengumuman.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $announcements->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
