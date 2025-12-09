<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');          // subjek / judul
            $table->string('image_path');     // path file gambar
            $table->string('link')->nullable(); // link opsional
            $table->date('start_date');       // tanggal mulai tayang
            $table->date('end_date');         // tanggal selesai tayang
            $table->boolean('is_active')->default(true); // bisa dimatiin tanpa hapus
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
