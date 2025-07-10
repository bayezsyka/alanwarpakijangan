<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rutinan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_acara',
        'pengisi',
        'kitab',
        'isi',
        'tempat',
        'waktu',
        'day_of_week',
    ];

    /**
     * Selalu muat relasi 'exceptions' setiap kali memanggil data Rutinan.
     */
    protected $with = ['exceptions'];

    /**
     * Mendefinisikan relasi ke jadwal libur (exceptions).
     */
    public function exceptions(): HasMany
    {
        return $this->hasMany(RutinanException::class);
    }
}