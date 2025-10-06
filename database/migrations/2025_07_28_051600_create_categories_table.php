<?php
// LOKASI: database/migrations/xxxx_create_categories_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category; // <-- Import model

return new class extends Migration {
    public function up(): void {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // Langsung isi dengan kategori dasar
        Category::create(['name' => 'Artikel', 'slug' => 'artikel']);
        Category::create(['name' => 'Opini', 'slug' => 'opini']);
    }

    public function down(): void {
        Schema::dropIfExists('categories');
    }
};