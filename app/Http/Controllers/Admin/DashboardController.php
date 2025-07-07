<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data untuk Chart Artikel Terpopuler (4 teratas)
        $topArticles = Article::orderBy('views', 'desc')->take(4)->get();
        $topArticleLabels = $topArticles->pluck('judul');
        $topArticleViews = $topArticles->pluck('views');

        // 2. Data untuk Chart Pendaftar
        $pendaftarStats = Pendaftaran::query()
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get()
            ->keyBy('status');

        $pendaftarLabels = ['Pending', 'Diterima', 'Ditolak'];
        $pendaftarCounts = [
            $pendaftarStats->get('pending')->total ?? 0,
            $pendaftarStats->get('diterima')->total ?? 0,
            $pendaftarStats->get('ditolak')->total ?? 0,
        ];
        
        // Data tambahan untuk kartu statistik
        $totalPendaftar = $pendaftarStats->sum('total');
        $diterimaCount = $pendaftarStats->get('diterima')->total ?? 0;
        $ditolakCount = $pendaftarStats->get('ditolak')->total ?? 0;
        $pendingCount = $pendaftarStats->get('pending')->total ?? 0;

        // 3. Kirim semua data ke view
        return view('dashboard', compact(
            'topArticleLabels', 
            'topArticleViews',
            'pendaftarLabels',
            'pendaftarCounts',
            'totalPendaftar',
            'diterimaCount',
            'ditolakCount',
            'pendingCount'
        ));
    }
}