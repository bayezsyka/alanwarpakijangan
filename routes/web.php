<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ShortLinkController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\RutinanController as AdminRutinanController;
use App\Http\Controllers\Admin\RutinanExceptionController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\SelasananController;
use App\Http\Controllers\Selasanan\SelasananManageController;
use App\Support\SeoUrl;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// == RUTE FRONTEND (PUBLIK) ==
Route::get('/', [ArtikelController::class, 'welcome'])->name('welcome');
// Short URL redirect (dipakai oleh fitur Share Snippet)
Route::get('/s/{code}', [ShortLinkController::class, 'redirect'])
    ->where('code', '[A-Za-z0-9]{6,16}');
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel');
Route::get('/artikel/{article:slug}', [ArtikelController::class, 'show'])->name('artikel.detail');
Route::get('/galeri-acara', [GalleryController::class, 'index'])->name('galeri.index');
Route::get('/profil', function () {
    return Inertia::render('Profil', [
        'seo' => [
            'judul' => 'Profil Pondok Pesantren Al-Anwar Pakijangan | Brebes',
            'deskripsi' => 'Mengenal Pondok Pesantren Al-Anwar Pakijangan di Bulakamba, Brebes: sejarah, kurikulum salaf modern, SMP, Madrasah Diniyah, pendiri, pengasuh, dan pembinaan karakter santri.',
            'canonical' => SeoUrl::url('profil'),
            'gambar' => SeoUrl::assetUrl('images/landingpage/bgppdb.png'),
            'schema' => [
                SeoUrl::organizationSchema(),
                SeoUrl::breadcrumbSchema([
                    ['name' => 'Beranda', 'url' => SeoUrl::baseUrl() . '/'],
                    ['name' => 'Profil Pesantren', 'url' => SeoUrl::url('profil')],
                ]),
            ],
        ],
    ]);
})->name('profil');

// == SELASANAN (PUBLIK) ==
Route::get('/selasanan', [SelasananController::class, 'index'])->name('selasanan.index');
Route::get('/selasanan/{selasanan:slug}', [SelasananController::class, 'show'])->name('selasanan.show');
Route::get('/selasanan/{selasanan:slug}/download-audio', [SelasananController::class, 'downloadAudio'])->name('selasanan.download');

// == RUTE BACKEND (MEMERLUKAN LOGIN) ==
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- Panel Admin (Superadmin & Admin) ---
    Route::middleware(['role:superadmin,admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('artikel/trash', [AdminArticleController::class, 'trash'])->name('artikel.trash');
        Route::post('artikel/{id}/restore', [AdminArticleController::class, 'restore'])->name('artikel.restore');
        Route::delete('artikel/{id}/force-delete', [AdminArticleController::class, 'forceDelete'])->name('artikel.force-delete');
        Route::post('artikel/autosave', [AdminArticleController::class, 'autosave'])->name('artikel.autosave');
        Route::resource('artikel', AdminArticleController::class);
        Route::resource('events', AdminEventController::class);
        Route::resource('rutinan', AdminRutinanController::class);
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('announcements', AdminAnnouncementController::class)->except(['show']);
        Route::post('/rutinan/{rutinan}/exceptions', [RutinanExceptionController::class, 'store'])->name('rutinan.exceptions.store');
        Route::delete('/rutinan/exceptions/{exception}', [RutinanExceptionController::class, 'destroy'])->name('rutinan.exceptions.destroy');

        // Khusus Superadmin: Manajemen Pengguna & Log Aktivitas
        Route::middleware(['role:superadmin'])->group(function () {
            Route::resource('users', AdminUserController::class);
            Route::get('/logs', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('logs.index');
        });
    });

    // --- Panel Pengurus Selasanan (Superadmin & Admin bisa akses) ---
    Route::middleware(['role:superadmin,admin'])->prefix('manage')->name('manage.')->group(function () {
        Route::get('/selasanan', [SelasananManageController::class, 'index'])->name('selasanan.index');
        Route::get('/selasanan/create', [SelasananManageController::class, 'create'])->name('selasanan.create');
        Route::post('/selasanan', [SelasananManageController::class, 'store'])->name('selasanan.store');
        Route::get('/selasanan/{entry}/edit', [SelasananManageController::class, 'edit'])->name('selasanan.edit');
        Route::put('/selasanan/{entry}', [SelasananManageController::class, 'update'])->name('selasanan.update');
        Route::delete('/selasanan/{entry}', [SelasananManageController::class, 'destroy'])->name('selasanan.destroy');
    });

    // --- Rute Kompatibilitas Penulis (dialihkan ke kelola artikel admin) ---
    Route::get('/penulis/artikel', function () {
        return redirect()->route('admin.artikel.index');
    })->name('penulis.articles.index');
});

require __DIR__ . '/auth.php';
