<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::firstOrCreate(
            ['email' => 'admin@kasirsekolah.com'],
            [
                'name' => 'Admin Kasir',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Create Kasir User
        User::firstOrCreate(
            ['email' => 'kasir@kasirsekolah.com'],
            [
                'name' => 'Kasir Utama',
                'password' => Hash::make('kasir123'),
                'role' => 'kasir',
            ]
        );

        // Create Student User (for testing)
        User::firstOrCreate(
            ['email' => 'siswa@kasirsekolah.com'],
            [
                'name' => 'Siswa Test',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
            ]
        );
    }
}
