<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';
    public $timestamps = false;

    protected $fillable = [
        'id_transaksi',
        'id_barang',
        'jumlah',
        'harga_saat_beli',
        'subtotal'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }
}
