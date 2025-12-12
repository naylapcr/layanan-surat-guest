<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateFirstUser extends Seeder
{
    public function run(): void
    {
        // 1. Akun Super Admin Utama
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin123'), // Password mengandung Huruf Besar & Angka
            'role' => 'super_admin',
        ]);

        // 2. Akun Staff Desa
        User::create([
            'name' => 'Staff Kelurahan',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('Staff123'),
            'role' => 'staff',
        ]);

        // 3. Akun Tamu (Guest)
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'guest@gmail.com',
            'password' => Hash::make('Guest123'),
            'role' => 'guest',
        ]);

        // 4. Data Dummy Tambahan (Opsional)
        $users = [
            ['name' => 'Siti Aminah', 'email' => 'siti@example.com', 'role' => 'guest'],
            ['name' => 'Rudi Hartono', 'email' => 'rudi@example.com', 'role' => 'staff'],
            ['name' => 'Dewi Sartika', 'email' => 'dewi@example.com', 'role' => 'guest'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('Password123'),
                'role' => $user['role'],
            ]);
        }
    }
}
