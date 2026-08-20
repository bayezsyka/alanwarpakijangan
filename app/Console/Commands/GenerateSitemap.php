<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\SelasananEntry;
use App\Support\SeoUrl;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\URL;
use XMLWriter;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap for the website';

    public function handle()
    {
        $this->info('Generating sitemap...');

        $baseUrl = SeoUrl::baseUrl();
        URL::forceRootUrl($baseUrl);
        URL::forceScheme('https');

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->startDocument('1.0', 'UTF-8');
        $xml->setIndent(true);
        $xml->startElement('urlset');
        $xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        // Halaman Utama & Sekunder
        $this->writeUrl($xml, SeoUrl::baseUrl() . '/', null, 'daily', '1.0');
        $this->writeUrl($xml, SeoUrl::url('artikel'), null, 'daily', '0.9');
        $this->writeUrl($xml, SeoUrl::url('selasanan'), null, 'weekly', '0.8');
        $this->writeUrl($xml, SeoUrl::url('pendaftaran'), null, 'monthly', '0.8');
        $this->writeUrl($xml, SeoUrl::url('galeri-acara'), null, 'weekly', '0.7');

        // Semua Artikel Published
        Article::published()
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderByDesc('updated_at')
            ->get()
            ->each(function (Article $article) use ($xml) {
                $this->writeUrl(
                    $xml,
                    SeoUrl::articleUrl($article),
                    $article->updated_at?->toAtomString(),
                    'weekly',
                    '0.8'
                );
            });

        // Semua Jurnal Selasanan Published
        SelasananEntry::where('is_published', true)
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderByDesc('updated_at')
            ->get()
            ->each(function (SelasananEntry $entry) use ($xml) {
                $this->writeUrl(
                    $xml,
                    SeoUrl::selasananUrl($entry),
                    $entry->updated_at?->toAtomString(),
                    'monthly',
                    '0.7'
                );
            });

        $xml->endElement();
        $xml->endDocument();

        file_put_contents(public_path('sitemap.xml'), $xml->outputMemory());

        $this->info('Sitemap generated successfully!');

        return self::SUCCESS;
    }

    private function writeUrl(
        XMLWriter $xml,
        string $loc,
        ?string $lastmod = null,
        ?string $changefreq = null,
        ?string $priority = null
    ): void {
        $xml->startElement('url');
        $xml->writeElement('loc', $loc);

        if ($lastmod) {
            $xml->writeElement('lastmod', $lastmod);
        }

        if ($changefreq) {
            $xml->writeElement('changefreq', $changefreq);
        }

        if ($priority) {
            $xml->writeElement('priority', $priority);
        }

        $xml->endElement();
    }
}
