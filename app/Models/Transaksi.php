<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_transaksi',
        'id_pelanggan',
        'tanggal_transaksi',
        'total_bayar',
        'jumlah_bayar',
        'total_keuntungan',
        'kembalian'
    ];

     public function detailTransaksi()
    {
        return $this->hasMany(
            Transaksi::class,
            'id_transaksi',
            'id_transaksi'
        );
    }
}
