<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat User Admin Utama (Role: super_admin)
        User::create([
            'name' => 'Admin',
            'email' => 'faqih@email.com',
            'password' => Hash::make('faqih123'),
            'role' => 'super_admin', // Pastikan role ini ada
        ]);

        // 2. Buat 100 Dummy User (Role: guest)
        // Menggunakan factory lebih rapi daripada looping manual
        User::factory(100)->create([
            'role' => 'guest',
            'password' => Hash::make('password123'), // Password default untuk dummy
        ]);
    }
}
