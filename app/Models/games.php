<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class games extends Model
{
    use HasFactory;
    protected $table = 'game';
    protected $fillable = [
        'id_developer', 'nama_game', 'deskripsi', 'id_platform', 'id_genre', 'harga', 'gambar_sampul', 'gambar_detail','rating','status'
        ];
}
