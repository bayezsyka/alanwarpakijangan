<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Event;
use App\Models\Rutinan;
use App\Models\RutinanException;
use App\Http\Resources\ArticleResource;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Semua route di sini otomatis diprefix dengan /api
| Contoh: http://127.0.0.1:8000/api/articles
|
*/

/*
 * =============== AUTH API ===============
 */

// Login: kirim email & password, balikan token
Route::post('/login', [AuthController::class, 'login']);

// Logout: butuh token
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth.api');

// Data user yang lagi login
Route::get('/me', [AuthController::class, 'me'])->middleware('auth.api');


/*
 * =============== ARTIKEL PUBLIK ===============
 */

// List artikel (dengan paginasi, search, filter kategori)
Route::get('/articles', function (Request $request) {
    $query = Article::with(['category', 'user'])->latest();

    // Search judul: /api/articles?q=teks
    if ($search = $request->query('q')) {
        $query->where('judul', 'like', '%' . $search . '%');
    }

    // Filter kategori: /api/articles?category_id=1
    if ($categoryId = $request->query('category_id')) {
        $query->where('category_id', $categoryId);
    }

    $articles = $query->paginate(10);

    return ArticleResource::collection($articles);
});

// Detail artikel per slug
Route::get('/articles/{slug}', function ($slug) {
    $article = Article::with(['category', 'user'])
        ->where('slug', $slug)
        ->firstOrFail();

    return new ArticleResource($article);
});


/*
 * =============== EVENT & JADWAL (PUBLIK) ===============
 */

// List event
Route::get('/events', function () {
    return Event::orderBy('tanggal', 'asc')->get();
});

// Jadwal rutinan
Route::get('/rutinan', function () {
    return Rutinan::orderBy('id', 'asc')->get();
});

// Jadwal libur rutinan (exceptions)
Route::get('/rutinan/exceptions', function () {
    return RutinanException::orderBy('libur_date', 'asc')->get();
});


/*
 * =============== ADMIN (BUTUH LOGIN) ===============
 */

Route::middleware('auth.api')->group(function () {
    // List artikel admin
    Route::get('/admin/articles', function () {
        $articles = Article::with(['category', 'user'])->latest()->paginate(20);
        return ArticleResource::collection($articles);
    });
});
