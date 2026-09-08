<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin SiLaporin',
            'email' => 'admin@silaporin.com',
            'password' => Hash::make('password'),
            'role' => 'Admin',
            'kelas' => null,
            'no_hp' => '08123456789',
        ]);

        // Siswa 1
        User::create([
            'name' => 'Christian Wardana',
            'email' => 'christian@student.com',
            'password' => Hash::make('password'),
            'role' => 'Siswa',
            'kelas' => 'XII RPL',
            'no_hp' => '08123456788',
        ]);

        // Siswa 2
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@student.com',
            'password' => Hash::make('password'),
            'role' => 'Siswa',
            'kelas' => 'XII RPL',
            'no_hp' => '08123456787',
        ]);

        // Siswa 3
        User::create([
            'name' => 'Siti Rahayu',
            'email' => 'siti@student.com',
            'password' => Hash::make('password'),
            'role' => 'Siswa',
            'kelas' => 'XII RPL',
            'no_hp' => '08123456786',
        ]);
    }
}