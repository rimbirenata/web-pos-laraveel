<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::truncate();

        User::create([
            'nama' => 'Rimbi',
            'username' => 'rimbi',
            'password' => Hash::make('rimbi12'),
        ]);

        User::create([
            'nama' => 'Amelia',
            'username' => 'amelia',
            'password' => Hash::make('amelia'),
        ]);
    }
}
