<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        // Buat akun admin
        User::create([
            'name' => 'Admin Utama',
            'email' => 'rapermatahati@gmail.com',
            'nomor_telepon' => '085777757471',
            'password' => Hash::make('Permatahati123'),
            'role' => 'admin',
        ]);

    }
}
