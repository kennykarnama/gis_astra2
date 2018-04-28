<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    //
     protected $table = 'kelurahan';

    protected $primaryKey = 'id_kelurahan';

	public $timestamps = false;

    protected $fillable = [
        'nama_kelurahan',
        'id_kecamatan',
        'lat',
        'lng',
        'is_aktif'
        
    ];

    protected $guarded = [];
}
