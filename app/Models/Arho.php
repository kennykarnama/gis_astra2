<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arho extends Model
{
    //
     protected $table = 'arho';

    protected $primaryKey = 'id_arho';

	public $timestamps = false;

    protected $fillable = [
        'nama_lengkap',
        'avatar',
        'warna_arho',
        'is_aktif'
    ];

    protected $guarded = [];
}
