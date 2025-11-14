<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Wajib: Menggunakan DB::table
use Faker\Factory as Faker; // Wajib: Menggunakan Faker
use Illuminate\Support\Carbon;

class PermohonanSuratDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // --- 1. Seed Jenis Surat (Data Master) ---
        // Karena ini data master, lebih baik langsung diinsert
        $jenisSuratData = [
            ['kode' => 'SKU', 'nama_jenis' => 'Surat Keterangan Usaha', 'syarat_json' => '{"syarat":["Fotokopi KTP","Fotokopi KK"]}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['kode' => 'SKD', 'nama_jenis' => 'Surat Keterangan Domisili', 'syarat_json' => '{"syarat":["Fotokopi KTP","PBB Terbaru"]}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['kode' => 'SKBM', 'nama_jenis' => 'Surat Keterangan Belum Menikah', 'syarat_json' => '{"syarat":["Fotokopi KTP","Surat Pengantar RT/RW"]}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['kode' => 'SKCK', 'nama_jenis' => 'Surat Pengantar SKCK', 'syarat_json' => '{"syarat":["Fotokopi KTP","Foto 4x6"]}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        ];

        DB::table('jenis_surat')->insert($jenisSuratData);

        // Ambil semua ID Jenis Surat yang sudah di-seed
        $jenisIds = DB::table('jenis_surat')->pluck('jenis_id')->toArray();

        // --- 2. Seed Warga (20 data dummy) ---
        $wargaIds = [];
        $wargaData = [];
        for ($i = 0; $i < 20; $i++) {
            $gender = $faker->randomElement(['Laki-laki', 'Perempuan']);
            $wargaData[] = [
                'no_ktp' => $faker->unique()->numerify('################'),
                'nama' => $faker->firstName($gender == 'Laki-laki' ? 'male' : 'female') . ' ' . $faker->lastName,
                'jenis_kelamin' => $gender,
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'pekerjaan' => $faker->jobTitle,
                'telp' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('warga')->insert($wargaData);

        // Ambil semua ID Warga, termasuk Admin yang dibuat di seeder sebelumnya
        $wargaIds = DB::table('warga')->pluck('warga_id')->toArray();


        // --- 3. Seed Permohonan Surat (Data Berelasi: 15 data dummy) ---
        $permohonanData = [];
        $statuses = ['DIAJUKAN', 'DIPROSES', 'DITOLAK', 'SELESAI'];
        for ($i = 0; $i < 15; $i++) {
            $status = $faker->randomElement($statuses);

            $permohonanData[] = [
                'nomor_permohonan' => 'PS/' . date('Ymd') . '/' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'pemohon_warga_id' => $faker->randomElement($wargaIds), // Kunci asing ke warga
                'jenis_id' => $faker->randomElement($jenisIds), // Kunci asing ke jenis_surat
                'tanggal_pengajuan' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'status' => $status,
                'catatan' => ($status === 'DITOLAK' || $status === 'DIPROSES') ? $faker->sentence : null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('permohonan_surat')->insert($permohonanData);
    }
}
