<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class komentar extends Model
{
    use HasFactory;
    protected $table = 'komentar';
    protected $primaryKey = 'id_komentar';
    protected $guarded = [];
    public $timestamps = true;
    protected $fillable = ['id_user', 'id_game', 'komentar'];

    
    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
