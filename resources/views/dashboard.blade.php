<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Analisis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 space-y-6">
                    <h3 class="text-xl font-semibold text-gray-800">Statistik Pendaftar</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                        <div class="bg-blue-50 p-4 rounded-lg"><div class="text-2xl font-bold text-blue-700">{{ $totalPendaftar }}</div><div class="text-sm text-blue-600">Total</div></div>
                        <div class="bg-green-50 p-4 rounded-lg"><div class="text-2xl font-bold text-green-700">{{ $diterimaCount }}</div><div class="text-sm text-green-600">Diterima</div></div>
                        <div class="bg-yellow-50 p-4 rounded-lg"><div class="text-2xl font-bold text-yellow-700">{{ $pendingCount }}</div><div class="text-sm text-yellow-600">Pending</div></div>
                        <div class="bg-red-50 p-4 rounded-lg"><div class="text-2xl font-bold text-red-700">{{ $ditolakCount }}</div><div class="text-sm text-red-600">Ditolak</div></div>
                    </div>
                    <div class="relative h-64">
                        <canvas id="pendaftarChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 space-y-6">
                    <h3 class="text-xl font-semibold text-gray-800">Artikel Terpopuler</h3>
                    <div class="relative h-[325px]">
                        <canvas id="artikelChart"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Data dari Controller di-passing ke JavaScript dengan aman
            const pendaftarLabels = @json($pendaftarLabels);
            const pendaftarCounts = @json($pendaftarCounts);
            const topArticleLabels = @json($topArticleLabels);
            const topArticleViews = @json($topArticleViews);

            // Inisialisasi Chart Pendaftar (Doughnut Chart)
            const pendaftarCtx = document.getElementById('pendaftarChart');
            if (pendaftarCtx) {
                new Chart(pendaftarCtx, {
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
            }

            // Inisialisasi Chart Artikel (Bar Chart)
            const artikelCtx = document.getElementById('artikelChart');
            if (artikelCtx) {
                new Chart(artikelCtx, {
                    type: 'bar',
                    data: {
                        labels: topArticleLabels,
                        datasets: [{
                            label: 'Total Views',
                            data: topArticleViews,
                            backgroundColor: 'rgba(0, 131, 98, 0.6)',
                            borderColor: 'rgba(0, 131, 98, 1)',
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
            }
        });
    </script>
    @endpush
</x-app-layout>