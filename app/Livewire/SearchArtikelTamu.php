<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class SearchArtikelTamu extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public $search = '';
    public $viewMode = 'grid'; // <-- TAMBAHKAN BARIS INI

    #[Url(as: 'kategori')]
    public $kategori = ''; 

    public function filterKategori($kategori)
    {
        $this->kategori = ($this->kategori == $kategori) ? '' : $kategori;
        $this->resetPage();
    }

    public function render()
    {
        $query = Article::query();

        if ($this->kategori) {
            $query->where('kategori', $this->kategori);
        }
        
        if ($this->search) {
            $query->where('judul', 'like', '%' . $this->search . '%');
        }

        $articles = $query->latest()->paginate(9);

        return view('livewire.search-artikel-tamu', [
            'articles' => $articles
        ]);
    }
}