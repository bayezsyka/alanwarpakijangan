<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class SearchArtikelAdmin extends Component
{
    use WithPagination;

    #[Url(as: 'q')] // Menyimpan query di URL dengan nama "q"
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

        $articles = $query->orderBy('tanggal', 'desc')->paginate(9); // Ubah paginasi jika perlu

        return view('livewire.search-artikel-admin', [
            'articles' => $articles,
        ]);
    }
}