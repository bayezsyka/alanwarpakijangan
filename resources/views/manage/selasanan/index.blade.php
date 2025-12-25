@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Manajemen Selasanan') }}
    </h2>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Header dengan tombol aksi --}}
    <div class="rounded-[24px] bg-gradient-to-r from-emerald-600 to-emerald-500 text-white shadow-lg shadow-emerald-900/30 px-6 py-5 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold">Kajian Rutinan "Selasanan"</h1>
                <p class="text-emerald-50/90 text-sm mt-1">Kelola jurnal mingguan, foto kegiatan, dan rekaman audio.</p>
            </div>
            <a href="{{ route('manage.selasanan.create', ['monday_date' => $currentMondayDate]) }}"
               class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-white text-emerald-700 font-semibold shadow hover:bg-emerald-50">
                + Buat Minggu Ini
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="bg-white rounded-2xl shadow p-5 border border-gray-100">
            <p class="text-xs font-semibold text-gray-500">MINGGU AKTIF</p>
            <p class="text-lg font-bold text-gray-900 mt-1">
                {{ \Carbon\Carbon::create($currentYear, $currentMonth, 1)->locale('id')->translatedFormat('F Y') }},
                Minggu ke-{{ $currentWeek }}
            </p>
            <p class="text-sm text-gray-600 mt-1">Senin, {{ \Carbon\Carbon::parse($currentMondayDate)->locale('id')->translatedFormat('d F Y') }}</p>

            <div class="mt-4">
                @if($currentEntry)
                    <div class="rounded-xl bg-emerald-50 border border-emerald-100 p-4">
                        <p class="text-sm font-semibold text-emerald-900">Sudah ada entry minggu ini ✅</p>
                        <p class="text-sm text-emerald-800 mt-1">{{ $currentEntry->title }}</p>
                        <div class="mt-3 flex gap-2">
                            <a href="{{ route('manage.selasanan.edit', $currentEntry->id) }}"
                               class="px-3 py-2 rounded-xl bg-emerald-600 text-white text-xs font-semibold hover:bg-emerald-700">
                                Edit
                            </a>
                        </div>
                    </div>
                @else
                    <div class="rounded-xl bg-amber-50 border border-amber-100 p-4">
                        <p class="text-sm font-semibold text-amber-900">Belum ada entry minggu ini</p>
                        <p class="text-xs text-amber-800 mt-1">Klik tombol "Buat Minggu Ini" untuk input cepat.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="lg:col-span-2 bg-white rounded-2xl shadow p-5 border border-gray-100">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <p class="text-sm font-bold text-gray-900">Riwayat Selasanan</p>
                    <p class="text-xs text-gray-500">Cari judul jurnal, filter bulan/tahun, lalu edit.</p>
                </div>

                <form class="flex flex-wrap gap-2" method="GET" action="{{ route('manage.selasanan.index') }}">
                    <input name="q" value="{{ request('q') }}" placeholder="Cari judul..."
                           class="px-3 py-2 rounded-xl border border-gray-200 text-sm" />
                    <input name="year" value="{{ request('year') }}" placeholder="Tahun"
                           class="px-3 py-2 rounded-xl border border-gray-200 text-sm w-28" />
                    <input name="month" value="{{ request('month') }}" placeholder="Bulan"
                           class="px-3 py-2 rounded-xl border border-gray-200 text-sm w-24" />
                    <button class="px-3 py-2 rounded-xl bg-emerald-600 text-white text-sm font-semibold">Filter</button>
                    <a href="{{ route('manage.selasanan.index') }}"
                       class="px-3 py-2 rounded-xl border border-gray-200 text-sm font-semibold text-gray-700">
                        Reset
                    </a>
                </form>
            </div>

            <div class="mt-4 overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-left text-gray-500">
                        <tr>
                            <th class="py-2">Minggu</th>
                            <th class="py-2">Judul</th>
                            <th class="py-2">Tanggal</th>
                            <th class="py-2">Publish</th>
                            <th class="py-2 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($entries as $e)
                            <tr>
                                <td class="py-3">
                                    <div class="font-semibold text-gray-900">
                                        {{ \Carbon\Carbon::create($e->year, $e->month, 1)->locale('id')->translatedFormat('F') }},
                                        Minggu ke-{{ $e->week_of_month }}
                                    </div>
                                    <div class="text-xs text-gray-500">{{ $e->year }}</div>
                                </td>
                                <td class="py-3">
                                    <div class="font-semibold text-gray-900">{{ $e->title }}</div>
                                    <div class="text-xs text-gray-500">Pembicara: {{ $e->speaker }}</div>
                                </td>
                                <td class="py-3 text-gray-700">
                                    Senin, {{ $e->monday_date->locale('id')->translatedFormat('d M Y') }} • {{ substr($e->time_wib,0,5) }} WIB
                                </td>
                                <td class="py-3">
                                    @if($e->is_published)
                                        <span class="px-2 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-semibold border border-emerald-100">Ya</span>
                                    @else
                                        <span class="px-2 py-1 rounded-lg bg-gray-50 text-gray-700 text-xs font-semibold border border-gray-200">Draft</span>
                                    @endif
                                </td>
                                <td class="py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('manage.selasanan.edit', $e->id) }}"
                                           class="px-3 py-2 rounded-xl bg-emerald-600 text-white text-xs font-semibold hover:bg-emerald-700">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('manage.selasanan.destroy', $e->id) }}"
                                              onsubmit="return confirm('Hapus entry ini? File cover/audio juga akan dihapus.')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="px-3 py-2 rounded-xl border border-red-200 bg-red-50 text-red-700 text-xs font-semibold hover:bg-red-100">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-gray-500">Belum ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $entries->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
