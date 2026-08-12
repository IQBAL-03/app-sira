<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'nik' => '1234567890123456',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '085801214341',
            'address' => 'Rt 06 / Rw 07',
            'role' => 'admin',
            'is_verified' => true,
            'password' => Hash::make('Admin123')
        ]);

        // Warga - Rin
        User::create([
            'nik' => '3276051234567890',
            'name' => 'Rin',
            'email' => 'rin@gmail.com',
            'phone' => '081234567890',
            'address' => 'Rt 01 / Rw 03',
            'role' => 'warga',
            'is_verified' => true,
            'password' => Hash::make('Rin12345')
        ]);
    }
}
