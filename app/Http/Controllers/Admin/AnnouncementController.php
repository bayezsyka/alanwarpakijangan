<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Traits\LogsActivity;

class AnnouncementController extends Controller
{
    use LogsActivity;

    public function index()
    {
        $announcements = Announcement::latest()->paginate(15);

        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        // default: start = hari ini, end = +1 bulan
        $defaultStart = now()->toDateString();
        $defaultEnd   = now()->addMonth()->toDateString();

        return view('admin.announcements.create', compact('defaultStart', 'defaultEnd'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'      => ['required', 'string', 'max:255'],
            'link'       => ['nullable', 'url'],
            'image'      => ['required', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'start_date' => ['required', 'date'],
            'end_date'   => ['required', 'date', 'after_or_equal:start_date'],
            'is_active'  => ['nullable', 'boolean'],
        ]);

        $path = $request->file('image')->store('announcements', 'public');

        $announcement = Announcement::create([
            'title'      => $validated['title'],
            'link'       => $validated['link'] ?? null,
            'image_path' => $path,
            'start_date' => $validated['start_date'],
            'end_date'   => $validated['end_date'],
            'is_active'  => $request->boolean('is_active', true),
        ]);

        $this->logActivity('buat pengumuman', 'Judul: '.$announcement->title);

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title'      => ['required', 'string', 'max:255'],
            'link'       => ['nullable', 'url'],
            'image'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'start_date' => ['required', 'date'],
            'end_date'   => ['required', 'date', 'after_or_equal:start_date'],
            'is_active'  => ['nullable', 'boolean'],
        ]);

        $data = [
            'title'      => $validated['title'],
            'link'       => $validated['link'] ?? null,
            'start_date' => $validated['start_date'],
            'end_date'   => $validated['end_date'],
            'is_active'  => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('image')) {
            if ($announcement->image_path && Storage::disk('public')->exists($announcement->image_path)) {
                Storage::disk('public')->delete($announcement->image_path);
            }

            $data['image_path'] = $request->file('image')->store('announcements', 'public');
        }

        $announcement->update($data);

        $this->logActivity('edit pengumuman', 'Judul: '.$announcement->title);

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Announcement $announcement)
    {
        if ($announcement->image_path && Storage::disk('public')->exists($announcement->image_path)) {
            Storage::disk('public')->delete($announcement->image_path);
        }

        $this->logActivity('hapus pengumuman', 'Judul: '.$announcement->title);

        $announcement->delete();

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
