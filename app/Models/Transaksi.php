<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $timestamps = false;

    // ❌ HAPUS SEMUA INI
    // public $incrementing = false;
    // protected $keyType = 'string';

    protected $fillable = [
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
            DetailTransaksi::class,
            'id_transaksi',
            'id_transaksi'
        );
    }
}
