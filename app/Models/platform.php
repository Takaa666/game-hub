<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class platform extends Model
{
    use HasFactory;
    protected $table = 'platform';
    protected $primaryKey = 'id_platform';
    protected $guarded = [];
    public $timestamps = true
    ;
}
