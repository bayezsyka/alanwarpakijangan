<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            // ### UBAH BAGIAN INI ###
            // Dari: $table->id();
            // Menjadi:
            $table->bigInteger('id')->primary(); // ID sekarang adalah BIGINT dan primary key

            // Kolom lainnya tetap sama
            $table->string('nama_lengkap');
            $table->string('nik', 16)->unique();
            $table->string('nisn', 10)->nullable();
            $table->string('nomor_wa');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('nama_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('telepon_ayah');
            $table->string('nama_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('telepon_ibu');
            $table->string('nama_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('telepon_wali')->nullable();
            $table->string('hubungan_wali')->nullable();
            $table->string('asal_sekolah');
            $table->year('tahun_lulus');
            $table->string('foto_santri');
            $table->string('scan_kk');
            $table->string('scan_ijazah');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};