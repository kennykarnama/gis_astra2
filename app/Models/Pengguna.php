<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use DB;


class Pengguna extends Model implements Authenticatable
{
    //
    use AuthenticableTrait;

    protected $table = 'pengguna';

    protected $primaryKey = 'id_user';

	public $timestamps = false;

    protected $fillable = [
        'id_role',
        'username',
        'email',
        'password'
    ];

    protected $guarded = [];

    public function getAuthPassword() {
        return $this->password;
    }
}
