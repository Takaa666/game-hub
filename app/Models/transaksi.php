<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $guarded = [];
    public $timestamps = true;
    protected $fillable = [
        'id_user', 'id_game', 'bukti_transfer', 'total', 'status' , 'harga'
    ];
}
