<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Deyay',
            'nim' => '2307063',
            'email' => 'nandadwijayantidea02@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Mahasiswa'
        ]);

        User::create([
            'name' => 'Bimz',
            'nim' => '2205036',
            'email' => 'bimagaminh@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Dosen'
        ]);

        User::create([
            'name' => 'Admin',
            'nim' => '1234567',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Admin'
        ]);
    }
}
