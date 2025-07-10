<?php
// NAMA FILE: xxxx_xx_xx_xxxxxx_create_rutinan_exceptions_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rutinan_exceptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rutinan_id')->constrained()->onDelete('cascade');
            $table->date('libur_date'); // Tanggal spesifik saat rutinan libur
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rutinan_exceptions');
    }
};