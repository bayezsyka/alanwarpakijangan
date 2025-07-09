<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Event; // <-- Tambahkan ini


class ArtikelController extends Controller
{
    public function welcome()
    {
        // Ganti orderBy('tanggal', 'desc') menjadi latest()
        $latestArticles = Article::latest()->take(3)->get();
        $latestEvents = Event::with('photos')->latest()->take(3)->get(); // <-- Tambahkan ini

        return view('welcome', [
            'latestArticles' => $latestArticles,
            'latestEvents' => $latestEvents,
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