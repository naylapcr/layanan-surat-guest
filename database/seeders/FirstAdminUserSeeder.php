<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Warga; // Import model Warga
use App\Models\User; // Import model User
use Illuminate\Support\Carbon; // Opsional untuk timestamp

class FirstAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat data Warga untuk Admin
        $adminWarga = Warga::create([
            'no_ktp' => '3201010000000001',
            'nama' => 'Admin Sistem',
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'pekerjaan' => 'Administrator',
            'telp' => '081234567890',
            'email' => 'admin@mail.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // 2. Buat data User (Admin) dan hubungkan ke Warga (wajib)
        User::create([
            'warga_id' => $adminWarga->warga_id, // Kunci asing ke tabel Warga
            'name' => 'Admin Sistem',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin123'), // Password default: 'admin123'
            'role' => 'admin',
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
