<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Mengubah kolom 'gambar' dari VARCHAR menjadi TEXT
            // TEXT dapat menampung URL yang sangat panjang
            $table->text('gambar')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Mengembalikan ke string(255) jika migrasi di-rollback
            $table->string('gambar')->nullable()->change();
        });
    }
};