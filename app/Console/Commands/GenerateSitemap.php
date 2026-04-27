<?php

namespace App\Console\Commands;

use App\Models\Article;
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

        $this->writeUrl($xml, route('welcome'), null, 'weekly', '1.0');
        $this->writeUrl($xml, route('artikel'), null, 'daily', '0.8');

        Article::published()
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderByDesc('updated_at')
            ->get()
            ->each(function (Article $article) use ($xml) {
                $this->writeUrl(
                    $xml,
                    route('artikel.detail', ['article' => $article->slug]),
                    $article->updated_at?->toAtomString(),
                    'weekly',
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
