<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-[#059568] to-emerald-600 rounded-xl shadow-lg">
            <div class="px-8 py-6">
                <h2 class="text-2xl font-bold text-white">
                    {{ __('Dashboard Analisis') }}
                </h2>
                <p class="text-emerald-100 mt-2">Pantau dan Kendalikan Data Anda Secara Real-Time</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Kartu Jumlah Pengunjung --}}
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="bg-[#059568] p-2 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Jumlah Pengunjung Hari ini</h3>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-emerald-600">{{ $visitorCount }}</div>
                        <div class="text-sm text-emerald-500">Total Kunjungan</div>
                    </div>
                </div>
            </div>

            {{-- Grafik Statistik Pendaftar & Artikel --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Statistik Pendaftar --}}
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 space-y-6">
                    <div class="flex items-center space-x-3">
                        <div class="bg-[#059568] p-2 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Statistik Pendaftar</h3>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                        <div class="bg-emerald-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-emerald-700">{{ $totalPendaftar }}</div>
                            <div class="text-sm text-emerald-600">Total</div>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-green-700">{{ $diterimaCount }}</div>
                            <div class="text-sm text-green-600">Diterima</div>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-yellow-700">{{ $pendingCount }}</div>
                            <div class="text-sm text-yellow-600">Pending</div>
                        </div>
                        <div class="bg-red-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-red-700">{{ $ditolakCount }}</div>
                            <div class="text-sm text-red-600">Ditolak</div>
                        </div>
                    </div>
                    <div class="relative h-64">
                        <canvas id="pendaftarChart"></canvas>
                    </div>
                </div>

                {{-- Artikel Terpopuler --}}
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 space-y-6">
                    <div class="flex items-center space-x-3">
                        <div class="bg-[#059568] p-2 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Artikel Terpopuler</h3>
                    </div>
                    <div class="relative h-[325px]">
                        <canvas id="artikelChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Heatmap --}}
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 space-y-6">
                <div class="flex items-center space-x-3">
                    <div class="bg-[#059568] p-2 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 4h10M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Heatmap Kunjungan</h3>
                </div>
                <div class="relative h-[480px] p-4">
                    <canvas id="heatmapChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pendaftarLabels = @json($pendaftarLabels);
            const pendaftarCounts = @json($pendaftarCounts);
            const topArticleLabels = @json($topArticleLabels);
            const topArticleViews = @json($topArticleViews);
            const heatmapRaw = @json($heatmapData);
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

            const matrixData = heatmapRaw.map(row => ({
                x: parseInt(row.hour),
                y: parseInt(row.day),
                v: parseInt(row.total)
            }));

            new Chart(document.getElementById('pendaftarChart'), {
                type: 'doughnut',
                data: {
                    labels: pendaftarLabels,
                    datasets: [{
                        label: 'Jumlah Pendaftar',
                        data: pendaftarCounts,
                        backgroundColor: [
                            'rgb(253, 224, 71)',
                            'rgb(34, 197, 94)',
                            'rgb(239, 68, 68)'
                        ],
                        hoverOffset: 4
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });

            new Chart(document.getElementById('artikelChart'), {
                type: 'bar',
                data: {
                    labels: topArticleLabels,
                    datasets: [{
                        label: 'Total Views',
                        data: topArticleViews,
                        backgroundColor: 'rgba(5, 149, 104, 0.6)',
                        borderColor: 'rgba(5, 149, 104, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { x: { beginAtZero: true, ticks: { precision: 0 } } },
                    plugins: { legend: { display: false } }
                }
            });

            new Chart(document.getElementById('heatmapChart'), {
                type: 'matrix',
                data: {
                    datasets: [{
                        label: 'Kunjungan per Jam/Hari',
                        data: matrixData,
                        backgroundColor(ctx) {
                            const value = ctx.raw.v;
                            const alpha = Math.min(1, value / 20);
                            return `rgba(5, 150, 105, ${alpha})`;
                        },
                        width: ctx => 20,
                        height: ctx => 20
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            type: 'linear',
                            min: 0,
                            max: 23,
                            ticks: {
                                callback: val => `${val}:00`
                            },
                            title: {
                                display: true,
                                text: 'Jam'
                            }
                        },
                        y: {
                            type: 'linear',
                            min: 0,
                            max: 6,
                            reverse: true,
                            ticks: {
                                callback: val => days[val]
                            },
                            title: {
                                display: true,
                                text: 'Hari'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: ctx => `Jumlah: ${ctx.raw.v}`
                            }
                        },
                        legend: { 
                          position: 'bottom',  
                         }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
