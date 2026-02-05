<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    /**
     * POST /api/shorten
     * Body: {"url":"https://..."}
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'url' => ['required', 'url', 'max:2048'],
        ]);

        $url = $data['url'];

        // Security: prevent this endpoint being used as a public open-redirect shortener for other domains.
        // Only allow URLs on the same host as this app.
        $incomingHost = parse_url($url, PHP_URL_HOST);
        $appHost = parse_url(config('app.url'), PHP_URL_HOST) ?: $request->getHost();
        if ($incomingHost && $appHost && !hash_equals(strtolower($incomingHost), strtolower($appHost))) {
            return response()->json([
                'message' => 'URL host tidak diizinkan.',
            ], 422);
        }

        $hash = hash('sha256', $url);
        $link = ShortLink::where('url_hash', $hash)->first();

        if (!$link) {
            // Generate unique code
            do {
                $code = Str::lower(Str::random(8));
            } while (ShortLink::where('code', $code)->exists());

            $link = ShortLink::create([
                'code' => $code,
                'url' => $url,
                'url_hash' => $hash,
            ]);
        }

        return response()->json([
            'code' => $link->code,
            'short_url' => url('/s/' . $link->code),
        ]);
    }

    /**
     * GET /s/{code}
     */
    public function redirect(string $code)
    {
        $link = ShortLink::where('code', $code)->firstOrFail();
        $link->increment('clicks');

        // away() prevents Laravel from trying to validate internal paths.
        return redirect()->away($link->url, 301);
    }
}
