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

    public function index()
    {
         $articles = Article::orderBy('tanggal', 'desc')->paginate(9);
    
    return view('artikel', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('artikel_detail', compact('article'));
    }
}