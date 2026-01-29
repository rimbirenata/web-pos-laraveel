<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TokoSeeder extends Seeder
{
    public function run()
    {
        DB::table('toko')->insert([
            'nama_toko' => 'Toko Saya',
            'alamat' => 'Jl. Contoh No. 1, Kota Contoh',
            'telp' => '081234567890',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
