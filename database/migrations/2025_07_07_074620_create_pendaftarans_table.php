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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();

            // Data Diri Santri
            $table->string('nama_lengkap');
            $table->string('nik', 16)->unique();
            $table->string('nisn', 10)->nullable();
            $table->string('nomor_wa');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            
            // Data Orang Tua
            $table->string('nama_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('telepon_ayah');
            $table->string('nama_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('telepon_ibu');
            
            // Data Wali (Opsional, jadi boleh kosong)
            $table->string('nama_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('telepon_wali')->nullable();
            $table->string('hubungan_wali')->nullable();

            // Riwayat Pendidikan & Berkas
            $table->string('asal_sekolah');
            $table->year('tahun_lulus');
            $table->string('foto_santri'); // Akan berisi path file
            $table->string('scan_kk');     // Akan berisi path file
            $table->string('scan_ijazah');// Akan berisi path file

            // Status Pendaftaran
            $table->string('status')->default('pending'); // Contoh: pending, diterima, ditolak

            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};