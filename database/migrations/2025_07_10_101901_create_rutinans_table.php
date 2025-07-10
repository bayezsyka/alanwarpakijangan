<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rutinans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_acara');
            $table->string('pengisi')->nullable();
            $table->string('kitab')->nullable();
            $table->text('isi')->nullable();
            $table->string('tempat');
            $table->time('waktu'); // Tipe TIME untuk menyimpan jam (e.g., 20:30:00)
            $table->integer('day_of_week'); // Menyimpan hari sebagai angka (0=Minggu, 1=Senin, ..., 6=Sabtu)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rutinans');
    }
};