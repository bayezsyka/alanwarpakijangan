<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-2xl font-semibold">
                Dashboard Admin
            </h1>
            <p class="mt-1 text-sm text-emerald-50/90">
                Selamat datang, {{ auth()->user()->name }}! Berikut ringkasan aktifitas website.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">

            {{-- STATISTIK UTAMA - 6 CARDS --}}
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
                {{-- Artikel --}}
                <div class="relative overflow-hidden rounded-xl border border-blue-100 bg-gradient-to-br from-blue-50 to-white p-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-xs font-medium text-blue-600">Artikel</p>
                            <p class="mt-1 text-2xl font-bold text-gray-900">{{ number_format($totalArticles) }}</p>
                            <p class="mt-1 text-xs text-gray-500">{{ number_format($totalArticleViews) }} views</p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    </div>
                </div>

                {{-- Events --}}
                <div class="relative overflow-hidden rounded-xl border border-purple-100 bg-gradient-to-br from-purple-50 to-white p-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-xs font-medium text-purple-600">Agenda</p>
                            <p class="mt-1 text-2xl font-bold text-gray-900">{{ number_format($totalEvents) }}</p>
                            <p class="mt-1 text-xs text-gray-500">Total kegiatan</p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-100 text-purple-600">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>

                {{-- Pengumuman Aktif --}}
                <div class="relative overflow-hidden rounded-xl border border-orange-100 bg-gradient-to-br from-orange-50 to-white p-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-xs font-medium text-orange-600">Pengumuman</p>
                            <p class="mt-1 text-2xl font-bold text-gray-900">{{ number_format($activeAnnouncements) }}</p>
                            <p class="mt-1 text-xs text-gray-500">Sedang aktif</p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-orange-100 text-orange-600">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                    </div>
                </div>

                {{-- Kunjungan Hari Ini --}}
                <div class="relative overflow-hidden rounded-xl border border-emerald-100 bg-gradient-to-br from-emerald-50 to-white p-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-xs font-medium text-emerald-600">Hari Ini</p>
                            <p class="mt-1 text-2xl font-bold text-gray-900">{{ number_format($visitorToday) }}</p>
                            <p class="mt-1 text-xs text-gray-500">Pengunjung</p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>

                {{-- Kunjungan 7 Hari --}}
                <div class="relative overflow-hidden rounded-xl border border-teal-100 bg-gradient-to-br from-teal-50 to-white p-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-xs font-medium text-teal-600">7 Hari</p>
                            <p class="mt-1 text-2xl font-bold text-gray-900">{{ number_format($visitors7Days) }}</p>
                            <p class="mt-1 text-xs text-gray-500">Pengunjung</p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-teal-100 text-teal-600">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>

                {{-- Total User --}}
                <div class="relative overflow-hidden rounded-xl border border-pink-100 bg-gradient-to-br from-pink-50 to-white p-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-xs font-medium text-pink-600">Pengguna</p>
                            <p class="mt-1 text-2xl font-bold text-gray-900">{{ number_format($totalUsers) }}</p>
                            <p class="mt-1 text-xs text-gray-500">Total user</p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-pink-100 text-pink-600">
                            <i class="fas fa-user-friends"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- GRAFIK TREN KUNJUNGAN 30 HARI --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Tren Kunjungan 30 Hari Terakhir</h3>
                        <p class="text-sm text-gray-500">Pantau pola kunjungan harian pengunjung website</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Bulan Ini</p>
                        <p class="text-xl font-bold text-emerald-600">{{ number_format($visitorsThisMonth) }}</p>
                    </div>
                </div>
                <div class="h-64">
                    <canvas id="trend30Chart"></canvas>
                </div>
            </div>

            {{-- GRID 2 KOLOM: KUNJUNGAN 7 HARI & ARTIKEL PER KATEGORI --}}
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                {{-- Kunjungan 7 Hari --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Kunjungan 7 Hari Terakhir</h3>
                        <p class="text-sm text-gray-500">Perbandingan kunjungan harian minggu ini</p>
                    </div>
                    <div class="h-64">
                        <canvas id="dayChart"></canvas>
                    </div>
                </div>

                {{-- Artikel Per Kategori --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Artikel Per Kategori</h3>
                        <p class="text-sm text-gray-500">Distribusi artikel berdasarkan kategori</p>
                    </div>
                    <div class="h-64">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- ARTIKEL TERPOPULER & EVENT MENDATANG --}}
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                {{-- Artikel Terpopuler --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Artikel Terpopuler</h3>
                            <p class="text-sm text-gray-500">5 artikel dengan views tertinggi</p>
                        </div>
                        <a href="{{ route('admin.artikel.index') }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-700">
                            Lihat Semua →
                        </a>
                    </div>
                    <div class="space-y-3">
                        @forelse($topArticles as $index => $article)
                            <div class="flex items-start gap-3 rounded-lg border border-gray-100 p-3 hover:bg-gray-50 transition-colors">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg {{ $index === 0 ? 'bg-yellow-100 text-yellow-600' : ($index === 1 ? 'bg-gray-100 text-gray-600' : ($index === 2 ? 'bg-orange-100 text-orange-600' : 'bg-blue-50 text-blue-600')) }}">
                                    <span class="text-sm font-bold">#{{ $index + 1 }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate" title="{{ $article->judul }}">
                                        {{ $article->judul }}
                                    </p>
                                    <div class="mt-1 flex items-center gap-3 text-xs text-gray-500">
                                        <span class="flex items-center gap-1">
                                            <i class="fas fa-eye"></i>
                                            {{ number_format($article->views) }} views
                                        </span>
                                        @if($article->category)
                                            <span class="flex items-center gap-1">
                                                <i class="fas fa-tag"></i>
                                                {{ $article->category->name }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-inbox text-3xl mb-2"></i>
                                <p class="text-sm">Belum ada artikel</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Event Mendatang --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Agenda Mendatang</h3>
                            <p class="text-sm text-gray-500">Kegiatan yang akan datang</p>
                        </div>
                        <a href="{{ route('admin.events.index') }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-700">
                            Lihat Semua →
                        </a>
                    </div>
                    <div class="space-y-3">
                        @forelse($upcomingEvents as $event)
                            <div class="flex items-start gap-3 rounded-lg border border-gray-100 p-3 hover:bg-gray-50 transition-colors">
                                <div class="flex h-14 w-14 flex-col items-center justify-center rounded-lg bg-purple-50 text-purple-600">
                                    <span class="text-xs font-medium">{{ \Carbon\Carbon::parse($event->tanggal)->format('M') }}</span>
                                    <span class="text-lg font-bold">{{ \Carbon\Carbon::parse($event->tanggal)->format('d') }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate" title="{{ $event->judul }}">
                                        {{ $event->judul }}
                                    </p>
                                    <div class="mt-1 flex items-center gap-2 text-xs text-gray-500">
                                        <span class="flex items-center gap-1">
                                            <i class="fas fa-calendar"></i>
                                            {{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <i class="fas fa-map-marker-alt"></i>
                                            {{ Str::limit($event->lokasi ?? 'TBA', 20) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-calendar-times text-3xl mb-2"></i>
                                <p class="text-sm">Belum ada agenda mendatang</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- ARTIKEL TERBARU --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Artikel Terbaru</h3>
                        <p class="text-sm text-gray-500">Artikel yang baru saja dipublikasikan</p>
                    </div>
                    <a href="{{ route('admin.artikel.index') }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-700">
                        Lihat Semua →
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="border-b border-gray-200">
                            <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <th class="pb-3">Judul</th>
                                <th class="pb-3">Kategori</th>
                                <th class="pb-3">Penulis</th>
                                <th class="pb-3">Views</th>
                                <th class="pb-3">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($recentArticles as $article)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3">
                                        <p class="font-medium text-gray-900">{{ Str::limit($article->judul, 50) }}</p>
                                    </td>
                                    <td class="py-3">
                                        @if($article->category)
                                            <span class="inline-flex items-center rounded-full bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700">
                                                {{ $article->category->name }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3 text-gray-600">
                                        {{ $article->user->name ?? '-' }}
                                    </td>
                                    <td class="py-3 text-gray-600">
                                        {{ number_format($article->views) }}
                                    </td>
                                    <td class="py-3 text-gray-600">
                                        {{ $article->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-gray-500">
                                        Belum ada artikel
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Data dari controller
            const last30Days = @json($last30Days);
            const last30DaysData = @json($last30DaysData);
            const dayLabels = @json($dayLabels);
            const dayData = @json($dayData);
            const categoryLabels = @json($categoryLabels);
            const categoryData = @json($categoryData);

            // Helper untuk warna yang konsisten
            const colors = {
                emerald: 'rgba(16, 185, 129, 0.8)',
                emeraldLight: 'rgba(16, 185, 129, 0.2)',
                blue: 'rgba(59, 130, 246, 0.8)',
                blueLight: 'rgba(59, 130, 246, 0.2)',
                purple: 'rgba(147, 51, 234, 0.8)',
                purpleLight: 'rgba(147, 51, 234, 0.2)',
            };

            // 1. TREN 30 HARI (Area Chart)
            const trend30Ctx = document.getElementById('trend30Chart');
            if (trend30Ctx && window.Chart) {
                const ctx = trend30Ctx.getContext('2d');
                const gradient = ctx.createLinearGradient(0, 0, 0, 250);
                gradient.addColorStop(0, 'rgba(16, 185, 129, 0.3)');
                gradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

                new Chart(trend30Ctx, {
                    type: 'line',
                    data: {
                        labels: last30Days,
                        datasets: [{
                            label: 'Pengunjung',
                            data: last30DaysData,
                            fill: true,
                            backgroundColor: gradient,
                            borderColor: colors.emerald,
                            borderWidth: 2,
                            tension: 0.4,
                            pointRadius: 0,
                            pointHoverRadius: 5,
                            pointBackgroundColor: colors.emerald,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            intersect: false,
                            mode: 'index',
                        },
                        scales: {
                            x: {
                                grid: { display: false },
                                ticks: { maxRotation: 0, maxTicksLimit: 10 }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: { precision: 0 },
                                grid: { color: 'rgba(229, 231, 235, 0.7)' }
                            }
                        },
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                padding: 12,
                                titleFont: { size: 13 },
                                bodyFont: { size: 12 },
                                callbacks: {
                                    label: (ctx) => ` ${ctx.parsed.y} pengunjung`
                                }
                            }
                        }
                    }
                });
            }

            // 2. KUNJUNGAN 7 HARI (Bar Chart)
            const dayCtx = document.getElementById('dayChart');
            if (dayCtx && window.Chart) {
                new Chart(dayCtx, {
                    type: 'bar',
                    data: {
                        labels: dayLabels,
                        datasets: [{
                            label: 'Pengunjung',
                            data: dayData,
                            backgroundColor: colors.emerald,
                            borderColor: 'rgba(5, 150, 105, 1)',
                            borderWidth: 1,
                            borderRadius: 6,
                            maxBarThickness: 50
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: { grid: { display: false } },
                            y: {
                                beginAtZero: true,
                                ticks: { precision: 0 },
                                grid: { color: 'rgba(229, 231, 235, 0.7)' }
                            }
                        },
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: (ctx) => ` ${ctx.parsed.y} pengunjung`
                                }
                            }
                        }
                    }
                });
            }

            // 3. ARTIKEL PER KATEGORI (Doughnut Chart)
            const categoryCtx = document.getElementById('categoryChart');
            if (categoryCtx && window.Chart && categoryLabels.length > 0) {
                // Generate beautiful colors
                const categoryColors = [
                    'rgba(59, 130, 246, 0.8)',   // blue
                    'rgba(16, 185, 129, 0.8)',   // emerald
                    'rgba(147, 51, 234, 0.8)',   // purple
                    'rgba(251, 146, 60, 0.8)',   // orange
                    'rgba(236, 72, 153, 0.8)',   // pink
                    'rgba(14, 165, 233, 0.8)',   // sky
                    'rgba(234, 179, 8, 0.8)',    // yellow
                ];

                new Chart(categoryCtx, {
                    type: 'doughnut',
                    data: {
                        labels: categoryLabels,
                        datasets: [{
                            data: categoryData,
                            backgroundColor: categoryColors,
                            borderWidth: 2,
                            borderColor: '#fff',
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'right',
                                labels: {
                                    padding: 15,
                                    font: { size: 12 },
                                    usePointStyle: true,
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: (ctx) => ` ${ctx.label}: ${ctx.parsed} artikel`
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
