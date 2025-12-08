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
            // HANYA tambahkan kolom user_id kalau belum ada
            if (! Schema::hasColumn('articles', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');

                // Kalau mau, bisa tambahkan foreign key di sini
                // $table->foreign('user_id')
                //     ->references('id')->on('users')
                //     ->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Di sini kita aman-aman aja: kalau kolom ada, baru di-drop
            if (Schema::hasColumn('articles', 'user_id')) {
                // Kalau kamu sebelumnya TIDAK menambahkan foreign key di up(), ya jangan dropForeign
                // Kalau memang menambahkan foreign key, bisa pakai:
                // $table->dropForeign(['user_id']);

                // Untuk amannya, sekarang cukup drop kolom saja
                $table->dropColumn('user_id');
            }
        });
    }
};
