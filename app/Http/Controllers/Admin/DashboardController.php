<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Pendaftaran;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $ip = request()->ip();

        $alreadyVisited = Visitor::where('ip_address', $ip)
            ->whereDate('visited_at', now()->toDateString())
            ->exists();

        if (!$alreadyVisited) {
            Visitor::create([
                'ip_address' => $ip,
                'user_agent' => request()->userAgent(),
                'visited_at' => now(),
            ]);
        }

        $visitorCount = Visitor::whereDate('visited_at', today())->count();

        $topArticles = Article::orderBy('views', 'desc')->take(4)->get();
        $topArticleLabels = $topArticles->pluck('judul');
        $topArticleViews = $topArticles->pluck('views');

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

        $totalPendaftar = $pendaftarStats->sum('total');
        $diterimaCount = $pendaftarStats->get('diterima')->total ?? 0;
        $ditolakCount = $pendaftarStats->get('ditolak')->total ?? 0;
        $pendingCount = $pendaftarStats->get('pending')->total ?? 0;

        $heatmapData = Visitor::select(
            DB::raw('(DAYOFWEEK(visited_at) + 5) % 7 as day'), // supaya Senin = 0, dst
            DB::raw('HOUR(visited_at) as hour'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('day', 'hour')
        ->get();

        return view('dashboard', compact(
            'topArticleLabels',
            'topArticleViews',
            'pendaftarLabels',
            'pendaftarCounts',
            'totalPendaftar',
            'diterimaCount',
            'ditolakCount',
            'pendingCount',
            'visitorCount',
            'heatmapData'
        ));
    }
}
