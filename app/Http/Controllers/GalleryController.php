<?php
namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $events = Event::with('photos')->latest()->get();
        return view('galeri', compact('events'));
    }
}