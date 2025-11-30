<x-app-layout>
    <x-slot name="header">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-600 via-emerald-500 to-teal-500 shadow-2xl">
            <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top,_#ffffff_0,_transparent_40%),_radial-gradient(circle_at_20%_20%,_#d1fae5_0,_transparent_25%)]"></div>
            <div class="relative px-8 py-8">
                <p class="text-sm uppercase tracking-[0.3em] text-emerald-50">Dashboard Analisis</p>
                <div class="mt-2 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-3xl font-extrabold text-white">Pantau Data Real-Time</h2>
                        <p class="text-emerald-50/80 mt-1">Insight pengunjung dan konten terbaik dalam satu layar.</p>
                    </div>
                    <div class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-2 text-sm font-semibold text-white shadow-inner">
                        <span class="h-2 w-2 rounded-full bg-emerald-200 animate-pulse"></span>
                        Sistem aktif & terbarui otomatis
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    @php
        $articleCount = count($topArticleLabels);
        $averageViews = $articleCount > 0 ? round(array_sum($topArticleViews) / $articleCount) : 0;
        $topHighlight = $articleCount > 0 ? $topArticleLabels[0] : '-';
    @endphp

    <div class="py-10 bg-gradient-to-b from-gray-50 via-white to-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Ringkasan Cepat --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                <div class="relative overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-gray-100 p-6">
                    <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-emerald-100"></div>
                    <div class="relative flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Pengunjung Hari Ini</p>
                            <p class="text-3xl font-extrabold text-gray-900">{{ $visitorCount }}</p>
                            <p class="text-xs text-emerald-600 font-semibold mt-2">Pertumbuhan stabil</p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-gray-100 p-6">
                    <div class="absolute -left-4 -top-6 h-24 w-24 rounded-full bg-teal-100"></div>
                    <div class="relative flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Artikel Dipantau</p>
                            <p class="text-3xl font-extrabold text-gray-900">{{ $articleCount }}</p>
                            <p class="text-xs text-teal-600 font-semibold mt-2">Total artikel populer</p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-teal-50 text-teal-600">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-gray-100 p-6">
                    <div class="absolute -right-6 -bottom-8 h-24 w-24 rounded-full bg-sky-100"></div>
                    <div class="relative flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Rata-rata View</p>
                            <p class="text-3xl font-extrabold text-gray-900">{{ $averageViews }}</p>
                            <p class="text-xs text-sky-600 font-semibold mt-2">Per artikel populer</p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-sky-50 text-sky-600">
                            <i class="fas fa-eye"></i>
                        </div>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-600 to-teal-600 shadow-lg p-6 text-white">
                    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_20%_20%,_#ffffff_0,_transparent_30%)]"></div>
                    <div class="relative flex items-center justify-between">
                        <div>
                            <p class="text-sm text-emerald-100">Sorotan</p>
                            <p class="text-xl font-bold">{{ $topHighlight }}</p>
                            <p class="text-xs text-emerald-50 mt-2">Artikel dengan performa terbaik</p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white/15 text-white">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Grafik Artikel & Ringkasan --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <div class="xl:col-span-2 bg-white rounded-3xl shadow-xl ring-1 ring-gray-100 p-6 space-y-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                Artikel Terpopuler
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mt-2">Performa Konten</h3>
                            <p class="text-sm text-gray-500">Pantau artikel paling banyak dibaca secara real-time.</p>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span> View terbanyak
                        </div>
                    </div>
                    <div class="relative h-[360px]">
                        <canvas id="artikelChart"></canvas>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-100 p-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Urutan Teratas</p>
                                <h4 class="text-lg font-bold text-gray-900">3 Artikel Populer</h4>
                            </div>
                            <span class="rounded-full bg-emerald-50 text-emerald-700 px-3 py-1 text-xs font-semibold">Live</span>
                        </div>
                        <div class="space-y-3">
                            @foreach (array_slice($topArticleLabels, 0, 3) as $index => $title)
                                <div class="flex items-start gap-3 rounded-xl border border-gray-100 p-3 hover:border-emerald-100">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700 font-semibold">
                                        #{{ $index + 1 }}
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-900">{{ $title }}</p>
                                        <p class="text-xs text-gray-500">{{ $topArticleViews[$index] ?? 0 }} total views</p>
                                    </div>
                                    <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2 py-1 rounded-full">Trending</span>
                                </div>
                            @endforeach
                            @if ($articleCount === 0)
                                <p class="text-sm text-gray-500">Belum ada data artikel.</p>
                            @endif
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-slate-900 via-emerald-900 to-emerald-700 rounded-3xl shadow-xl p-6 text-white">
                        <div class="flex items-center gap-3">
                            <div class="h-11 w-11 rounded-2xl bg-white/10 flex items-center justify-center">
                                <i class="fas fa-bell text-white"></i>
                            </div>
                            <div>
                                <p class="text-sm text-emerald-100">Notifikasi singkat</p>
                                <p class="text-lg font-semibold">Pastikan jadwal rutinan selalu terbarui.</p>
                            </div>
                        </div>
                        <p class="text-sm text-emerald-50/80 mt-3">Gunakan menu Rutinan dan Log Aktivitas untuk memantau update jadwal dan histori perubahan konten.</p>
                        <div class="mt-4 inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-semibold">
                            <span class="h-2 w-2 rounded-full bg-emerald-300"></span>
                            Terhubung dengan sistem keamanan
                        </div>
                    </div>
                </div>
            </div>

            {{-- Heatmap --}}
            <div class="bg-white rounded-3xl shadow-xl ring-1 ring-gray-100 p-6 space-y-6">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full bg-sky-50 px-3 py-1 text-xs font-semibold text-sky-700">
                            <span class="h-2 w-2 rounded-full bg-sky-500"></span>
                            Heatmap Kunjungan
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mt-2">Jam & Hari Tersibuk</h3>
                        <p class="text-sm text-gray-500">Identifikasi waktu paling ramai untuk penjadwalan konten.</p>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-gray-500">
                        <span class="h-3 w-3 rounded-full bg-emerald-500"></span> Intensitas kunjungan
                    </div>
                </div>
                <div class="relative h-[480px] p-4 bg-gradient-to-br from-gray-50 to-white rounded-2xl">
                    <canvas id="heatmapChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const topArticleLabels = @json($topArticleLabels);
            const topArticleViews = @json($topArticleViews);
            const heatmapRaw = @json($heatmapData);
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

            const matrixData = heatmapRaw.map(row => ({
                x: parseInt(row.hour),
                y: parseInt(row.day),
                v: parseInt(row.total)
            }));

            new Chart(document.getElementById('artikelChart'), {
                type: 'bar',
                data: {
                    labels: topArticleLabels,
                    datasets: [{
                        label: 'Total Views',
                        data: topArticleViews,
                        backgroundColor: 'rgba(16, 185, 129, 0.75)',
                        borderColor: 'rgba(5, 149, 104, 1)',
                        borderRadius: 12,
                        borderWidth: 1.5,
                        barThickness: 18,
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { beginAtZero: true, ticks: { precision: 0, color: '#6b7280' }, grid: { color: '#f3f4f6' } },
                        y: { ticks: { color: '#6b7280' } }
                    },
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
                        height: ctx => 20,
                        borderRadius: 6,
                        borderWidth: 0,
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
                                callback: val => `${val}:00`,
                                color: '#6b7280'
                            },
                            grid: { color: '#f3f4f6' },
                            title: {
                                display: true,
                                text: 'Jam',
                                color: '#111827',
                                font: { weight: 'bold' }
                            }
                        },
                        y: {
                            type: 'linear',
                            min: 0,
                            max: 6,
                            reverse: true,
                            ticks: {
                                callback: val => days[val],
                                color: '#6b7280'
                            },
                            grid: { color: '#f3f4f6' },
                            title: {
                                display: true,
                                text: 'Hari',
                                color: '#111827',
                                font: { weight: 'bold' }
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
