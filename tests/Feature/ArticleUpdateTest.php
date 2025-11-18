<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_slug_remains_unchanged_when_updating_article_without_title_change(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $firstArticle = Article::factory()->for($category)->create([
            'judul' => 'Judul Sama',
        ]);

        $secondArticle = Article::factory()->for($category)->create([
            'judul' => 'Judul Sama',
        ]);

        $originalSlug = $secondArticle->slug;

        $this->actingAs($user);

        $response = $this->patch(route('admin.artikel.update', $secondArticle), [
            'judul' => 'Judul Sama',
            'penulis' => 'Penulis Diperbarui',
            'isi' => 'Konten terbaru yang diperbarui.',
            'category_id' => $category->id,
        ]);

        $response->assertRedirect(route('admin.artikel.index'));

        $this->assertDatabaseHas('articles', [
            'id' => $secondArticle->id,
            'slug' => $originalSlug,
            'penulis' => 'Penulis Diperbarui',
        ]);

        $this->assertDatabaseHas('articles', [
            'id' => $firstArticle->id,
            'slug' => $firstArticle->slug,
        ]);
    }
}
