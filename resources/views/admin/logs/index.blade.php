<x-app-layout>
    <x-slot name="header">
        Log Aktivitas
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-card no-padding overflow-hidden>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th scope="col" class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Waktu Kejadian</th>
                                <th scope="col" class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Pengguna</th>
                                <th scope="col" class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Aksi & Deskripsi</th>
                                <th scope="col" class="px-6 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Alamat IP</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 bg-white">
                            @forelse ($logs as $log)
                                <tr class="hover:bg-gray-50/50 transition-colors group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col">
                                            <span class="text-xs font-bold text-gray-700 leading-none mb-1">{{ $log->created_at->format('d M Y') }}</span>
                                            <span class="text-[10px] font-bold text-gray-400">{{ $log->created_at->format('H:i:s') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-lg bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 font-black text-xs mr-3 shadow-inner">
                                                {{ strtoupper(substr($log->user->name ?? '?', 0, 1)) }}
                                            </div>
                                            <div class="text-xs font-bold text-gray-800">{{ $log->user->name ?? 'Sistem' }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col gap-1.5">
                                            <span @class([
                                                'inline-flex items-center self-start px-2 py-0.5 rounded-md text-[9px] font-black uppercase tracking-wider border transition-all',
                                                'bg-blue-50 text-blue-700 border-blue-100 group-hover:bg-blue-100' => in_array(strtolower($log->action), ['create', 'store', 'unggah', 'tambah']),
                                                'bg-amber-50 text-amber-700 border-amber-100 group-hover:bg-amber-100' => in_array(strtolower($log->action), ['update', 'edit', 'ubah']),
                                                'bg-red-50 text-red-700 border-red-100 group-hover:bg-red-100' => in_array(strtolower($log->action), ['delete', 'destroy', 'hapus']),
                                                'bg-gray-50 text-gray-600 border-gray-100 group-hover:bg-gray-100' => !in_array(strtolower($log->action), ['create', 'store', 'unggah', 'tambah', 'update', 'edit', 'ubah', 'delete', 'destroy', 'hapus']),
                                            ])>
                                                {{ $log->action }}
                                            </span>
                                            <p class="text-xs font-medium text-gray-500 leading-relaxed max-w-md">{{ $log->description }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <span class="text-[10px] font-mono font-bold text-gray-300 bg-gray-50 px-2 py-1 rounded-md border border-gray-100 group-hover:text-gray-500 transition-colors">{{ $log->ip_address }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center mb-4 border border-gray-100 shadow-inner">
                                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <p class="text-sm font-bold text-gray-400">Belum ada aktivitas terekam.</p>
                                            <p class="text-[10px] text-gray-300 mt-1 uppercase tracking-widest font-bold font-display">Log akan muncul secara otomatis</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($logs->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-center">
                        <div class="bg-white px-3 py-1.5 rounded-xl border border-gray-200 shadow-sm">
                            {{ $logs->links() }}
                        </div>
                    </div>
                @endif
            </x-card>
        </div>
    </div>
</x-app-layout>
