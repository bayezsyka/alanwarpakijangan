<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PenulisArticleController extends Controller
{
    public function __construct(private readonly ImageUploadService $imageUpload) {}

    /**
     * Tampilkan semua artikel milik penulis yang sedang login.
     * Route: GET /penulis/artikel
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $articles = Article::where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('penulis.articles.index', compact('articles', 'user'));
    }

    /**
     * Form buat artikel baru.
     * Route: GET /penulis/artikel/create
     */
    public function create(Request $request)
    {
        $user = $request->user();
        $categories = \App\Models\Category::all();

        return view('penulis.articles.create', compact('user', 'categories'));
    }

    /**
     * Simpan artikel baru.
     * Route: POST /penulis/artikel
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'judul'         => ['required', 'string', 'max:255'],
            'isi'           => ['required', 'string'],
            'category_id'   => ['nullable', 'integer'], // sesuaikan dengan tabel kamu
            'gambar_upload' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'gambar_url'    => ['nullable', 'string', 'url'],
        ]);

        $article = new Article();
        $article->judul       = $validated['judul'];
        $article->slug        = Str::slug($validated['judul']);
        $article->isi         = $validated['isi'];
        $article->category_id = $validated['category_id'] ?? null;
        $article->user_id     = $user->id; // penting: milik penulis yang login
        $article->penulis     = $user->name; // simpan nama penulis

        // Handle Image Upload
        if ($request->hasFile('gambar_upload')) {
            $article->gambar = $this->imageUpload->storeAsWebp(
                $request->file('gambar_upload'),
                'articles',
                disk: 'public',
                quality: 80,
                maxWidth: 2000,
                maxHeight: 2000,
            );
        } elseif ($request->filled('gambar_url')) {
            $article->gambar = $request->gambar_url;
        }

        $article->save();

        return redirect()
            ->route('penulis.articles.index')
            ->with('success', 'Artikel berhasil dibuat.');
    }

    /**
     * Form edit artikel yang dimiliki penulis.
     * Route: GET /penulis/artikel/{article}/edit
     */
    public function edit(Request $request, Article $article)
    {
        $user = $request->user();

        $this->authorizeArticle($user->id, $article);

        $categories = \App\Models\Category::all();

        return view('penulis.articles.edit', compact('article', 'user', 'categories'));
    }

    /**
     * Update artikel milik penulis.
     * Route: PUT /penulis/artikel/{article}
     */
    public function update(Request $request, Article $article)
    {
        $user = $request->user();

        $this->authorizeArticle($user->id, $article);

        $validated = $request->validate([
            'judul'         => ['required', 'string', 'max:255'],
            'isi'           => ['required', 'string'],
            'category_id'   => ['nullable', 'integer'],
            'gambar_upload' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'gambar_url'    => ['nullable', 'string', 'url'],
        ]);

        $article->judul = $validated['judul'];
        if ($article->isDirty('judul')) {
            $article->slug = Str::slug($validated['judul']);
        }
        $article->isi = $validated['isi'];
        $article->category_id = $validated['category_id'] ?? null;

        // Handle Image Upload
        if ($request->hasFile('gambar_upload')) {
            // Delete old image if it exists and is a file (not a URL)
            if ($article->gambar && !Str::startsWith($article->gambar, 'http')) {
                Storage::disk('public')->delete($article->gambar);
            }

            $article->gambar = $this->imageUpload->storeAsWebp(
                $request->file('gambar_upload'),
                'articles',
                disk: 'public',
                quality: 80,
                maxWidth: 2000,
                maxHeight: 2000,
            );
        } elseif ($request->filled('gambar_url')) {
            if ($article->gambar && !Str::startsWith($article->gambar, 'http')) {
                Storage::disk('public')->delete($article->gambar);
            }
            $article->gambar = $request->gambar_url;
        }

        $article->save();

        return redirect()
            ->route('penulis.articles.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Hapus artikel milik penulis.
     * Route: DELETE /penulis/artikel/{article}
     */
    public function destroy(Request $request, Article $article)
    {
        $user = $request->user();

        $this->authorizeArticle($user->id, $article);

        $article->delete();

        return redirect()
            ->route('penulis.articles.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }

    /**
     * Pastikan artikel memang milik user ini.
     */
    protected function authorizeArticle(int $userId, Article $article): void
    {
        if ($article->user_id !== $userId) {
            abort(403, 'Anda tidak boleh mengelola artikel ini.');
        }
    }
}
