<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Event; // <-- Tambahkan ini
use App\Models\Rutinan; // <-- 1. Import model Rutinan
use Carbon\Carbon;



class ArtikelController extends Controller
{
    public function welcome()
    {
        // Ganti orderBy('tanggal', 'desc') menjadi latest()
        $latestArticles = Article::latest()->take(3)->get();
        $latestEvents = Event::with('photos')->latest()->take(3)->get();
        $dayOrder = [6, 0, 1, 2, 3, 4, 5]; 
        $rutinans = Rutinan::all()->sortBy('waktu')->groupBy('day_of_week');

       $dayNames = [0 => 'Ahad', 1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu'];
        
        $rollingDays = [];
        // Loop dari 2 hari yang lalu (-2) hingga 4 hari ke depan (+4) untuk mendapatkan 7 hari
        for ($i = -2; $i <= 4; $i++) {
            $day = Carbon::now()->addDays($i);
            $rollingDays[] = [
                'full_date' => $day->format('Y-m-d'), // Format Y-m-d untuk perbandingan
                'day_of_week' => $day->dayOfWeek,
                'day_name' => $dayNames[$day->dayOfWeek],
                'date' => $day->format('d'),
                'month' => strtoupper($day->translatedFormat('M')),
                'is_today' => $day->isToday(),
            ];
        }
    
        $groupedRutinans = Rutinan::with('exceptions')->get()->sortBy('waktu')->groupBy('day_of_week');

        return view('welcome', [
            'latestArticles' => $latestArticles,
            'latestEvents' => $latestEvents,
            'groupedRutinans' => $groupedRutinans,
            'rollingDays' => $rollingDays,
        ]);

        return view('welcome', [
            'latestArticles' => $latestArticles,
            'latestEvents' => $latestEvents,
            'groupedRutinans' => $groupedRutinans,
        ]);
    }

    public function index(Request $request)
    {
        $query = Article::query();

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'like', "%{$searchTerm}%")
                  ->orWhere('penulis', 'like', "%{$searchTerm}%");
            });
        }

        // Ganti orderBy('tanggal', 'desc') menjadi latest() di sini juga
        $articles = $query->latest()->paginate(9)->withQueryString();

        return view('artikel', compact('articles'));
    }

    public function show(Article $article)
    {
        $viewedKey = 'viewed_article_' . $article->id;
        if (!session()->has($viewedKey)) {
            $article->increment('views');
            session()->put($viewedKey, true);
        }
        return view('artikel_detail', compact('article'));
    }
}