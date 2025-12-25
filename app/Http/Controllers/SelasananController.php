<?php

namespace App\Http\Controllers;

use App\Models\SelasananEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SelasananController extends Controller
{
    public function index()
    {
        $latest = SelasananEntry::where('is_published', true)
            ->orderByDesc('monday_date')
            ->first();

        $entries = SelasananEntry::where('is_published', true)
            ->orderByDesc('monday_date')
            ->paginate(10);

        return view('selasanan.index', compact('latest', 'entries'));
    }

    public function show(SelasananEntry $selasanan)
    {
        abort_unless($selasanan->is_published, 404);

        return view('selasanan.show', compact('selasanan'));
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
}
