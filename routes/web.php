<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\Admin\UserController as AdminUserController;


Route::post('/otp/send', [OtpController::class, 'send'])->name('otp.send');
Route::post('/otp/send', [OtpController::class, 'send'])->name('otp.send');
Route::post('/otp/verify', [OtpController::class, 'verify'])->name('otp.verify');

// == RUTE FRONTEND ==
Route::get('/', [ArtikelController::class, 'welcome'])->name('welcome');
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel');
Route::get('/artikel/{article:slug}', [ArtikelController::class, 'show'])->name('artikel.detail');
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get('/informasipendaftaran', function () { return view('psb'); })->name('informasipendaftaran');
Route::get('/profil', function () { return view('profil'); })->name('profil');


// Route untuk menampilkan form pendaftaran 
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::post('/pendaftaran/validate', [PendaftaranController::class, 'ajaxValidate'])->name('pendaftaran.ajax_validate');


// == RUTE BACKEND ==
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', AdminUserController::class);
    Route::resource('artikel', AdminArticleController::class);
    Route::get('/pendaftaran', [AdminPendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/{pendaftaran}', [AdminPendaftaranController::class, 'show'])->name('pendaftaran.show');
    Route::patch('/pendaftaran/{pendaftaran}/status', [AdminPendaftaranController::class, 'updateStatus'])->name('pendaftaran.update_status');
    Route::delete('/pendaftaran/{pendaftaran}', [AdminPendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
    });
});

require __DIR__.'/auth.php';