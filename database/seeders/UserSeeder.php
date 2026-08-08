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
    }
}
