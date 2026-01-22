<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::create([
            'name'=>'Admin',
            'role'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=> bcrypt('password')
        ]);

        $petugas = \App\Models\User::create([
            'name'=>'Sample Petugas',
            'role'=>'petugas',
            'email'=>'petugas@gmail.com',
            'password'=> bcrypt('password')
        ]);
    }
}
