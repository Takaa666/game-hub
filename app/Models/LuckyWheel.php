<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuckyWheel extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'jumlah_diskon'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
