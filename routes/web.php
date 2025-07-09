<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\EventController as AdminEventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// == RUTE FRONTEND (PUBLIK) ==
Route::get('/', [ArtikelController::class, 'welcome'])->name('welcome');
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel');
Route::get('/artikel/{article:slug}', [ArtikelController::class, 'show'])->name('artikel.detail');
Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri.index');
Route::get('/profil', function () { return view('profil'); })->name('profil');

// --- Pendaftaran Santri Baru & Informasi ---
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get('/informasipendaftaran', function () { return view('psb'); })->name('informasipendaftaran');

// --- Rute untuk OTP ---
Route::post('/otp/send', [OtpController::class, 'send'])->name('otp.send');
Route::post('/otp/verify', [OtpController::class, 'verify'])->name('otp.verify');


// == RUTE BACKEND (MEMERLUKAN LOGIN) ==
Route::middleware(['auth', 'verified'])->group(function () {
    
    // --- Dashboard Utama ---
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- Profil User yang Sedang Login ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // --- Grup untuk semua rute Admin ---
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('artikel', AdminArticleController::class);
        Route::resource('users', AdminUserController::class);
        Route::resource('events', AdminEventController::class); // Rute Galeri
        
        // Rute Manajemen Pendaftaran
        Route::get('/pendaftaran', [AdminPendaftaranController::class, 'index'])->name('pendaftaran.index');
        Route::get('/pendaftaran/{pendaftaran}', [AdminPendaftaranController::class, 'show'])->name('pendaftaran.show');
        Route::patch('/pendaftaran/{pendaftaran}/status', [AdminPendaftaranController::class, 'updateStatus'])->name('pendaftaran.update_status');
        Route::delete('/pendaftaran/{pendaftaran}', [AdminPendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
    });
});

// --- Rute Otentikasi Bawaan ---
require __DIR__.'/auth.php';