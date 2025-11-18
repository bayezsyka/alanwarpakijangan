<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'judul' => $this->faker->unique()->sentence(4),
            'penulis' => $this->faker->name(),
            'isi' => collect(range(1, 3))->map(fn () => $this->faker->paragraph())->implode("\n\n"),
            'gambar' => $this->faker->imageUrl(),
            'views' => 0,
        ];
    }
}
