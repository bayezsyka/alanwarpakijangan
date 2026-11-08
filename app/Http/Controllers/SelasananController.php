<?php

namespace App\Http\Controllers;

use App\Models\SelasananEntry;
use Illuminate\Support\Facades\Storage;
use App\Support\SeoUrl;
use Inertia\Inertia;

class SelasananController extends Controller
{
    public function index()
    {
        if (SelasananEntry::where('is_published', true)->doesntExist()) {
            return redirect()->route('welcome');
        }

        $terbaru = SelasananEntry::where('is_published', true)
            ->orderByDesc('monday_date')
            ->first();

        $arsip = SelasananEntry::where('is_published', true)
            ->orderByDesc('monday_date')
            ->paginate(10);

        return Inertia::render('Selasanan/Indeks', [
            'terbaru' => $terbaru ? $this->presentasikan($terbaru) : null,
            'arsip' => $arsip->through(fn (SelasananEntry $entry) => $this->presentasikan($entry)),
            'seo' => [
                'judul' => 'Kajian Selasanan KH Muhammad Miftah | Al-Anwar Pakijangan',
                'deskripsi' => 'Jurnal dokumentasi, rekaman audio, dan rangkuman kajian rutin Selasanan bersama KH Muhammad Miftah di Pondok Pesantren Al-Anwar Pakijangan Brebes.',
                'canonical' => SeoUrl::url('selasanan'),
                'gambar' => $terbaru?->cover_image_path ? asset('storage/' . $terbaru->cover_image_path) : SeoUrl::assetUrl('images/landingpage/bgppdb.png'),
                'schema' => [SeoUrl::breadcrumbSchema([
                    ['name' => 'Beranda', 'url' => SeoUrl::baseUrl() . '/'],
                    ['name' => 'Kajian Selasanan', 'url' => SeoUrl::url('selasanan')],
                ])],
            ],
        ]);
    }

    public function show(SelasananEntry $selasanan)
    {
        abort_unless($selasanan->is_published, 404);

        $dataSelasanan = $this->presentasikan($selasanan, true);
        $deskripsi = SeoUrl::cleanDescription($selasanan->isi, 155);

        return Inertia::render('Selasanan/Detail', [
            'selasanan' => $dataSelasanan,
            'seo' => [
                'judul' => $selasanan->title . ' | Kajian Selasanan Al-Anwar',
                'deskripsi' => $deskripsi,
                'canonical' => SeoUrl::selasananUrl($selasanan),
                'gambar' => $dataSelasanan['gambar'],
                'jenis' => 'article',
                'schema' => [SeoUrl::breadcrumbSchema([
                    ['name' => 'Beranda', 'url' => SeoUrl::baseUrl() . '/'],
                    ['name' => 'Kajian Selasanan', 'url' => SeoUrl::url('selasanan')],
                    ['name' => $selasanan->title, 'url' => SeoUrl::selasananUrl($selasanan)],
                ])],
            ],
        ]);
    }

    public function downloadAudio(SelasananEntry $selasanan)
    {
        abort_unless($selasanan->is_published, 404);

        if (!$selasanan->audio_path || !Storage::disk('public')->exists($selasanan->audio_path)) {
            abort(404);
        }

        $path = Storage::disk('public')->path($selasanan->audio_path);
        
        // Ambil ekstensi file dari path asli
        $extension = pathinfo($selasanan->audio_path, PATHINFO_EXTENSION);
        
        // Format nama file: "(Pembicara) - Kajian Selasanan - (Tanggal).ext"
        $speaker = $selasanan->speaker ?? 'KH. Muhammad Miftah';
        $date = $selasanan->monday_date->format('Y-m-d');
        $filename = "{$speaker} - Kajian Selasanan - {$date}.{$extension}";

        return response()->download($path, $filename, [
            'Content-Type' => $selasanan->audio_mime ?? 'application/octet-stream',
        ]);
    }

    private function presentasikan(SelasananEntry $entry, bool $sertakanIsi = false): array
    {
        $data = [
            'id' => $entry->id,
            'judul' => $entry->title,
            'slug' => $entry->slug,
            'tautan' => route('selasanan.show', $entry->slug),
            'pembicara' => $entry->speaker ?? 'KH. Muhammad Miftah',
            'tanggal' => $entry->monday_date?->locale('id')->translatedFormat('d F Y'),
            'tanggal_singkat' => $entry->monday_date?->locale('id')->translatedFormat('d M Y'),
            'periode' => $entry->monday_date?->locale('id')->translatedFormat('F Y') . ', Minggu ' . $entry->week_of_month,
            'gambar' => $entry->cover_image_path ? asset('storage/' . $entry->cover_image_path) : asset('images/landingpage/bgppdb.png'),
            'audio' => $entry->audio_path ? [
                'url' => asset('storage/' . $entry->audio_path),
                'unduh' => route('selasanan.download', $entry->slug),
                'mime' => $entry->audio_mime ?? 'audio/mpeg',
                'ukuran' => $entry->audio_size ? number_format($entry->audio_size / 1048576, 1) . ' MB' : null,
            ] : null,
        ];

        if ($sertakanIsi) {
            $data['isi'] = $entry->isi;
        }

        return $data;
    }
}
