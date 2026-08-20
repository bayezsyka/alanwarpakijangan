<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Event;
use App\Models\Rutinan;
use App\Models\SelasananEntry;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Bagikan ketersediaan data konten ke seluruh view publik secara otomatis
        View::composer(['layouts.nav', 'layouts.footer', 'layouts.public', 'welcome', 'welcome.*'], function ($view) {
            $hasArticles = Article::published()->exists();
            $hasSelasanan = SelasananEntry::where('is_published', true)->exists();
            $hasGallery = Event::has('photos')->exists()
                || SelasananEntry::where('is_published', true)->whereNotNull('cover_image_path')->exists();
            $hasRutinan = Rutinan::exists();

            $view->with(compact('hasArticles', 'hasSelasanan', 'hasGallery', 'hasRutinan'));
        });
    }
}
