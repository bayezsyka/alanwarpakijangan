<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout; // Import Layout jika menggunakan layout khusus 

#[Layout('layouts.public')] // <-- 2. TAMBAHKAN ATRIBUT INI
class ArticleList extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public $search = '';

    #[Url(as: 'kategori')]
    public $kategori = ''; // Properti untuk menyimpan kategori aktif

    public function filterKategori($kategori)
    {
        // Jika kategori yang sama diklik lagi, reset filter
        $this->kategori = ($this->kategori == $kategori) ? '' : $kategori;
        $this->resetPage(); // Reset paginasi setiap kali filter berubah
    }

    public function render()
    {
        $query = Article::query();

        // Filter berdasarkan kategori jika ada
        if ($this->kategori) {
            $query->where('kategori', $this->kategori);
        }
        
        // Filter berdasarkan pencarian jika ada
        if ($this->search) {
            $query->where('judul', 'like', '%' . $this->search . '%');
        }

        $articles = $query->latest()->paginate(9);

        return view('livewire.article-list', [
            'articles' => $articles
        ]);
    }
}