<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    protected $table = 'suplier';
    protected $primaryKey = 'id_suplier';

    public $timestamps = false; // 🔴 PENTING

    protected $fillable = [
        'nama_suplier',
        'no_hp',
        'alamat'
    ];
}
