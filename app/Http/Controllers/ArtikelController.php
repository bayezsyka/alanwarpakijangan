<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function welcome()
    {
        $articles = Article::orderBy('tanggal', 'desc')->take(3)->get();
        return view('welcome', compact('articles'));
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

        $articles = $query->orderBy('tanggal', 'desc')->paginate(9)
                          ->withQueryString();

        return view('artikel', compact('articles'));
    }

    public function show(Article $article)
    {
        // ### LOGIKA PENGHITUNG VIEWS ###
        // 1. Buat kunci unik untuk session berdasarkan ID artikel
        $viewedKey = 'viewed_article_' . $article->id;

        // 2. Cek apakah kunci ini belum ada di session pengguna saat ini
        if (!session()->has($viewedKey)) {
            // 3. Jika belum ada, tambahkan views +1
            $article->increment('views');

            // 4. Simpan kunci ke session agar tidak dihitung lagi pada kunjungan berikutnya di sesi yang sama
            session()->put($viewedKey, true);
        }
        
        return view('artikel_detail', compact('article'));
    }
}