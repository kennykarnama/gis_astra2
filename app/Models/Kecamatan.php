<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    //
     protected $table = 'kecamatan';

    protected $primaryKey = 'id_kecamatan';

	public $timestamps = false;

    protected $fillable = [
        'nama_kecamatan',
        'luas_wilayah_km2',
        'lat',
        'lng',
        'is_aktif',
        'place_id',
        'icon'
    ];

    protected $guarded = [];
}
