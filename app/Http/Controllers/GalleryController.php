<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\SelasananEntry;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $events = Event::with('photos')->latest()->get();

        // Ambil entry Selasanan yang sudah dipublish dan punya foto cover
        $selasananEntries = SelasananEntry::where('is_published', true)
            ->whereNotNull('cover_image_path')
            ->orderByDesc('monday_date')
            ->get();

        return view('galeri', compact('events', 'selasananEntries'));
    }
}
