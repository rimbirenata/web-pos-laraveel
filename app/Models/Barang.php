<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';

    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'nama_barang',
        'id_kategori',
        'id_suplier',
        'stok',
        'harga_beli',
        'harga_jual'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'id_suplier', 'id_suplier');
    }

    public function isMenipis()
    {
        return $this->stok <= 5;
    }
}
