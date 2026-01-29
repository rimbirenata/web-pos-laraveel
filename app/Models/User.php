<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user';          
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'nama_lengkap'
    ];

    protected $hidden = [
        'password',
    ];

    // 🔥 TAMBAHAN WAJIB
    public function getAuthIdentifierName()
    {
        return 'id_user';
    }
}
