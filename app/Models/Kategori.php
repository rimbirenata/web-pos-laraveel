<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori'; // 🔥 WAJIB
    public $timestamps = false;

    protected $fillable = ['nama_kategori'];

    public function barang()
    {
        return $this->hasMany(
            \App\Models\Barang::class,
            'id_kategori',      // FK di tabel barang
            'id_kategori'       // PK di tabel kategori
        );
    }
}
