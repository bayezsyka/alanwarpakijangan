<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Category;
use App\Traits\LogsActivity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On; // Pastikan ini di-import
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SearchArtikelAdmin extends Component
{
    use WithPagination, WithFileUploads, LogsActivity;

    #[Url(as: 'q')]
    public string $search = '';

    public bool $showModal = false;
    public string $modalMode = 'create';
    public ?Article $editingArticle = null;

    public string $judul = '';
    public string $penulis = '';
    public string $category_id = '';
    public string $isi = '';
    public $gambar_upload = null;
    public string $gambar_url = '';
    public bool $hapus_gambar = false;

    /** @var \Illuminate\Support\Collection<int, Category> */
    public $categories;
    public ?string $existingImage = null;

    public function mount(): void
    {
        $this->categories = Category::orderBy('name')->get();
    }

    public function render()
    {
        $query = Article::query();

        if ($this->search) {
            $query->where(function($q) {
                $q->where('judul', 'like', '%' . $this->search . '%')
                  ->orWhere('penulis', 'like', '%' . $this->search . '%');
            });
        }

        // Ganti orderBy('tanggal', 'desc') menjadi latest()
        $articles = $query->latest()->paginate(9);

        return view('livewire.search-artikel-admin', [
            'articles' => $articles,
            'categories' => $this->categories,
        ]);
    }

    #[On('delete-artikel')]
    public function deleteArtikel($id)
    {
        $article = Article::find($id);

        if ($article) {
            // Hapus gambar jika ada
            $this->deleteExistingImage($article->gambar);

            $article->delete();

            // Kirim pesan sukses kembali ke browser untuk ditampilkan oleh SweetAlert
            $this->dispatch('article-deleted', 'Artikel berhasil dihapus.');
        }
    }

    #[On('open-create-modal')]
    public function handleCreateModal(): void
    {
        $this->openCreateModal();
    }

    public function openCreateModal(): void
    {
        $this->modalMode = 'create';
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEditModal(int $articleId): void
    {
        $article = Article::findOrFail($articleId);
        $this->modalMode = 'edit';
        $this->editingArticle = $article;

        $this->judul = $article->judul;
        $this->penulis = $article->penulis ?? '';
        $this->category_id = (string) $article->category_id;
        $this->isi = $article->isi;
        $this->gambar_url = '';
        $this->gambar_upload = null;
        $this->hapus_gambar = false;
        $this->existingImage = $article->gambar ? $this->resolveImageUrl($article->gambar) : null;

        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetValidation();
        $this->resetForm();
    }

    public function saveArticle(): void
    {
        $this->validate($this->rules());

        $payload = [
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'category_id' => (int) $this->category_id,
            'isi' => $this->isi,
        ];

        $newImagePath = $this->determineImagePath();

        if ($this->modalMode === 'create') {
            if ($newImagePath) {
                $payload['gambar'] = $newImagePath;
            }

            $article = Article::create($payload);
            $this->logActivity('buat artikel', 'Judul: ' . $article->judul);

            $message = 'Artikel berhasil ditambahkan.';
        } else {
            $article = $this->editingArticle;

            if (! $article) {
                return;
            }

            if ($newImagePath) {
                $this->deleteExistingImage($article->gambar);
                $payload['gambar'] = $newImagePath;
            } elseif ($this->hapus_gambar) {
                $this->deleteExistingImage($article->gambar);
                $payload['gambar'] = null;
            }

            $article->update($payload);
            $this->logActivity('edit artikel', 'Judul: ' . $article->judul);

            $message = 'Artikel berhasil diperbarui.';
        }

        $this->dispatch('article-saved', message: $message);
        $this->closeModal();
        $this->resetPage();
    }

    protected function determineImagePath(): ?string
    {
        if ($this->gambar_upload) {
            return $this->gambar_upload->store('artikel-images', 'public');
        }

        if ($this->gambar_url) {
            return $this->gambar_url;
        }

        return null;
    }

    protected function deleteExistingImage(?string $imagePath): void
    {
        if (! $imagePath) {
            return;
        }

        if (! Str::startsWith($imagePath, ['http://', 'https://']) && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }

    protected function resolveImageUrl(string $path): string
    {
        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        return Storage::disk('public')->url($path);
    }

    protected function resetForm(): void
    {
        $this->judul = '';
        $this->penulis = '';
        $this->category_id = '';
        $this->isi = '';
        $this->gambar_upload = null;
        $this->gambar_url = '';
        $this->hapus_gambar = false;
        $this->existingImage = null;
        $this->editingArticle = null;
    }

    protected function rules(): array
    {
        $judulRule = ['required', 'string', 'max:255'];

        if ($this->modalMode === 'create') {
            $judulRule[] = Rule::unique('articles', 'judul');
        } elseif ($this->editingArticle && $this->judul !== $this->editingArticle->judul) {
            $judulRule[] = Rule::unique('articles', 'judul')->ignore($this->editingArticle->id);
        }

        return [
            'judul' => $judulRule,
            'penulis' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'isi' => ['required', 'string'],
            'gambar_upload' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10240'],
            'gambar_url' => ['nullable', 'url'],
            'hapus_gambar' => ['boolean'],
        ];
    }

    public function getPreviewImageProperty(): ?string
    {
        if ($this->modalMode === 'edit' && $this->hapus_gambar && ! $this->gambar_upload && ! $this->gambar_url) {
            return null;
        }

        if ($this->gambar_upload) {
            return $this->gambar_upload->temporaryUrl();
        }

        if ($this->gambar_url) {
            return $this->gambar_url;
        }

        return $this->existingImage;
    }
}