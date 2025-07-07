<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        // Cek jika ada input pencarian
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('judul', 'like', "%{$searchTerm}%")
                  ->orWhere('penulis', 'like', "%{$searchTerm}%");
            });
        }

        $articles = $query->orderBy('tanggal', 'desc')
                          ->paginate(10)
                          ->withQueryString(); // Agar pencarian tetap ada saat ganti halaman

        return view('admin.artikel.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'         => 'required|string|max:255',
            'penulis'       => 'required|string|max:255',
            'isi'           => 'required|string',
            'tanggal'       => 'required|date',
            'gambar_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_url'    => 'nullable|url',
        ]);

        $imagePath = null;

        if ($request->hasFile('gambar_upload')) {
            $imagePath = $request->file('gambar_upload')->store('artikel', 'public');
        } elseif ($request->filled('gambar_url')) {
            $imagePath = $request->gambar_url;
        }

        Article::create([
            'judul'   => $request->judul,
            'penulis' => $request->penulis,
            'isi'     => $request->isi,
            'tanggal' => $request->tanggal,
            'gambar'  => $imagePath,
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Article $artikel)
    {
        return view('admin.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, Article $artikel)
    {
        $request->validate([
            'judul'         => 'required|string|max:255',
            'penulis'       => 'required|string|max:255',
            'isi'           => 'required|string',
            'tanggal'       => 'required|date',
            'gambar_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_url'    => 'nullable|url',
        ]);

        $imagePath = $artikel->gambar;

        if ($request->hasFile('gambar_upload')) {
            if ($artikel->gambar && !Str::startsWith($artikel->gambar, 'http')) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $imagePath = $request->file('gambar_upload')->store('artikel', 'public');
        } elseif ($request->filled('gambar_url')) {
            if ($artikel->gambar && !Str::startsWith($artikel->gambar, 'http')) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $imagePath = $request->gambar_url;
        } elseif ($request->input('hapus_gambar') == '1') {
            if ($artikel->gambar && !Str::startsWith($artikel->gambar, 'http')) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $imagePath = null;
        }

        $artikel->update([
            'judul'   => $request->judul,
            'penulis' => $request->penulis,
            'isi'     => $request->isi,
            'tanggal' => $request->tanggal,
            'gambar'  => $imagePath,
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $artikel)
    {
        if ($artikel->gambar && !Str::startsWith($artikel->gambar, 'http')) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $artikel->delete();
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
