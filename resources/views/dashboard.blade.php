<x-app-layout>
     <x-slot name="header">
        <div>
            <h1 class="text-2xl font-semibold">
                Dashboard Analitik
            </h1>
            <p class="mt-1 text-sm text-emerald-50/90">
                Ringkasan kunjungan dan performa konten.
            </p>
        </div>
    </x-slot>

    @php
        // Pastikan tetap bisa jalan walaupun data kosong
        $heatmapCollection = collect($heatmapData ?? []);
        $dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        // Total kunjungan dari data heatmap (7 hari x 24 jam)
        $totalVisits = (int) $heatmapCollection->sum('total');

        // Kunjungan per hari
        $visitsPerDayRaw = $heatmapCollection
            ->groupBy('day')
            ->map(function ($rows) {
                return (int) $rows->sum('total');
            });

        $dayLabels = [];
        $dayData = [];
        for ($i = 0; $i < 7; $i++) {
            $dayLabels[] = $dayNames[$i];
            $dayData[] = (int) ($visitsPerDayRaw->get($i, 0));
        }

        $busyDayIndex = !empty($dayData) ? array_search(max($dayData), $dayData) : null;
        $busyDayName = ($busyDayIndex !== null && $busyDayIndex !== false) ? $dayLabels[$busyDayIndex] : '-';
        $averagePerDay = !empty($dayData) ? round($totalVisits / 7) : 0;

        // Kunjungan per jam
        $visitsPerHourRaw = $heatmapCollection
            ->groupBy('hour')
            ->map(function ($rows) {
                return (int) $rows->sum('total');
            })
            ->sortKeys();

        $hourLabels = [];
        $hourData = [];
        for ($h = 0; $h < 24; $h++) {
            $hourLabels[] = sprintf('%02d:00', $h);
            $hourData[] = (int) ($visitsPerHourRaw->get($h, 0));
        }

        $maxHourValue = !empty($hourData) ? max($hourData) : 0;
        $maxHourIndex = $maxHourValue > 0 ? array_search($maxHourValue, $hourData) : null;
        $maxHourLabel = ($maxHourIndex !== null && $maxHourIndex !== false) ? $hourLabels[$maxHourIndex] : '-';

        // Data artikel teratas (sudah ada di dashboard lama)
        $topArticleViewsArray = $topArticleViews ?? [];
        $topArticleLabelsArray = $topArticleLabels ?? [];

        $totalArticleViews = is_array($topArticleViewsArray) ? array_sum($topArticleViewsArray) : 0;
        $topArticleName = $topArticleLabelsArray[0] ?? '-';
        $topArticleViewsValue = $topArticleViewsArray[0] ?? 0;
    @endphp

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-8 sm:px-6 lg:px-8">

            {{-- Ringkasan KPI --}}
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
                {{-- Total kunjungan minggu ini --}}
                <div class="relative overflow-hidden rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <p class="text-xs font-medium uppercase tracking-[0.16em] text-emerald-500">
                                Total kunjungan (7 hari)
                            </p>
                            <p class="mt-2 text-2xl font-bold text-gray-900">
                                {{ number_format($totalVisits, 0, ',', '.') }}
                            </p>
                            <p class="mt-1 text-xs text-gray-500">
                                Rata-rata {{ number_format($averagePerDay, 0, ',', '.') }} kunjungan / hari
                            </p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                    <div class="pointer-events-none absolute -right-6 -bottom-10 h-24 w-24 rounded-full bg-emerald-50"></div>
                </div>

                {{-- Hari tersibuk --}}
                <div class="relative overflow-hidden rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <p class="text-xs font-medium uppercase tracking-[0.16em] text-emerald-500">
                                Hari tersibuk
                            </p>
                            <p class="mt-2 text-xl font-semibold text-gray-900">
                                {{ $busyDayName }}
                            </p>
                            <p class="mt-1 text-xs text-gray-500">
                                Berdasarkan total kunjungan mingguan.
                            </p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                    </div>
                    <div class="pointer-events-none absolute -right-6 -bottom-10 h-24 w-24 rounded-full bg-emerald-50"></div>
                </div>

                {{-- Jam tersibuk --}}
                <div class="relative overflow-hidden rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <p class="text-xs font-medium uppercase tracking-[0.16em] text-emerald-500">
                                Jam paling ramai
                            </p>
                            <p class="mt-2 text-xl font-semibold text-gray-900">
                                {{ $maxHourLabel }}
                            </p>
                            <p class="mt-1 text-xs text-gray-500">
                                Perkiraan jam terbaik untuk publish konten.
                            </p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div class="pointer-events-none absolute -right-6 -bottom-10 h-24 w-24 rounded-full bg-emerald-50"></div>
                </div>

                {{-- Top artikel --}}
                <div class="relative overflow-hidden rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-2">
                        <div class="min-w-0">
                            <p class="text-xs font-medium uppercase tracking-[0.16em] text-emerald-500">
                                Artikel teratas
                            </p>
                            <p class="mt-2 truncate text-sm font-semibold text-gray-900" title="{{ $topArticleName }}">
                                {{ $topArticleName }}
                            </p>
                            <p class="mt-1 text-xs text-gray-500">
                                {{ number_format($topArticleViewsValue, 0, ',', '.') }} views (total artikel: {{ number_format($totalArticleViews, 0, ',', '.') }})
                            </p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    </div>
                    <div class="pointer-events-none absolute -right-6 -bottom-10 h-24 w-24 rounded-full bg-emerald-50"></div>
                </div>
            </div>

            {{-- Bagian grafik utama --}}
            <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
                {{-- Grafik: Kunjungan per jam --}}
                <div class="xl:col-span-2 rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between gap-2">
                        <div>
                            <h3 class="text-base font-semibold text-gray-900">Jam ramai pengunjung</h3>
                            <p class="text-xs text-gray-500">
                                Distribusi kunjungan per jam dalam satu minggu.
                            </p>
                        </div>
                    </div>
                    <div class="mt-4 h-72">
                        <canvas id="hourlyChart"></canvas>
                    </div>
                </div>

                {{-- Grafik: Kunjungan per hari --}}
                <div class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between gap-2">
                        <div>
                            <h3 class="text-base font-semibold text-gray-900">Kunjungan per hari</h3>
                            <p class="text-xs text-gray-500">
                                Bandingkan trafik antar hari dalam seminggu.
                            </p>
                        </div>
                    </div>
                    <div class="mt-4 h-72">
                        <canvas id="dayChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Grafik performa artikel --}}
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <div class="lg:col-span-2 rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between gap-2">
                        <div>
                            <h3 class="text-base font-semibold text-gray-900">Top artikel berdasarkan views</h3>
                            <p class="text-xs text-gray-500">
                                5–10 artikel dengan performa terbaik.
                            </p>
                        </div>
                    </div>
                    <div class="mt-4 h-72">
                        <canvas id="topArticlesChart"></canvas>
                    </div>
                </div>

                {{-- Ringkasan kecil artikel --}}
                <div class="space-y-3 rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                    <h3 class="text-base font-semibold text-gray-900">Insight cepat</h3>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li class="flex items-start gap-2">
                            <span class="mt-1 h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            <span>
                                Cek <span class="font-semibold text-gray-900">jam paling ramai</span> lalu jadwalkan artikel/pengumuman penting sekitar jam tersebut.
                            </span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1 h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            <span>
                                Fokus optimasi pada artikel dengan views tertinggi lebih dulu (judul, gambar, internal link).
                            </span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1 h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            <span>
                                Pantau hari dengan trafik rendah untuk coba eksperimen konten baru.
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dayLabels = @json($dayLabels);
            const dayData = @json($dayData);
            const hourLabels = @json($hourLabels);
            const hourData = @json($hourData);
            const topArticleLabels = @json($topArticleLabels ?? []);
            const topArticleViews = @json($topArticleViews ?? []);

            // Grafik kunjungan per jam (line + area)
            const hourlyCtx = document.getElementById('hourlyChart');
            if (hourlyCtx && window.Chart) {
                const ctx = hourlyCtx.getContext('2d');
                const gradient = ctx.createLinearGradient(0, 0, 0, 260);
                gradient.addColorStop(0, 'rgba(16, 185, 129, 0.35)');
                gradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

                new Chart(hourlyCtx, {
                    type: 'line',
                    data: {
                        labels: hourLabels,
                        datasets: [{
                            label: 'Kunjungan',
                            data: hourData,
                            fill: true,
                            backgroundColor: gradient,
                            borderColor: 'rgba(5, 150, 105, 1)',
                            borderWidth: 2,
                            tension: 0.35,
                            pointRadius: 2.5,
                            pointBackgroundColor: 'rgba(5, 150, 105, 1)',
                            pointHoverRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                ticks: {
                                    maxRotation: 0,
                                    autoSkip: true,
                                    maxTicksLimit: 8
                                },
                                grid: { display: false }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: { precision: 0 },
                                grid: { color: 'rgba(209, 250, 229, 0.7)' }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: (ctx) => ` ${ctx.parsed.y} kunjungan`
                                }
                            }
                        }
                    }
                });
            }

            // Grafik kunjungan per hari (bar)
            const dayCtx = document.getElementById('dayChart');
            if (dayCtx && window.Chart) {
                new Chart(dayCtx, {
                    type: 'bar',
                    data: {
                        labels: dayLabels,
                        datasets: [{
                            label: 'Kunjungan',
                            data: dayData,
                            backgroundColor: 'rgba(16, 185, 129, 0.6)',
                            borderColor: 'rgba(5, 150, 105, 1)',
                            borderWidth: 1.5,
                            borderRadius: 8,
                            maxBarThickness: 40
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                grid: { display: false }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: { precision: 0 },
                                grid: { color: 'rgba(209, 250, 229, 0.7)' }
                            }
                        },
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: (ctx) => ` ${ctx.parsed.y} kunjungan`
                                }
                            }
                        }
                    }
                });
            }

            // Grafik top artikel (horizontal bar)
            const topCtx = document.getElementById('topArticlesChart');
            if (topCtx && window.Chart && Array.isArray(topArticleLabels) && topArticleLabels.length) {
                new Chart(topCtx, {
                    type: 'bar',
                    data: {
                        labels: topArticleLabels,
                        datasets: [{
                            label: 'Total Views',
                            data: topArticleViews,
                            backgroundColor: 'rgba(16, 185, 129, 0.6)',
                            borderColor: 'rgba(5, 150, 105, 1)',
                            borderWidth: 1.5,
                            borderRadius: 8,
                            maxBarThickness: 28
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                beginAtZero: true,
                                ticks: { precision: 0 },
                                grid: { color: 'rgba(229, 231, 235, 0.7)' }
                            },
                            y: {
                                grid: { display: false }
                            }
                        },
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: (ctx) => ` ${ctx.parsed.x} views`
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
