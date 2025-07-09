<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\On; // Pastikan ini di-import
use Illuminate\Support\Facades\Storage;

class SearchArtikelAdmin extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

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
        ]);
    }

    // <-- TAMBAHKAN ATTRIBUTE LISTENER INI
    #[On('delete-artikel')] 
    public function deleteArtikel($id)
    {
        $article = Article::find($id);

        if ($article) {
            // Hapus gambar jika ada
            if ($article->gambar && Storage::disk('public')->exists($article->gambar)) {
                Storage::disk('public')->delete($article->gambar);
            }
            
            $article->delete();
            
            // Kirim pesan sukses kembali ke browser untuk ditampilkan oleh SweetAlert
            $this->dispatch('article-deleted', 'Artikel berhasil dihapus.');
        }
    }
}