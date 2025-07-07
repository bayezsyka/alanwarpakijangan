<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans';
    public $incrementing = false; // Karena kita menggunakan ID kustom
    protected $keyType = 'string'; // ID kita bisa dianggap string karena panjang

    /**
     * Pastikan semua nama input dari form ada di sini.
     */
    protected $fillable = [
        'id', 'nama_lengkap', 'nik', 'nisn', 'nomor_wa', 'jenis_kelamin', 
        'tempat_lahir', 'tanggal_lahir', 'alamat', 'nama_ayah', 'pekerjaan_ayah', 
        'telepon_ayah', 'nama_ibu', 'pekerjaan_ibu', 'telepon_ibu', 'nama_wali', 
        'pekerjaan_wali', 'telepon_wali', 'hubungan_wali', 'asal_sekolah', 
        'tahun_lulus', 'foto_santri', 'scan_kk', 'scan_ijazah', 'status',
    ];

    protected static function booted(): void
    {
        static::creating(function (Pendaftaran $pendaftaran) {
            if (empty($pendaftaran->id)) {
                $pendaftaran->id = self::generateUniquePendaftaranId();
            }
        });
    }

    private static function generateUniquePendaftaranId(): string
    {
        $today = Carbon::today();
        $datePrefix = $today->format('Ymd');
        $latestToday = self::where('id', 'like', $datePrefix . '%')->orderBy('id', 'desc')->first();
        $sequence = 1;
        if ($latestToday) {
            $lastSequence = (int) substr($latestToday->id, -2);
            $sequence = $lastSequence + 1;
        }
        return $datePrefix . str_pad($sequence, 2, '0', STR_PAD_LEFT);
    }
}