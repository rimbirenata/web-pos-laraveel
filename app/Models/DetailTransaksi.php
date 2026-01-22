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
        'subtotal',
        'jumlah_beli',
        'harga_saat_beli',
        'keuntungan_item',
    ];

    public function transaksi()
{
    return $this->belongsTo(Transaksi::class, 'id_transaksi');
}

public function barang()
{
    return $this->belongsTo(Barang::class, 'id_barang');
}

}
