<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\RutinanController as AdminRutinanController;
use App\Http\Controllers\Admin\RutinanExceptionController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Penulis\PenulisArticleController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// == RUTE FRONTEND (PUBLIK) ==
Route::get('/', [ArtikelController::class, 'welcome'])->name('welcome');
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel');
Route::get('/artikel/{article:slug}', [ArtikelController::class, 'show'])->name('artikel.detail');
Route::get('/galeri-acara', [GalleryController::class, 'index'])->name('galeri.index');
Route::get('/profil', function () { return view('profil'); })->name('profil');

// == RUTE BACKEND (MEMERLUKAN LOGIN) ==
Route::middleware(['auth', 'verified'])->group(function () {
    
    // UBAH BARIS INI: Arahkan ke DashboardController
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // --- Grup untuk semua rute Admin ---
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('artikel', AdminArticleController::class);
        Route::resource('users', AdminUserController::class);
        Route::resource('events', AdminEventController::class);
        Route::resource('rutinan', AdminRutinanController::class);
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('announcements', AdminAnnouncementController::class)->except(['show']);
        Route::get('/logs', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('logs.index');
        Route::post('/rutinan/{rutinan}/exceptions', [RutinanExceptionController::class, 'store'])->name('rutinan.exceptions.store');
        Route::delete('/rutinan/exceptions/{exception}', [RutinanExceptionController::class, 'destroy'])->name('rutinan.exceptions.destroy');
    });

    // === BACKEND PENULIS ===
Route::middleware(['auth', 'verified', 'penulis'])
    ->prefix('penulis')
    ->name('penulis.')
    ->group(function () {
        Route::get('/artikel', [PenulisArticleController::class, 'index'])->name('articles.index');
        Route::get('/artikel/create', [PenulisArticleController::class, 'create'])->name('articles.create');
        Route::post('/artikel', [PenulisArticleController::class, 'store'])->name('articles.store');
        Route::get('/artikel/{article}/edit', [PenulisArticleController::class, 'edit'])->name('articles.edit');
        Route::put('/artikel/{article}', [PenulisArticleController::class, 'update'])->name('articles.update');
        Route::delete('/artikel/{article}', [PenulisArticleController::class, 'destroy'])->name('articles.destroy');
    });
});
require __DIR__.'/auth.php';