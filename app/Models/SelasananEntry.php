<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelasananEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'speaker',
        'monday_date',
        'time_wib',
        'year',
        'month',
        'week_of_month',
        'cover_image_path',
        'audio_path',
        'audio_mime',
        'audio_size',
        'isi',
        'is_published',
        'created_by',
    ];

    protected $casts = [
        'monday_date' => 'date',
        'is_published' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
