<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleResource extends JsonResource
{
    /**
     * Ubah bentuk data artikel jadi JSON yang rapi untuk API.
     */
    public function toArray($request)
    {
        // Handle URL gambar
        $imageUrl = null;

        if ($this->gambar) {
            if (Str::startsWith($this->gambar, ['http://', 'https://'])) {
                // Kalau di database sudah berupa full URL
                $imageUrl = $this->gambar;
            } else {
                // Kalau cuma path di storage (misal: "artikel-images/xxx.jpg")
                // Pastikan sudah menjalankan: php artisan storage:link
                $imageUrl = asset('storage/' . ltrim($this->gambar, '/'));
                // Atau bisa juga pakai:
                // $imageUrl = Storage::url($this->gambar);
            }
        }

        return [
            'id'        => $this->id,
            'title'     => $this->judul,
            'slug'      => $this->slug,
            'content'   => $this->isi,
            'excerpt'   => Str::limit(strip_tags($this->isi), 160),
            'image_url' => $imageUrl,
            'category'  => $this->whenLoaded('category', function () {
                return [
                    'id'   => $this->category->id,
                    'name' => $this->category->name,
                ];
            }),
            'author'    => $this->whenLoaded('user', function () {
                return [
                    'id'   => $this->user->id,
                    'name' => $this->user->name,
                ];
            }),
            'date'      => optional($this->created_at)->format('Y-m-d'),
            'views'     => $this->views,
        ];
    }
}
