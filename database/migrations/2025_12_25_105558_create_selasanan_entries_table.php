<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('selasanan_entries', function (Blueprint $table) {
            $table->id();

            // Judul jurnal (SEO)
            $table->string('title');
            $table->string('slug')->unique();

            // Otomatis tapi bisa override (via "Lebih lanjut")
            $table->string('speaker')->default('KH. Muhammad Miftah');
            $table->date('monday_date');
            $table->time('time_wib')->default('20:00:00');

            // Derived dari monday_date (auto-recompute)
            $table->unsignedSmallInteger('year');
            $table->unsignedTinyInteger('month'); // 1-12
            $table->unsignedTinyInteger('week_of_month'); // 1-5

            // Upload
            $table->string('cover_image_path')->nullable();
            $table->string('audio_path')->nullable();
            $table->string('audio_mime')->nullable();
            $table->unsignedBigInteger('audio_size')->nullable();

            // Isi jurnal (editor sama dengan artikel)
            $table->longText('isi');

            // Kontrol publish
            $table->boolean('is_published')->default(true);

            // Audit
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();

            // Cegah dobel untuk 1 minggu dalam 1 bulan
            $table->unique(['year', 'month', 'week_of_month'], 'selasanan_unique_week');
            $table->index(['year', 'month', 'week_of_month']);
            $table->index('monday_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('selasanan_entries');
    }
};
