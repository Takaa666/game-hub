<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class display extends Model
{
    use HasFactory;
    protected $table = 'display';
    protected $primaryKey = 'id_display';
    protected $guarded = [];
    public $timestamps = true;
    protected $fillable = [
        'gambar_display', 'id_game'
    ];
}
