<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class CreatePermohonanSurat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 1. Ambil SEMUA ID yang ada dari tabel Warga dan JenisSurat
        $wargaIds = DB::table('warga')->pluck('warga_id');
        $jenisIds = DB::table('jenis_surat')->pluck('jenis_id');

        // 2. Cek apakah data sudah ada
        if ($wargaIds->isEmpty() || $jenisIds->isEmpty()) {
            $this->command->error('Tabel Warga atau JenisSurat masih kosong.');
            $this->command->error('Silakan jalankan seeder untuk Warga dan JenisSurat terlebih dahulu.');
            return;
        }

        $statuses = ['DRAFT', 'DIAJUKAN', 'DIPROSES', 'DITOLAK', 'SELESAI', 'DIAMBIL'];
        $data = [];

        // 3. Buat 100 data permohonan dummy
        for ($i = 0; $i < 100; $i++) {
            $lastId = DB::table('permohonan_surat')->max('permohonan_id') ?? 0;
            $nomorPermohonan = 'PMH-' . date('Ymd') . '-' . str_pad($lastId + $i + 1, 3, '0', STR_PAD_LEFT);

            $data[] = [
                'nomor_permohonan' => $nomorPermohonan,
                'warga_id' => $faker->randomElement($wargaIds),
                'jenis_surat_id' => $faker->randomElement($jenisIds),
                'tanggal_pengajuan' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'status' => $faker->randomElement($statuses),
                'catatan' => $faker->boolean(70) ? $faker->sentence : null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('permohonan_surat')->insert($data);
    }
}
