<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    // Izinkan mass assignment untuk kolom ini
    protected $fillable = ['ip_address'];
}
