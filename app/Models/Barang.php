<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    public $timestamps = false;

    protected $fillable = [
        'id_barang',
        'nama_barang',
        'stok',
        'harga_beli',
        'harga_jual',
        'id_kategori',
        'id_suplier'
    ];

    // 🔗 RELASI KATEGORI
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // 🔗 RELASI SUPLIER
    public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'id_suplier', 'id_suplier');
    }

    //stok menipis
    public function isMenipis()
    {
        return $this->stok <=5;
    }
}
