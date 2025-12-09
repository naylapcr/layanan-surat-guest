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
                'no_ktp' => $faker->numerify('32###############'),
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement($jenisKelamin),
                'agama' => $faker->randomElement($agama),
                'pekerjaan' => $faker->randomElement($pekerjaan),
                'telp' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
            ]);
        }
    }
}
