<?php

namespace App\Support;

use App\Models\Article;
use App\Models\SelasananEntry;
use Illuminate\Support\Str;

class SeoUrl
{
    private const PRODUCTION_URL = 'https://alanwarpakijangan.com';

    public static function baseUrl(): string
    {
        $url = trim((string) config('app.url', self::PRODUCTION_URL));

        if ($url === '') {
            return self::PRODUCTION_URL;
        }

        $host = parse_url($url, PHP_URL_HOST);
        $port = parse_url($url, PHP_URL_PORT);

        if (
            ! $host ||
            in_array($host, ['localhost', '127.0.0.1', '0.0.0.0'], true) ||
            Str::endsWith($host, ['.test', '.local', '.example', '.invalid']) ||
            $port === 8000 ||
            Str::contains($url, ':8000')
        ) {
            return self::PRODUCTION_URL;
        }

        return rtrim($url, '/');
    }

    public static function url(string $path = ''): string
    {
        return self::baseUrl() . '/' . ltrim($path, '/');
    }

    public static function articleUrl(Article|string $article): string
    {
        $slug = $article instanceof Article ? $article->slug : $article;

        return self::url('artikel/' . ltrim((string) $slug, '/'));
    }

    public static function selasananUrl(SelasananEntry|string $entry): string
    {
        $slug = $entry instanceof SelasananEntry ? $entry->slug : $entry;

        return self::url('selasanan/' . ltrim((string) $slug, '/'));
    }

    public static function assetUrl(string $path): string
    {
        return self::url(ltrim($path, '/'));
    }

    public static function articleImageUrl(?string $image): string
    {
        if ($image && Str::startsWith($image, ['http://', 'https://'])) {
            return $image;
        }

        if ($image) {
            return self::assetUrl('storage/' . ltrim($image, '/'));
        }

        return self::assetUrl('images/landingpage/bgppdb.png');
    }

    /**
     * Menghasilkan ringkasan deskripsi meta yang bersih tanpa tag HTML,
     * memotong di batas kata utuh (140-160 karakter), dan tanpa karakter gantung.
     */
    public static function cleanDescription(?string $text, int $limit = 155): string
    {
        if (empty($text)) {
            return 'Pondok Pesantren Al-Anwar Pakijangan di Bulakamba, Brebes mengembangkan pendidikan salaf modern, Madrasah Diniyah, SMP, dan pembinaan karakter santri.';
        }

        // Hapus tag HTML & decode entitas HTML
        $cleaned = html_entity_decode(strip_tags($text), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        // Bersihkan whitespace berlebih & newline
        $cleaned = trim(preg_replace('/\s+/', ' ', $cleaned));

        if (mb_strlen($cleaned, 'UTF-8') <= $limit) {
            return $cleaned;
        }

        // Potong di batas kata terdekat sebelum limit
        $sub = mb_substr($cleaned, 0, $limit, 'UTF-8');
        $lastSpace = mb_strrpos($sub, ' ', 0, 'UTF-8');

        if ($lastSpace !== false && $lastSpace > 100) {
            $sub = mb_substr($sub, 0, $lastSpace, 'UTF-8');
        }

        // Hapus karakter tanda baca yang menggantung di akhir
        $sub = rtrim($sub, ',;:-—–.');

        return $sub . '...';
    }

    /**
     * Schema JSON-LD Organisasi / Lembaga Pendidikan Al-Anwar Pakijangan
     */
    public static function organizationSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => ['EducationalOrganization', 'School'],
            '@id' => self::url('#organization'),
            'name' => 'Pondok Pesantren Al-Anwar Pakijangan',
            'alternateName' => [
                'PP Al-Anwar Pakijangan',
                'Ponpes Al-Anwar Pakijangan',
                'Pesantren Al-Anwar Pakijangan',
                'Al-Anwar Pakijangan',
                'SMP Al Anwar Pakijangan',
                'Madrasah Diniyah Al-Anwar Pakijangan',
                'Kubah Jawa',
            ],
            'url' => self::url(),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => self::assetUrl('images/logo.webp'),
                'caption' => 'Logo Pondok Pesantren Al-Anwar Pakijangan',
            ],
            'image' => self::assetUrl('images/landingpage/bgppdb.png'),
            'description' => 'Pondok pesantren salaf modern di Pakijangan, Bulakamba, Brebes yang memadukan pendidikan agama, ilmu pengetahuan, pembinaan karakter, dan pengembangan potensi santri.',
            'slogan' => 'Mendampingi Potensi, Membentuk Karakter',
            'founder' => [
                '@type' => 'Person',
                'name' => 'KH. Anwar Mukhtar',
                'jobTitle' => 'Pendiri Pondok Pesantren Al-Anwar Pakijangan',
            ],
            'leader' => [
                '@type' => 'Person',
                'name' => 'KH. Muhammad Miftah',
                'jobTitle' => 'Pimpinan & Pengasuh Pondok Pesantren Al-Anwar Pakijangan',
            ],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Jl. Raya Pakijangan R. Bulakamba No.08, RT.04/RW.02',
                'addressLocality' => 'Pakijangan, Bulakamba',
                'addressRegion' => 'Jawa Tengah',
                'postalCode' => '52253',
                'addressCountry' => 'ID',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => -6.871891,
                'longitude' => 108.959621,
            ],
            'telephone' => '+62-283-870290',
            'sameAs' => [
                'https://www.youtube.com/@alanwarpakijangan5759',
                'https://instagram.com/pesantrenalanwar',
            ],
        ];
    }

    /**
     * Schema JSON-LD WebSite dengan SearchAction
     */
    public static function websiteSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => self::url('#website'),
            'name' => 'Pondok Pesantren Al-Anwar Pakijangan',
            'alternateName' => 'Al-Anwar Pakijangan',
            'url' => self::url(),
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => self::url('artikel?search={search_term_string}'),
                ],
                'query-input' => 'required name=search_term_string',
            ],
            'publisher' => [
                '@id' => self::url('#organization'),
            ],
        ];
    }

    /**
     * Schema JSON-LD BreadcrumbList
     *
     * @param array<int, array{name: string, url: string}> $items
     */
    public static function breadcrumbSchema(array $items): array
    {
        $itemListElement = [];
        $position = 1;

        foreach ($items as $item) {
            $itemListElement[] = [
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $item['name'],
                'item' => $item['url'],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $itemListElement,
        ];
    }
}
