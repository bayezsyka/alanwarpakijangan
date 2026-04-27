<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Services\ImageUploadService;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    use LogsActivity;

    public function __construct(private readonly ImageUploadService $imageUpload)
    {
    }

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
            'gambar_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'gambar_url' => 'nullable|url',
            'status' => 'required|in:draft,published,archived',
        ]);

        if ($request->hasFile('gambar_upload')) {
            $validated['gambar'] = $this->imageUpload->storeAsWebp(
                $request->file('gambar_upload'),
                'artikel-images',
                disk: 'public',
                quality: 80,
                maxWidth: 2000,
                maxHeight: 2000,
            );
        } elseif ($request->filled('gambar_url')) {
            $validated['gambar'] = $validated['gambar_url'];
        }

        $artikel = Article::create($validated);

        $this->logActivity('buat artikel', 'Judul: ' . $artikel->judul);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Article $artikel)
    {
        $categories = Category::all();
        return view('admin.artikel.edit', compact('artikel', 'categories'));
    }

    public function update(Request $request, Article $artikel)
    {
        $judulRules = ['required', 'string', 'max:255'];

        if ($request->input('judul') !== $artikel->judul) {
            $judulRules[] = Rule::unique('articles', 'judul')->ignore($artikel->id);
        }

        $validated = $request->validate([
            'judul' => $judulRules,
            'penulis' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'category_id' => 'required|exists:categories,id',
            'gambar_upload' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:10240'],
            'gambar_url' => ['nullable', 'url'],
            'hapus_gambar' => ['boolean'],
            'status' => ['required', 'in:draft,published,archived'],
        ]);

        $dataToUpdate = $validated;

        if ($artikel->user_id !== auth()->id() && $artikel->user_id !== null) {
            $dataToUpdate['penulis'] = $artikel->penulis;
        }

        if ($request->hasFile('gambar_upload')) {
            if ($artikel->gambar && !Str::startsWith($artikel->gambar, 'http')) {
                Storage::disk('public')->delete($artikel->gambar);
            }

            $dataToUpdate['gambar'] = $this->imageUpload->storeAsWebp(
                $request->file('gambar_upload'),
                'artikel-images',
                disk: 'public',
                quality: 80,
                maxWidth: 2000,
                maxHeight: 2000,
            );
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
        $this->logActivity('hapus artikel (ke sampah)', 'Judul: ' . $artikel->judul);

        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel dipindahkan ke sampah.');
    }

    public function trash()
    {
        $articles = Article::onlyTrashed()->latest()->paginate(10);
        return view('admin.artikel.trash', compact('articles'));
    }

    public function restore($id)
    {
        $artikel = Article::onlyTrashed()->findOrFail($id);
        $artikel->restore();

        $this->logActivity('restore artikel', 'Judul: ' . $artikel->judul);

        return redirect()->route('admin.artikel.trash')->with('success', 'Artikel berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $artikel = Article::onlyTrashed()->findOrFail($id);

        if ($artikel->gambar && !Str::startsWith($artikel->gambar, 'http')) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $this->logActivity('hapus permanen artikel', 'Judul: ' . $artikel->judul);

        $artikel->forceDelete();

        return redirect()->route('admin.artikel.trash')->with('success', 'Artikel dihapus secara permanen.');
    }

    public function autosave(Request $request)
    {
        $id = $request->input('id');

        $validated = $request->validate([
            'judul' => 'nullable|string|max:255',
            'penulis' => 'nullable|string|max:255',
            'isi' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'nullable|in:draft,published,archived',
        ]);

        if ($id) {
            $artikel = Article::findOrFail($id);
            // Don't update slug if title is empty/default and it already has a slug
            if (empty($validated['judul'])) {
                unset($validated['judul']);
            }
            $artikel->update($validated);
        } else {
            // New article
            $data = $validated;
            if (empty($data['judul'])) {
                $data['judul'] = 'Tanpa Judul - ' . now()->translatedFormat('d F Y H:i');
            }
            if (empty($data['penulis'])) {
                $data['penulis'] = auth()->user()->name;
            }
            if (empty($data['status'])) {
                $data['status'] = 'draft';
            }
            if (empty($data['category_id'])) {
                $data['category_id'] = Category::first()?->id;
            }
            $data['user_id'] = auth()->id();

            $artikel = Article::create($data);
        }

        return response()->json([
            'success' => true,
            'id' => $artikel->id,
            'slug' => $artikel->slug,
            'judul' => $artikel->judul,
            'message' => 'Tersimpan otomatis pada ' . now()->format('H:i:s')
        ]);
    }
}
