<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';

    // PENTING supaya findOrFail TIDAK 404
    protected $primaryKey = 'id_pelanggan';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'id_pelanggan',
        'nama_pelanggan',
        'no_hp',
        'alamat'
    ];

    public $timestamps = false;
}
