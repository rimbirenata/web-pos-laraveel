<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user';      
    protected $primaryKey = 'id_user'; // primary key sesuai tabel
    public $incrementing = true;      // pastikan auto increment
    public $timestamps = false;       // karena tabel tidak ada created_at/updated_at

    protected $fillable = [
        'name',
        'email',
        'password',
        'foto'
    ];

    
}
