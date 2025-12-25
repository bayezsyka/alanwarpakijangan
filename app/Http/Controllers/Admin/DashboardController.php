<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Event;
use App\Models\User;
use App\Models\Category;
use App\Models\Announcement;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->isPenulis()) {
            return redirect()->route('penulis.articles.index');
        }

        if (auth()->user()->isSelasananManager()) {
            return redirect()->route('manage.selasanan.index');
        }

        // Track visitor
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

        // === STATISTIK UMUM ===
        $totalArticles = Article::count();
        $totalEvents = Event::count();
        $totalUsers = User::count();
        $totalCategories = Category::count();
        $activeAnnouncements = Announcement::active()->count();

        // Kunjungan hari ini
        $visitorToday = Visitor::whereDate('visited_at', today())->count();

        // Kunjungan 7 hari terakhir
        $visitors7Days = Visitor::where('visited_at', '>=', now()->subDays(7))->count();

        // Kunjungan bulan ini
        $visitorsThisMonth = Visitor::whereMonth('visited_at', now()->month)
            ->whereYear('visited_at', now()->year)
            ->count();

        // === ARTIKEL TERPOPULER ===
        $topArticles = Article::with('category')
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        $topArticleLabels = $topArticles->pluck('judul');
        $topArticleViews = $topArticles->pluck('views');

        // Total views semua artikel
        $totalArticleViews = Article::sum('views');

        // === ARTIKEL TERBARU ===
        $recentArticles = Article::with(['category', 'user'])
            ->latest()
            ->take(5)
            ->get();

        // === EVENT MENDATANG ===
        $upcomingEvents = Event::where('tanggal', '>=', now())
            ->orderBy('tanggal', 'asc')
            ->take(5)
            ->get();

        // === TREN KUNJUNGAN 30 HARI ===
        $last30Days = [];
        $last30DaysData = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $last30Days[] = $date->format('d M');
            $last30DaysData[] = Visitor::whereDate('visited_at', $date->toDateString())->count();
        }

        // === HEATMAP DATA (untuk jam tersibuk) ===
        $heatmapData = Visitor::select(
            DB::raw('(DAYOFWEEK(visited_at) + 5) % 7 as day'),
            DB::raw('HOUR(visited_at) as hour'),
            DB::raw('COUNT(*) as total')
        )
            ->where('visited_at', '>=', now()->subDays(7))
            ->groupBy('day', 'hour')
            ->get();

        // === KUNJUNGAN PER HARI (7 hari terakhir) ===
        $visitsPerDay = Visitor::select(
            DB::raw('DATE(visited_at) as date'),
            DB::raw('COUNT(*) as total')
        )
            ->where('visited_at', '>=', now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $dayLabels = [];
        $dayData = [];
        $dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dayLabels[] = $dayNames[$date->dayOfWeek] . ' (' . $date->format('d/m') . ')';

            $found = $visitsPerDay->firstWhere('date', $date->toDateString());
            $dayData[] = $found ? (int) $found->total : 0;
        }

        // === ARTIKEL PER KATEGORI ===
        $articlesByCategory = Category::withCount('articles')
            ->having('articles_count', '>', 0)
            ->orderBy('articles_count', 'desc')
            ->get();

        $categoryLabels = $articlesByCategory->pluck('name');
        $categoryData = $articlesByCategory->pluck('articles_count');

        // === USER PER ROLE ===
        $usersByRole = User::select('role', DB::raw('COUNT(*) as total'))
            ->groupBy('role')
            ->get();

        return view('dashboard', compact(
            'totalArticles',
            'totalEvents',
            'totalUsers',
            'totalCategories',
            'activeAnnouncements',
            'visitorToday',
            'visitors7Days',
            'visitorsThisMonth',
            'totalArticleViews',
            'topArticles',
            'topArticleLabels',
            'topArticleViews',
            'recentArticles',
            'upcomingEvents',
            'last30Days',
            'last30DaysData',
            'dayLabels',
            'dayData',
            'heatmapData',
            'categoryLabels',
            'categoryData',
            'usersByRole',
            'articlesByCategory'
        ));
    }
}
