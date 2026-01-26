<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;                     // ← TAMBAH INI
use Illuminate\Support\Facades\Hash;     // ← TAMBAH INI

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'password' => Hash::make('123456'),
            'nama'     => 'Administrator',
        ]);
    }
}
