<?php
// LOKASI: database/migrations/xxxx_modify_articles_for_categories.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // <-- Import DB facade

return new class extends Migration {
    public function up(): void {
        Schema::table('articles', function (Blueprint $table) {
            // 1. Tambah kolom baru, buat nullable dulu agar tidak error
            $table->foreignId('category_id')->nullable()->after('id')->constrained('categories');
        });

        // 2. Migrasi data dari kolom lama ke baru
        // Cari ID untuk "Artikel"
        $artikelCategoryId = DB::table('categories')->where('slug', 'artikel')->value('id');
        if ($artikelCategoryId) {
            DB::table('articles')->where('kategori', 'Artikel')->update(['category_id' => $artikelCategoryId]);
        }

        // Cari ID untuk "Opini"
        $opiniCategoryId = DB::table('categories')->where('slug', 'opini')->value('id');
        if ($opiniCategoryId) {
            DB::table('articles')->where('kategori', 'Opini')->update(['category_id' => $opiniCategoryId]);
        }

        // 3. Hapus kolom 'kategori' yang lama
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }

    public function down(): void {
        // Logika untuk mengembalikan jika di-rollback
        Schema::table('articles', function (Blueprint $table) {
            $table->string('kategori')->default('Artikel')->after('penulis');
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};