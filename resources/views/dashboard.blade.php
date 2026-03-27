<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span>Panel Dashboard</span>
        </div>
    </x-slot>

    <div class="py-6 space-y-8">
        
        {{-- STATISTIK UTAMA - HIGHLIGHT --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Pengunjung Hari Ini --}}
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm relative overflow-hidden group">
                <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-emerald-50 rounded-full opacity-0 group-hover:opacity-100 scale-50 group-hover:scale-100 transition-all duration-500"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-4 shadow-inner group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Pengunjung Hari Ini</p>
                    <h3 class="text-3xl font-black text-gray-900 font-display">{{ number_format($visitorToday) }}</h3>
                    <div class="mt-2 flex items-center text-[10px] font-bold text-emerald-600">
                         <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                         Online saat ini
                    </div>
                </div>
            </div>

            {{-- Total Artikel --}}
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm relative overflow-hidden group">
                <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-blue-50 rounded-full opacity-0 group-hover:opacity-100 scale-50 group-hover:scale-100 transition-all duration-500"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4 shadow-inner group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2 2h-7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Artikel</p>
                    <h3 class="text-3xl font-black text-gray-900 font-display">{{ number_format($totalArticles) }}</h3>
                    <div class="mt-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                         Dilihat {{ number_format($totalArticleViews) }} Kali
                    </div>
                </div>
            </div>

            {{-- Agenda Kegiatan --}}
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm relative overflow-hidden group">
                <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-purple-50 rounded-full opacity-0 group-hover:opacity-100 scale-50 group-hover:scale-100 transition-all duration-500"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-4 shadow-inner group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Agenda Pondok</p>
                    <h3 class="text-3xl font-black text-gray-900 font-display">{{ number_format($totalEvents) }}</h3>
                    <div class="mt-2 text-[10px] font-bold text-purple-600 uppercase tracking-widest">
                         Koleksi Dokumentasi
                    </div>
                </div>
            </div>

            {{-- Pengguna Aktif --}}
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm relative overflow-hidden group">
                <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-pink-50 rounded-full opacity-0 group-hover:opacity-100 scale-50 group-hover:scale-100 transition-all duration-500"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-pink-50 text-pink-600 rounded-2xl flex items-center justify-center mb-4 shadow-inner group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Pengurus Sistem</p>
                    <h3 class="text-3xl font-black text-gray-900 font-display">{{ number_format($totalUsers) }}</h3>
                    <div class="mt-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                         Admin & Penulis
                    </div>
                </div>
            </div>
        </div>

        {{-- GRAFIK TREN KUNJUNGAN 30 HARI --}}
        <x-card no-padding overflow-hidden>
             <x-slot name="header">
                 <div class="flex items-center justify-between">
                     <div class="flex items-center gap-3">
                         <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                         <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Tren Kunjungan 30 Hari</h3>
                     </div>
                     <div class="text-right">
                         <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Bulan Ini:</span>
                         <span class="ml-2 text-lg font-black text-emerald-600 font-display">{{ number_format($visitorsThisMonth) }} Hits</span>
                     </div>
                 </div>
             </x-slot>
             <div class="p-6">
                 <div class="h-[350px] w-full">
                     <canvas id="trend30Chart"></canvas>
                 </div>
             </div>
        </x-card>

        {{-- GRID 2 KOLOM: TABS & CHARTS --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Artikel Terpopuler --}}
            <x-card no-padding overflow-hidden>
                <x-slot name="header">
                    <div class="flex items-center justify-between">
                         <div class="flex items-center gap-3">
                             <div class="w-1.5 h-6 bg-blue-500 rounded-full"></div>
                             <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Artikel Terpopuler</h3>
                         </div>
                         <a href="{{ route('admin.artikel.index') }}" class="text-[10px] font-black text-emerald-600 uppercase tracking-widest hover:underline transition-all">LIHAT SEMUA</a>
                    </div>
                </x-slot>
                <div class="divide-y divide-gray-50 bg-white">
                    @forelse($topArticles as $index => $article)
                        <div class="flex items-center gap-4 p-5 hover:bg-gray-50 transition-all group">
                            <div @class([
                                'w-10 h-10 rounded-xl flex items-center justify-center text-sm font-black border transition-all shadow-sm',
                                'bg-yellow-50 text-yellow-600 border-yellow-100 group-hover:scale-110' => $index === 0,
                                'bg-gray-50 text-gray-500 border-gray-100 group-hover:scale-110' => $index === 1,
                                'bg-orange-50 text-orange-600 border-orange-100 group-hover:scale-110' => $index === 2,
                                'bg-blue-50 text-blue-600 border-blue-100 group-hover:scale-110' => $index > 2,
                            ])>
                                #{{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-bold text-gray-800 line-clamp-1 group-hover:text-emerald-700 transition-colors">{{ $article->judul }}</h4>
                                <div class="flex items-center gap-3 mt-1">
                                    <span class="text-[10px] font-bold text-gray-400 flex items-center">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        {{ number_format($article->views) }} Views
                                    </span>
                                    @if($article->category)
                                        <span class="text-[9px] font-black text-emerald-600/60 uppercase tracking-widest border border-emerald-50 bg-emerald-50/30 px-2 py-0.5 rounded">
                                            {{ $article->category->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-20 text-center">
                            <p class="text-xs font-bold text-gray-400">Data belum tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </x-card>

            {{-- Agenda Mendatang --}}
            <x-card no-padding overflow-hidden>
                <x-slot name="header">
                    <div class="flex items-center justify-between">
                         <div class="flex items-center gap-3">
                             <div class="w-1.5 h-6 bg-purple-500 rounded-full"></div>
                             <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Agenda Terdekat</h3>
                         </div>
                         <a href="{{ route('admin.events.index') }}" class="text-[10px] font-black text-emerald-600 uppercase tracking-widest hover:underline transition-all">LIHAT SEMUA</a>
                    </div>
                </x-slot>
                <div class="divide-y divide-gray-50 bg-white">
                    @forelse($upcomingEvents as $event)
                        <div class="flex items-center gap-5 p-5 hover:bg-gray-50 transition-all group">
                            <div class="w-14 h-14 bg-purple-50 border border-purple-100 rounded-2xl flex flex-col items-center justify-center shrink-0 group-hover:bg-purple-600 group-hover:text-white transition-all shadow-sm group-hover:rotate-3">
                                <span class="text-[10px] font-black uppercase tracking-tighter">{{ \Carbon\Carbon::parse($event->tanggal)->locale('id')->format('M') }}</span>
                                <span class="text-lg font-black leading-none font-display">{{ \Carbon\Carbon::parse($event->tanggal)->format('d') }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-bold text-gray-800 line-clamp-1 group-hover:text-purple-700 transition-colors">{{ $event->nama_acara }}</h4>
                                <div class="flex items-center gap-3 mt-1.5 text-[10px] font-bold text-gray-400">
                                    <span class="flex items-center">
                                        <svg class="w-3.5 h-3.5 mr-1 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ \Carbon\Carbon::parse($event->tanggal)->locale('id')->translatedFormat('d F Y') }}
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-3.5 h-3.5 mr-1 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ Str::limit($event->lokasi ?? 'Pondok Al-Anwar', 25) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-20 text-center">
                            <p class="text-xs font-bold text-gray-400">Belum ada agenda terdekat.</p>
                        </div>
                    @endforelse
                </div>
            </x-card>
        </div>

        {{-- DISTRIBUSI KATEGORI & ARTIKEL TERBARU --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Distribusi Artikel --}}
            <x-card class="lg:col-span-1" overflow-hidden>
                 <x-slot name="header">
                     <h3 class="text-[10px] font-black text-gray-800 uppercase tracking-[0.2em] flex items-center gap-2">
                        <span class="w-1.5 h-4 bg-emerald-500 rounded-full"></span>
                        Topik Konten
                     </h3>
                 </x-slot>
                 <div class="h-[300px] w-full mt-4">
                     <canvas id="categoryChart"></canvas>
                 </div>
            </x-card>

            {{-- Artikel Terbaru --}}
            <x-card class="lg:col-span-2" no-padding overflow-hidden>
                <x-slot name="header">
                    <div class="flex items-center justify-between">
                         <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Artikel Terbaru Publik Ter-Update</h3>
                         <a href="{{ route('admin.artikel.index') }}" class="text-[10px] font-black text-emerald-600 uppercase tracking-widest hover:underline transition-all">KELOLA KONTEN</a>
                    </div>
                </x-slot>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-50 bg-white">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th scope="col" class="px-6 py-4 text-left text-[9px] font-black text-gray-400 uppercase tracking-[0.2em]">Info Draft</th>
                                <th scope="col" class="px-6 py-4 text-left text-[9px] font-black text-gray-400 uppercase tracking-[0.2em]">Kategori</th>
                                <th scope="col" class="px-6 py-4 text-left text-[9px] font-black text-gray-400 uppercase tracking-[0.2em]">Hits</th>
                                <th scope="col" class="px-6 py-4 text-right text-[9px] font-black text-gray-400 uppercase tracking-[0.2em]">Tgl Post</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($recentArticles as $article)
                                <tr class="hover:bg-gray-50/50 transition-colors group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-xs font-bold text-gray-800 group-hover:text-emerald-700 transition-colors line-clamp-1">{{ $article->judul }}</span>
                                        <p class="text-[10px] font-bold text-gray-300 mt-0.5 uppercase tracking-tighter">{{ $article->user->name ?? 'Penulis' }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($article->category)
                                            <span class="px-2.5 py-1 bg-white border border-gray-100 rounded-lg text-[10px] font-black text-gray-500 uppercase tracking-wider group-hover:border-emerald-200 group-hover:text-emerald-600 transition-all shadow-sm">
                                                {{ $article->category->name }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-display font-black text-sm text-gray-400 group-hover:text-emerald-500 transition-colors">
                                        {{ number_format($article->views) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <span class="text-[10px] font-black text-gray-300 group-hover:text-gray-500 transition-colors">{{ $article->created_at->format('d/m/y') }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="py-12 text-center text-xs font-bold text-gray-400 uppercase tracking-widest">Belum ada konten terbaru</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const last30Days = @json($last30Days);
            const last30DaysData = @json($last30DaysData);
            const categoryLabels = @json($categoryLabels);
            const categoryData = @json($categoryData);

            // Chart Colors
            const colors = {
                emerald: '#10b981',
                emeraldLight: 'rgba(16, 185, 129, 0.1)',
                blue: '#3b82f6',
                purple: '#8b5cf6',
                orange: '#f59e0b',
                pink: '#ec4899',
            };

            // 1. TREN 30 HARI
            const trend30Ctx = document.getElementById('trend30Chart');
            if (trend30Ctx) {
                const ctx = trend30Ctx.getContext('2d');
                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(16, 185, 129, 0.25)');
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
                            borderWidth: 3,
                            tension: 0.45,
                            pointRadius: 0,
                            pointHoverRadius: 6,
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: colors.emerald,
                            pointHoverBorderWidth: 3,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: { intersect: false, mode: 'index' },
                        scales: {
                            x: { 
                                grid: { display: false },
                                ticks: { font: { weight: 'bold', size: 10 }, color: '#9ca3af', maxTicksLimit: 15 }
                            },
                            y: { 
                                beginAtZero: true,
                                grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false },
                                ticks: { font: { weight: 'bold', size: 10 }, color: '#9ca3af', precision: 0 }
                            }
                        },
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#111827',
                                padding: 12,
                                cornerRadius: 12,
                                titleFont: { size: 11, weight: 'bold' },
                                bodyFont: { size: 12, weight: 'bold' },
                                callbacks: { label: (ctx) => ` ${ctx.parsed.y} Pengunjung` }
                            }
                        }
                    }
                });
            }

            // 2. KATEGORI CHART
            const categoryCtx = document.getElementById('categoryChart');
            if (categoryCtx && categoryLabels.length > 0) {
                new Chart(categoryCtx, {
                    type: 'doughnut',
                    data: {
                        labels: categoryLabels,
                        datasets: [{
                            data: categoryData,
                            backgroundColor: [colors.emerald, colors.blue, colors.purple, colors.orange, colors.pink, '#64748b', '#0ea5e9'],
                            borderWidth: 4,
                            borderColor: '#ffffff',
                            hoverOffset: 15
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '75%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                    font: { size: 10, weight: 'bold' },
                                    color: '#4b5563'
                                }
                            },
                            tooltip: {
                                backgroundColor: '#111827',
                                padding: 10,
                                cornerRadius: 10,
                                callbacks: { label: (ctx) => ` ${ctx.label}: ${ctx.parsed} Artikel` }
                            }
                        }
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
