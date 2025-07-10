<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Event;
use App\Models\Rutinan;
use App\Models\UpcomingEvent;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ArtikelController extends Controller
{
    /**
     * Menampilkan halaman utama (welcome page).
     */
    public function welcome()
    {
        $latestArticles = Article::latest()->take(3)->get();
        $latestEvents = Event::with('photos')->latest()->take(3)->get();
        
        // --- LOGIKA BARU YANG MEMAKSA TANGGAL BARU ---
        $dayNames = [0 => 'Ahad', 1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu'];
        $rollingDays = [];

        for ($i = -2; $i <= 4; $i++) {
            // Kita buat objek tanggal baru secara manual, tidak mengandalkan Carbon::now()
            $dateObject = new \DateTime();
            $dateObject->modify("$i days");
            
            $day = Carbon::instance($dateObject); // Ubah kembali ke objek Carbon untuk kemudahan format

            $rollingDays[] = [
                'full_date'   => $day->format('Y-m-d'),
                'day_of_week' => $day->dayOfWeek,
                'day_name'    => $dayNames[$day->dayOfWeek],
                'date'        => $day->format('d'),
                'month'       => strtoupper($day->translatedFormat('M')),
                'is_today'    => $day->isToday(),
            ];
        }
        
        $groupedRutinans = Rutinan::with('exceptions')->get()->sortBy('waktu')->groupBy('day_of_week');

        return view('welcome', compact(
            'latestArticles',
            'latestEvents',
            'groupedRutinans',
            'rollingDays'
        ));
    }

    /**
     * Menampilkan halaman daftar semua artikel.
     */
    public function index()
    {
        return view('artikel');
    }

    /**
     * Menampilkan halaman detail satu artikel.
     */
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