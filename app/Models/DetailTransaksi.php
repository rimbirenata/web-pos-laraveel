<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';

    protected $primaryKey = 'id_detail_transaksi'; // SESUAI DB
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_transaksi',
        'id_barang',
        'jumlah',
        'harga_saat_beli',
        'subtotal'
    ];

    public $timestamps = false; // kalau tabel tidak punya created_at
}
