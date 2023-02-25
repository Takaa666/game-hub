<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class game extends Model
{
    use HasFactory;
    protected $table = 'game';
    protected $primaryKey = 'id_game';
    protected $guarded = [];
    public $timestamps = true;
    protected $fillable = [
        'id_developer', 'nama_game', 'deskripsi', 'id_platform', 'id_genre', 'harga', 'diskon','gambar_sampul', 'gambar_detail' , 'status'
    ];

    public function komentar(){
        return $this->hasMany(komentar::class, 'id_game');
        }
    
    public function genre()
    {
        return $this->belongsTo(genre::class, 'id_genre');
    }

    public function platform()
    {
        return $this->belongsTo(platform::class, 'id_platform');
    }

    public function Developer()
    {
        return $this->belongsTo(Developer::class, 'id_developer');
    }



}
