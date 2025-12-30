<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Event;
use App\Models\Rutinan;
use App\Models\Announcement; // <-- TAMBAHAN
use Illuminate\Http\Request;
use Carbon\Carbon;

class ArtikelController extends Controller
{
    /**
     * Menampilkan halaman utama (welcome page).
     */
    public function welcome()
    {
        // Ambil 2 artikel terbaru (bukan 3)
        $latestArticles = Article::latest()->take(2)->get();

        // Ambil 1 jurnal Selasanan terbaru yang sudah dipublish
        $latestSelasanan = \App\Models\SelasananEntry::where('is_published', true)
            ->orderByDesc('monday_date')
            ->first();

        // Ambil beberapa entry Selasanan dengan foto untuk galeri
        $selasananGallery = \App\Models\SelasananEntry::where('is_published', true)
            ->whereNotNull('cover_image_path')
            ->orderByDesc('monday_date')
            ->take(6)
            ->get();

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

        // >>> PENGUMUMAN POPUP: ambil pengumuman aktif (dalam rentang tanggal & is_active = true)
        $announcements = Announcement::active()
            ->orderBy('start_date', 'desc')
            ->get();

        // Transform announcements for JavaScript
        $announcementsData = $announcements->map(function ($a) {
            return [
                'id'        => $a->id,
                'title'     => $a->title,
                'image_url' => $a->image_url,
                'link'      => $a->link,
            ];
        })->toArray();

        // Kirim semua data ke view
        return view('welcome', compact(
            'latestArticles',
            'latestSelasanan',
            'selasananGallery',
            'latestEvents',
            'groupedRutinans',
            'rollingDays',
            'announcements',
            'announcementsData'
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
            Article::withoutTimestamps(function () use ($article) {
                $article->increment('views');
            });

            // Pastikan tampilan mendapatkan nilai view terbaru tanpa mengubah informasi pembaruan
            $article->refresh();
            session()->put($viewedKey, true);
        }

        return view('artikel_detail', compact('article'));
    }
}
