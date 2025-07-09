<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule; // <-- 1. TAMBAHKAN IMPORT INI

class EventController extends Controller
{
    public function index()
    {
        $events = Event::withCount('photos')->latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // 2. TAMBAHKAN ATURAN 'unique:events'
            'nama_acara' => 'required|string|max:255|unique:events,nama_acara',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'photos' => 'required|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        $event = Event::create($validated);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('gallery', 'public');
                $event->photos()->create(['file_path' => $path]);
            }
        }
        
         // Jika request adalah AJAX, kita bisa beri response JSON
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Acara berhasil dibuat!']);
        }
        // 3. PASTIKAN REDIRECT INI SELALU ADA DI AKHIR
        return redirect()->route('admin.events.index')->with('success', 'Acara galeri berhasil ditambahkan.');
    }

    public function edit(Event $event)
    {
        $event->load('photos');
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            // 4. ATURAN UNIQUE YANG MENGABAIKAN EVENT SAAT INI
            'nama_acara' => ['required', 'string', 'max:255', Rule::unique('events')->ignore($event->id)],
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            'delete_photos' => 'nullable|array',
            'delete_photos.*' => 'integer|exists:event_photos,id'
        ]);

        $event->update($validated);

        if ($request->has('delete_photos')) {
            foreach ($request->delete_photos as $photoId) {
                $photo = EventPhoto::find($photoId);
                if ($photo) {
                    Storage::disk('public')->delete($photo->file_path);
                    $photo->delete();
                }
            }
        }

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('gallery', 'public');
                $event->photos()->create(['file_path' => $path]);
            }
        }
        
        // 5. PASTIKAN REDIRECT INI SELALU ADA DI AKHIR
        return redirect()->route('admin.events.index')->with('success', 'Acara galeri berhasil diperbarui.');
    }
    public function destroy(Event $event)
    {
        // 1. Hapus semua file foto dari storage terlebih dahulu
        foreach ($event->photos as $photo) {
            if (Storage::disk('public')->exists($photo->file_path)) {
                Storage::disk('public')->delete($photo->file_path);
            }
        }

        // 2. Hapus data acara (ini akan otomatis menghapus data foto terkait karena onDelete('cascade'))
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Acara galeri berhasil dihapus.');
    }
}