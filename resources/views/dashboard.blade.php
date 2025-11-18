<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-[#059568] via-emerald-600 to-emerald-500 rounded-3xl shadow-2xl overflow-hidden">
            <div class="px-8 py-8 sm:px-10 sm:py-10 flex flex-col gap-6 text-white">
                <div>
                    <p class="text-sm uppercase tracking-[0.35em] text-emerald-100">Pusat Analitik</p>
                    <h2 class="mt-2 text-3xl sm:text-4xl font-bold">Dashboard Administrator</h2>
                    <p class="mt-2 text-emerald-50 max-w-3xl">Pantau performa pengunjung dan artikel secara real-time dengan insight
                        yang lebih kaya dan tampilan yang lebih bersih.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-emerald-50">
                    <div class="bg-white/10 backdrop-blur rounded-2xl p-4 border border-white/20">
                        <p class="text-xs uppercase tracking-wider text-emerald-100">Total Artikel</p>
                        <p class="mt-1 text-2xl font-bold">{{ number_format($articleCount) }}</p>
                        <p class="text-sm text-emerald-100">Konten siap dibaca</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur rounded-2xl p-4 border border-white/20">
                        <p class="text-xs uppercase tracking-wider text-emerald-100">Hari Ini</p>
                        <p class="mt-1 text-2xl font-bold">{{ number_format($visitorCount) }}</p>
                        <p class="text-sm text-emerald-100">Pengunjung tercatat</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur rounded-2xl p-4 border border-white/20">
                        <p class="text-xs uppercase tracking-wider text-emerald-100">Pekan Ini</p>
                        <p class="mt-1 text-2xl font-bold">{{ number_format($weeklyVisitors) }}</p>
                        <p class="text-sm text-emerald-100">Aktivitas konsisten</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur rounded-2xl p-4 border border-white/20">
                        <p class="text-xs uppercase tracking-wider text-emerald-100">Bulan Ini</p>
                        <p class="mt-1 text-2xl font-bold">{{ number_format($monthlyVisitors) }}</p>
                        <p class="text-sm text-emerald-100">Pertumbuhan audiens</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <div class="xl:col-span-2 bg-white rounded-3xl shadow-xl border border-gray-100 p-6 space-y-6">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center space-x-3">
                            <div class="bg-[#059568]/10 text-[#059568] p-3 rounded-2xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.25 6.75h12M8.25 12H18m-9.75 5.25H15" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800">Performa Artikel</h3>
                                <p class="text-sm text-gray-500">Artikel terpopuler berdasarkan total views</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-gray-500">
                            <span class="inline-flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Total Views
                            </span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                        <div class="bg-emerald-50 p-4 rounded-2xl">
                            <p class="text-xs uppercase tracking-wide text-emerald-600">Artikel</p>
                            <p class="mt-1 text-2xl font-bold text-emerald-700">{{ number_format($articleCount) }}</p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-2xl">
                            <p class="text-xs uppercase tracking-wide text-green-600">Pengunjung Harian</p>
                            <p class="mt-1 text-2xl font-bold text-green-700">{{ number_format($visitorCount) }}</p>
                        </div>
                        <div class="bg-teal-50 p-4 rounded-2xl">
                            <p class="text-xs uppercase tracking-wide text-teal-600">Total Pekan Ini</p>
                            <p class="mt-1 text-2xl font-bold text-teal-700">{{ number_format($weeklyVisitors) }}</p>
                        </div>
                        <div class="bg-lime-50 p-4 rounded-2xl">
                            <p class="text-xs uppercase tracking-wide text-lime-600">Total Bulan Ini</p>
                            <p class="mt-1 text-2xl font-bold text-lime-700">{{ number_format($monthlyVisitors) }}</p>
                        </div>
                    </div>
                    <div class="relative h-[360px]">
                        <canvas id="artikelChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Pencapaian Terbaru</p>
                            <h3 class="text-xl font-semibold text-gray-800">Artikel Terpopuler</h3>
                        </div>
                        <div class="bg-emerald-50 text-emerald-600 text-xs font-semibold px-3 py-1 rounded-full">Top 4</div>
                    </div>
                    <div class="mt-6 space-y-4">
                        @forelse ($topArticles as $article)
                            <div class="flex items-center justify-between p-3 rounded-2xl border border-gray-100 hover:border-emerald-200 transition">
                                <div>
                                    <p class="text-sm text-gray-500">#{{ $loop->iteration }}</p>
                                    <p class="text-base font-semibold text-gray-800">{{ $article->judul }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xl font-bold text-emerald-600">{{ number_format($article->views) }}</p>
                                    <p class="text-xs text-gray-400">views</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">Belum ada data artikel.</p>
                        @endforelse
                    </div>
                    <p class="mt-6 text-xs text-gray-400">Total pengunjung sepanjang waktu: <span class="font-semibold text-gray-600">{{ number_format($totalVisitors) }}</span></p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6 space-y-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Insight</p>
                            <h3 class="text-xl font-semibold text-gray-800">Sorotan Artikel</h3>
                        </div>
                        <div class="bg-[#059568]/10 text-[#059568] px-3 py-1 rounded-full text-xs font-medium">Trending</div>
                    </div>
                    @if ($mostViewedArticle)
                        <div class="space-y-4">
                            <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 rounded-2xl p-5">
                                <p class="text-sm text-emerald-600">Paling Banyak Dilihat</p>
                                <h4 class="mt-1 text-2xl font-bold text-emerald-900">{{ $mostViewedArticle->judul }}</h4>
                                <p class="mt-2 text-sm text-emerald-700">Total views: <span class="font-semibold">{{ number_format($mostViewedArticle->views) }}</span></p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="rounded-2xl border border-gray-100 p-4">
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">Rata-rata Harian</p>
                                    <p class="mt-2 text-2xl font-bold text-gray-800">{{ number_format($visitorCount) }}</p>
                                </div>
                                <div class="rounded-2xl border border-gray-100 p-4">
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">Total Pengunjung</p>
                                    <p class="mt-2 text-2xl font-bold text-gray-800">{{ number_format($totalVisitors) }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">Belum ada artikel yang diterbitkan.</p>
                    @endif
                </div>

                <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6 space-y-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Aktivitas Terbaru</p>
                            <h3 class="text-xl font-semibold text-gray-800">Pengunjung Terakhir</h3>
                        </div>
                        <span class="text-xs text-gray-400">Pembaruan realtime</span>
                    </div>
                    <div class="space-y-4">
                        @forelse ($recentVisitors as $visitor)
                            @php
                                $formattedVisitedAt = $visitor->visited_at
                                    ? \Illuminate\Support\Carbon::parse($visitor->visited_at)->format('d M Y, H:i')
                                    : '-';
                            @endphp
                            <div class="flex items-center justify-between border border-gray-100 rounded-2xl p-4 hover:border-emerald-200 transition">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">{{ $visitor->ip_address }}</p>
                                    <p class="text-xs text-gray-500">{{ $formattedVisitedAt }}</p>
                                </div>
                                <div class="text-right text-xs text-gray-500">
                                    <p>{{ \Illuminate\Support\Str::limit($visitor->user_agent, 28) }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">Belum ada aktivitas pengunjung.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6 space-y-6">
                <div class="flex items-center space-x-3">
                    <div class="bg-[#059568]/10 text-[#059568] p-3 rounded-2xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 4h10M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Distribusi Kunjungan</p>
                        <h3 class="text-xl font-semibold text-gray-800">Heatmap Waktu Kunjungan</h3>
                    </div>
                </div>
                <div class="relative h-[480px] p-4 bg-emerald-50 rounded-2xl">
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

                const artikelCanvas = document.getElementById('artikelChart');
                if (artikelCanvas) {
                    new Chart(artikelCanvas, {
                        type: 'bar',
                        data: {
                            labels: topArticleLabels,
                            datasets: [{
                                label: 'Total Views',
                                data: topArticleViews,
                                backgroundColor: 'rgba(5, 149, 104, 0.7)',
                                borderRadius: 12,
                                borderSkipped: false
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
                }

                const heatmapCanvas = document.getElementById('heatmapChart');
                if (heatmapCanvas) {
                    new Chart(heatmapCanvas, {
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
                                borderColor: 'rgba(5, 150, 105, 0.15)',
                                borderWidth: 1,
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
                }
            });
        </script>
    @endpush
</x-app-layout>
