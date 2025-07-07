<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon; // <-- TAMBAHKAN INI

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans';

    /**
     * Kita tidak lagi mengisi 'id' secara manual, jadi hapus dari $fillable.
     * Laravel akan menanganinya.
     */
    protected $fillable = [
        'nama_lengkap', 'nik', 'nisn', 'nomor_wa', 'jenis_kelamin', 'tempat_lahir',
        'tanggal_lahir', 'alamat', 'nama_ayah', 'pekerjaan_ayah', 'telepon_ayah',
        'nama_ibu', 'pekerjaan_ibu', 'telepon_ibu', 'nama_wali', 'pekerjaan_wali',
        'telepon_wali', 'hubungan_wali', 'asal_sekolah', 'tahun_lulus', 'foto_santri',
        'scan_kk', 'scan_ijazah', 'status',
    ];

    /**
     * ### BAGIAN BARU UNTUK MEMBUAT ID KUSTOM ###
     * Method ini akan berjalan secara otomatis saat model diinisialisasi.
     */
    protected static function booted(): void
    {
        // Event 'creating' berjalan tepat sebelum data baru disimpan ke database.
        static::creating(function (Pendaftaran $pendaftaran) {
            // Panggil fungsi untuk generate ID unik
            $pendaftaran->id = self::generateUniquePendaftaranId();
        });
    }

    /**
     * Fungsi untuk membuat ID pendaftaran yang unik dengan format YYYYMMDDXX.
     */
    private static function generateUniquePendaftaranId(): int
    {
        // 1. Dapatkan tanggal hari ini
        $today = Carbon::today();
        $datePrefix = $today->format('Ymd'); // Format: 20250823

        // 2. Cari pendaftar terakhir pada hari yang sama untuk mendapatkan nomor urut
        $latestToday = self::where('id', 'like', $datePrefix . '%')
                           ->orderBy('id', 'desc')
                           ->first();

        $sequence = 1; // Nomor urut default jika belum ada pendaftar hari ini
        if ($latestToday) {
            // Jika sudah ada, ambil 2 digit terakhir dari ID, ubah ke integer, lalu tambah 1
            $lastSequence = (int) substr($latestToday->id, -2);
            $sequence = $lastSequence + 1;
        }

        // 3. Format nomor urut menjadi 2 digit (misal: 1 menjadi "01", 13 menjadi "13")
        $sequencePadded = str_pad($sequence, 2, '0', STR_PAD_LEFT);

        // 4. Gabungkan prefix tanggal dengan nomor urut
        return (int) ($datePrefix . $sequencePadded);
    }
}