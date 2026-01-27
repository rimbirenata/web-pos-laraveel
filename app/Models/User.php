<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user'; // karena tabel kamu "user"

    protected $fillable = [
        'nama',
        'username',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    public $timestamps = false;
}
