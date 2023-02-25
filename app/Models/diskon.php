<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diskon extends Model
{
    use HasFactory;
    protected $table = 'diskons';
    protected $primaryKey = 'id_diskon';
    protected $fillable = [
        'name',
        'jumlah_diskon',
        'expired_at',
        'lastspin_hours'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_diskon')->withTimestamps();
    }
}
