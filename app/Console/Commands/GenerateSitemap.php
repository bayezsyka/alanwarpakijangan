<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Article;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap for the website';

    public function handle()
    {
        $this->info('Generating sitemap...');
        $sitemap = Sitemap::create();

        $sitemap->add(Url::create('/')->setPriority(1.0));
        $sitemap->add(Url::create('/artikel')->setPriority(0.8));
        // Tambahkan halaman lain jika ada
        
        Article::all()->each(function (Article $article) use ($sitemap) {
            $sitemap->add(
                Url::create(route('artikel.detail', $article->slug))
                    ->setLastModificationDate($article->updated_at)
            );
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));
        $this->info('Sitemap generated successfully!');
        return 0;
    }
}