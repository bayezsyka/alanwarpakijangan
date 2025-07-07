<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Menambahkan kolom 'views' setelah kolom 'tanggal'
            // Tipe: unsignedInteger (angka positif) dengan nilai default 0
            $table->unsignedInteger('views')->default(0)->after('tanggal');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('views');
        });
    }
};