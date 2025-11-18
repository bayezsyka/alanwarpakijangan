<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Validation\Rule;
use App\Traits\LogsActivity;

class ArticleController extends Controller
{
    use LogsActivity;

    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.artikel.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.artikel.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255|unique:articles,judul',
            'penulis' => 'required|string|max:255',
            'isi' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'gambar_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'gambar_url' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['judul']);

        if ($request->hasFile('gambar_upload')) {
            $validated['gambar'] = $request->file('gambar_upload')->store('artikel-images', 'public');
        } elseif ($request->filled('gambar_url')) {
            $validated['gambar'] = $validated['gambar_url'];
        }

        $artikel = Article::create($validated);

        $this->logActivity('buat artikel', 'Judul: ' . $artikel->judul);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Article $artikel)
    {
        $categories = Category::all(); // <-- LAKUKAN HAL YANG SAMA UNTUK EDIT
        return view('admin.artikel.edit', compact('artikel', 'categories'));
    }

    public function update(Request $request, Article $artikel)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255', Rule::unique('articles')->ignore($artikel->id)],
            'penulis' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'category_id' => 'required|exists:categories,id', // <-- UBAH VALIDASI
            'gambar_upload' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10240'],
            'gambar_url' => ['nullable', 'url'],
            'hapus_gambar' => ['boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['judul']);
        $dataToUpdate = $validated;

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

        $this->logActivity('edit artikel', 'Judul: ' . $artikel->judul);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $artikel)
    {
        if ($artikel->gambar && !Str::startsWith($artikel->gambar, 'http')) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $this->logActivity('hapus artikel', 'Judul: ' . $artikel->judul);

        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
