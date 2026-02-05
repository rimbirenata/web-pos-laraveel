<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    protected $table = 'suplier';
    protected $primaryKey = 'id_suplier';
    public $timestamps = false;

    protected $fillable = [
        'nama_suplier',
        'alamat',
        'no_hp'
    ];

    // 🔗 RELASI: 1 supplier punya banyak barang
    public function barang()
    {
        return $this->hasMany(Barang::class, 'suplier_id', 'id_suplier');
    }
}
