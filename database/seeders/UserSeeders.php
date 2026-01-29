<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::truncate();

        User::create([
            'nama' => 'kasir',
            'username' => 'kasir',
            'password' => Hash::make('kasir'),
        ]);
    }
}
