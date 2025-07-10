<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    public function index()
    {
        // Mengurutkan berdasarkan data terbaru (created_at)
        $articles = Article::latest()->paginate(10);
        return view('admin.artikel.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255|unique:articles,judul',
            'penulis' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori' => 'required|string|in:Artikel,Opini',
            'gambar_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'gambar_url' => 'nullable|url',
        ]);

        // Membuat slug secara otomatis dari judul
        $validated['slug'] = Str::slug($validated['judul']);
        
        // Menangani upload gambar (dari file atau URL)
        if ($request->hasFile('gambar_upload')) {
            $validated['gambar'] = $request->file('gambar_upload')->store('artikel-images', 'public');
        } elseif ($request->filled('gambar_url')) {
            $validated['gambar'] = $validated['gambar_url'];
        }

        Article::create($validated);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Article $artikel)
    {
        return view('admin.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, Article $artikel)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255', Rule::unique('articles')->ignore($artikel->id)],
            'penulis' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'kategori' => ['required', 'string', 'in:Artikel,Opini'],
            'gambar_upload' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif|max:10240'],
            'gambar_url' => ['nullable', 'url'],
            'hapus_gambar' => ['boolean'],
        ]);
        
        // Membuat ulang slug jika judul berubah
        $validated['slug'] = Str::slug($validated['judul']);

        $dataToUpdate = $validated;

        // Logika untuk menangani gambar
        if ($request->hasFile('gambar_upload')) {
            if ($artikel->gambar && !Str::startsWith($artikel->gambar, 'http')) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $dataToUpdate['gambar'] = $request->file('gambar_upload')->store('artikel-images', 'public');
        } elseif ($request->filled('gambar_url')) {
            if ($artikel->gambar && !Str::startsWith($artikel->gambar, 'http')) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $dataToUpdate['gambar'] = $validated['gambar_url'];
        } elseif ($request->input('hapus_gambar') == '1') {
            if ($artikel->gambar && !Str::startsWith($artikel->gambar, 'http')) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $dataToUpdate['gambar'] = null;
        }

        $artikel->update($dataToUpdate);

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