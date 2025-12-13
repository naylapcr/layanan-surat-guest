<?php

namespace Database\Seeders;

use App\Models\Warga;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateWarga extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $jenisKelamin = ['L', 'P'];
        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        $pekerjaan = ['PNS', 'Karyawan Swasta', 'Wiraswasta', 'Petani', 'Nelayan', 'Guru', 'Dokter', 'Perawat', 'Pedagang', 'Buruh'];

        for ($i = 0; $i < 100; $i++) {
            Warga::create([
                // Pastikan nama kolom ini sesuai dengan database (no_ktp atau nik)
                // Berdasarkan error log kamu, namanya adalah 'no_ktp'
                'no_ktp' => $faker->numerify('32###############'),

                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement($jenisKelamin),
                'agama' => $faker->randomElement($agama),
                'pekerjaan' => $faker->randomElement($pekerjaan),

                // PERBAIKAN DI SINI:
                // Menggunakan numerify agar hanya angka dan panjangnya aman (12-13 digit)
                'telp' => $faker->numerify('08##########'),

                'email' => $faker->unique()->safeEmail,
            ]);
        }
    }
}
