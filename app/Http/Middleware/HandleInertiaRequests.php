<?php

namespace App\Http\Middleware;

use App\Models\Article;
use App\Models\Event;
use App\Models\Rutinan;
use App\Models\SelasananEntry;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'navigasi' => fn () => [
                'artikel' => Article::published()->exists(),
                'selasanan' => SelasananEntry::where('is_published', true)->exists(),
                'galeri' => Event::has('photos')->exists()
                    || SelasananEntry::where('is_published', true)->whereNotNull('cover_image_path')->exists(),
                'rutinan' => Rutinan::exists(),
            ],
            'identitas' => [
                'nama' => 'Pondok Pesantren Al-Anwar Pakijangan',
                'slogan' => 'Mendampingi Potensi, Membentuk Karakter',
                'telepon' => '(0283) 870290',
                'telepon_url' => 'tel:0283870290',
                'alamat' => 'Jl. Raya Pakijangan R. Bulakamba No.08, RT.04/RW.02, Pakijangan, Kec. Bulakamba, Kabupaten Brebes, Jawa Tengah 52253',
                'instagram' => 'https://instagram.com/pesantrenalanwar',
                'youtube' => 'https://www.youtube.com/@alanwarpakijangan5759',
                'lokasi' => 'https://www.google.com/maps?q=Pondok+Pesantren+Al+Anwar+Pakijangan',
            ],
            'urlSaatIni' => fn () => $request->fullUrl(),
        ];
    }
}
