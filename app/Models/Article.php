<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Import facade Str untuk membuat slug

class Article extends Model
{
    use HasFactory;

    /**
     * Atribut yang boleh diisi secara massal.
     */
    protected $fillable = [
        'judul',
        'slug', // Pastikan 'slug' ditambahkan di sini
        'penulis',
        'isi',
        'gambar',
        'tanggal',
    ];

    /**
     * Method ini berjalan otomatis saat model diinisialisasi.
     * Kita gunakan untuk mendaftarkan event 'saving'.
     */
    protected static function booted(): void
    {
        // Event 'saving' akan berjalan setiap kali data akan disimpan (baik create maupun update)
        static::saving(function (Article $article) {
            // Hanya buat ulang slug jika judulnya berubah atau saat membuat artikel baru
            if ($article->isDirty('judul') || !$article->exists) {
                $article->slug = self::createUniqueSlug($article->judul, $article->id);
            }
        });
    }

    /**
     * Fungsi pribadi untuk membuat slug yang unik.
     *
     * @param string $title Judul artikel.
     * @param int|null $exceptId ID artikel saat ini (untuk diabaikan saat update).
     * @return string Slug yang unik.
     */
    private static function createUniqueSlug(string $title, int $exceptId = null): string
    {
        $slug = Str::slug($title, '-');
        $originalSlug = $slug;
        $counter = 1;

        // Terus looping selama slug sudah ada di database
        while (self::isSlugExists($slug, $exceptId)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Fungsi pembantu untuk mengecek keberadaan slug.
     */
    private static function isSlugExists(string $slug, int $exceptId = null): bool
    {
        $query = self::where('slug', '=', $slug);

        if ($exceptId !== null) {
            $query->where('id', '!=', $exceptId);
        }

        return $query->exists();
    }
}