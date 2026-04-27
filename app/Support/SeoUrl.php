<?php

namespace App\Support;

use App\Models\Article;
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

        return self::assetUrl('images/logo.webp');
    }
}
