<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_articles_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('articles', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->string('slug')->unique();
        $table->string('penulis')->nullable();
        $table->longText('isi');
        $table->text('gambar')->nullable();
        $table->integer('views')->default(0);

        // PASTIKAN BARIS INI ADA KEMBALI
        $table->date('tanggal')->nullable();

        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};