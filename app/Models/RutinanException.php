<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RutinanException extends Model
{
    use HasFactory;

    protected $fillable = [
        'rutinan_id',
        'libur_date',
    ];

    public function rutinan()
    {
        return $this->belongsTo(Rutinan::class);
    }
}
