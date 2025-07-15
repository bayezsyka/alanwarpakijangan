<x-app-layout>
    <x-slot name="header">
        <div class="rounded-xl shadow-lg bg-gradient-to-r from-indigo-800 to-purple-600">
            <div class="px-8 py-6">
                <h2 class="text-2xl font-bold text-white">
                    {{ __('Log Aktivitas Admin') }}
                </h2>
                <p class="text-indigo-100 mt-2">Riwayat semua aktivitas penting yang dilakukan oleh admin</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6 overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-200 text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="border px-4 py-2 text-left">Waktu</th>
                            <th class="border px-4 py-2 text-left">User</th>
                            <th class="border px-4 py-2 text-left">Aksi</th>
                            <th class="border px-4 py-2 text-left">Deskripsi</th>
                            <th class="border px-4 py-2 text-left">IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                            <tr class="border-t border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-2 text-gray-800 whitespace-nowrap">{{ $log->created_at->format('d M Y H:i') }}</td>
                                <td class="px-4 py-2 text-gray-900">{{ $log->user->name ?? '-' }}</td>
                                <td class="px-4 py-2 text-blue-700 font-medium capitalize">{{ $log->action }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $log->description }}</td>
                                <td class="px-4 py-2 text-gray-500">{{ $log->ip_address }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">Belum ada log aktivitas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-6">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
