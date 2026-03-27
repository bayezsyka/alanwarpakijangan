<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ArticleManagementTable extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'c')]
    public string $category = '';

    #[Url(as: 's')]
    public string $status = '';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingCategory() { $this->resetPage(); }
    public function updatingStatus() { $this->resetPage(); }

    public function render()
    {
        $query = Article::query()->with(['category', 'user']);

        // Check if user is Admin or Penulis
        if (!Auth::user()->isAdmin()) {
            $query->where('user_id', Auth::id());
        }

        if ($this->search) {
            $query->where(function($q) {
                $q->where('judul', 'like', '%' . $this->search . '%')
                  ->orWhere('penulis', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->category) {
            $query->where('category_id', $this->category);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $articles = $query->latest()->paginate(10);
        $categories = Category::orderBy('name')->get();

        return view('livewire.article-management-table', [
            'articles' => $articles,
            'categories' => $categories,
            'is_admin' => Auth::user()->isAdmin(),
        ]);
    }

    public function updateStatus($id, $newStatus)
    {
        $article = Article::find($id);

        if ($article) {
            // Check authorization
            if (!Auth::user()->isAdmin() && $article->user_id !== Auth::id()) {
                return;
            }

            if (in_array($newStatus, ['published', 'draft', 'archived'])) {
                $article->update(['status' => $newStatus]);
                $this->dispatch('status-updated', 'Status artikel berhasil diperbarui.');
            }
        }
    }

    #[On('delete-artikel')]
    public function delete($id)
    {
        $article = Article::find($id);

        if ($article) {
            // Check authorization
            if (!Auth::user()->isAdmin() && $article->user_id !== Auth::id()) {
                return;
            }

            if ($article->gambar && !str_starts_with($article->gambar, 'http')) {
                Storage::disk('public')->delete($article->gambar);
            }
            $article->delete();
            $this->dispatch('article-deleted', 'Artikel berhasil dihapus.');
        }
    }
}
