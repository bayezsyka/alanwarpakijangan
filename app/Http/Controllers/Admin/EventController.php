<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventPhoto;
use App\Services\ImageUploadService;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    use LogsActivity;

    public function __construct(private readonly ImageUploadService $imageUpload)
    {
    }

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
            'nama_acara' => 'required|string|max:255|unique:events,nama_acara',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'photos' => 'required|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240'
        ]);

        $event = Event::create($validated);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $this->imageUpload->storeAsWebp(
                    $photo,
                    'gallery',
                    disk: 'public',
                    quality: 80,
                    maxWidth: 2000,
                    maxHeight: 2000,
                );

                $event->photos()->create(['file_path' => $path]);
            }
        }

        $this->logActivity('buat galeri acara', 'Acara: ' . $event->nama_acara);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Acara berhasil dibuat!']);
        }

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
            'nama_acara' => ['required', 'string', 'max:255', Rule::unique('events')->ignore($event->id)],
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240',
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
                $path = $this->imageUpload->storeAsWebp(
                    $photo,
                    'gallery',
                    disk: 'public',
                    quality: 80,
                    maxWidth: 2000,
                    maxHeight: 2000,
                );

                $event->photos()->create(['file_path' => $path]);
            }
        }

        $this->logActivity('edit galeri acara', 'Acara: ' . $event->nama_acara);

        return redirect()->route('admin.events.index')->with('success', 'Acara galeri berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        foreach ($event->photos as $photo) {
            if (Storage::disk('public')->exists($photo->file_path)) {
                Storage::disk('public')->delete($photo->file_path);
            }
        }

        $this->logActivity('hapus galeri acara', 'Acara: ' . $event->nama_acara);

        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Acara galeri berhasil dihapus.');
    }
}
