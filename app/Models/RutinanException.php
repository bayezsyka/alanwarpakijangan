<?php
// LOKASI: app/Models/RutinanException.php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RutinanException extends Model
{
    use HasFactory;
    protected $fillable = ['rutinan_id', 'libur_date'];
}