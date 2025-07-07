<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     * Opsional jika nama tabel adalah bentuk jamak dari nama model (pendaftarans).
     */
    protected $table = 'pendaftarans';

    /**
     * Atribut yang boleh diisi secara massal.
     */
    protected $fillable = [
        'nama_lengkap',
        'nik',
        'nisn',
        'nomor_wa',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'nama_ayah',
        'pekerjaan_ayah',
        'telepon_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'telepon_ibu',
        'nama_wali',
        'pekerjaan_wali',
        'telepon_wali',
        'hubungan_wali',
        'asal_sekolah',
        'tahun_lulus',
        'foto_santri',
        'scan_kk',
        'scan_ijazah',
        'status',
    ];
}