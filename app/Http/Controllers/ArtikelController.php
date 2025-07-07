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

        // Cek jika ada input pencarian
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'like', "%{$searchTerm}%")
                  // ### PERUBAHAN DI SINI: dari 'isi' menjadi 'penulis' ###
                  ->orWhere('penulis', 'like', "%{$searchTerm}%");
            });
        }

        $articles = $query->orderBy('tanggal', 'desc')->paginate(9)
                          ->withQueryString();

        return view('artikel', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('artikel_detail', compact('article'));
    }
}