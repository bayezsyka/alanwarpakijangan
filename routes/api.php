<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Resources\ArticleResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Semua route di sini akan otomatis diprefix dengan /api
| Contoh: http://127.0.0.1:8000/api/articles
|
*/

Route::get('/articles', function (Request $request) {
    // Urutkan berdasarkan created_at (default Laravel)
    $query = Article::with(['category', 'user'])
        ->latest(); // sama dengan orderBy('created_at', 'desc')

    // Pencarian judul: /api/articles?q=fiqih
    if ($search = $request->query('q')) {
        $query->where('judul', 'like', '%' . $search . '%');
    }

    // Filter kategori: /api/articles?category_id=1
    if ($categoryId = $request->query('category_id')) {
        $query->where('category_id', $categoryId);
    }

    // Paginasi: /api/articles?page=2
    $articles = $query->paginate(10);

    return ArticleResource::collection($articles);
});

Route::get('/articles/{slug}', function ($slug) {
    $article = Article::with(['category', 'user'])
        ->where('slug', $slug)
        ->firstOrFail();

    return new ArticleResource($article);
});
