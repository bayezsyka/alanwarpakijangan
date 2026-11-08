<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\SelasananEntry;
use App\Support\SeoUrl;
use Carbon\Carbon;
use Inertia\Inertia;

class GalleryController extends Controller
{
    public function index()
    {
        $acara = Event::with('photos')->has('photos')->latest()->get();

        $galeriSelasanan = SelasananEntry::where('is_published', true)
            ->whereNotNull('cover_image_path')
            ->orderByDesc('monday_date')
            ->get();

        if ($acara->isEmpty() && $galeriSelasanan->isEmpty()) {
            return redirect()->route('welcome');
        }

        return Inertia::render('Galeri', [
            'acara' => $acara->map(fn (Event $event) => [
                'id' => $event->id,
                'nama' => $event->nama_acara,
                'tanggal' => $event->tanggal ? Carbon::parse($event->tanggal)->locale('id')->translatedFormat('d F Y') : null,
                'deskripsi' => $event->deskripsi,
                'foto' => $event->photos->map(fn ($photo) => [
                    'id' => $photo->id,
                    'url' => asset('storage/' . $photo->file_path),
                    'alt' => $event->nama_acara,
                ])->values(),
            ])->values(),
            'selasanan' => $galeriSelasanan->map(fn (SelasananEntry $entry) => [
                'id' => $entry->id,
                'judul' => $entry->title,
                'tautan' => route('selasanan.show', $entry->slug),
                'gambar' => asset('storage/' . $entry->cover_image_path),
            ])->values(),
            'seo' => [
                'judul' => 'Galeri Pondok Pesantren Al-Anwar Pakijangan',
                'deskripsi' => 'Dokumentasi kegiatan santri, pendidikan, kajian, akhirussanah, dan aktivitas Pondok Pesantren Al-Anwar Pakijangan di Brebes.',
                'canonical' => SeoUrl::url('galeri-acara'),
                'gambar' => SeoUrl::assetUrl('images/landingpage/bgppdb.png'),
                'schema' => [SeoUrl::breadcrumbSchema([
                    ['name' => 'Beranda', 'url' => SeoUrl::baseUrl() . '/'],
                    ['name' => 'Galeri', 'url' => SeoUrl::url('galeri-acara')],
                ])],
            ],
        ]);
    }
}
