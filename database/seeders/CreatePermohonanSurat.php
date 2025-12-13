<?php

namespace Database\Seeders;

use App\Models\PermohonanSurat;
use App\Models\JenisSurat;
use App\Models\Warga;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; // Jangan lupa import Schema

class CreatePermohonanSurat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil ID yang valid untuk referensi
        // Kita ambil 'warga_id' dan 'jenis_id' karena itu Primary Key di tabel induknya
        $wargaIds = Warga::pluck('warga_id')->toArray();
        $jenisSuratIds = JenisSurat::pluck('jenis_id')->toArray();

        // Pastikan tabel induk tidak kosong
        if (empty($wargaIds) || empty($jenisSuratIds)) {
            $this->command->error('Tabel warga atau jenis_surat masih kosong. Jalankan seeder Warga dan JenisSurat terlebih dahulu.');
            return;
        }

        // Matikan pengecekan FK sementara agar bisa truncate (kosongkan tabel)
        Schema::disableForeignKeyConstraints();
        DB::table('permohonan_surat')->truncate();
        Schema::enableForeignKeyConstraints();

        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $tanggal = $faker->dateTimeBetween('-1 year', 'now');

            $data[] = [
                'nomor_permohonan' => 'PMH-' . $tanggal->format('Ymd') . '-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),

                // PERBAIKAN: Gunakan nama kolom yang sesuai dengan migrasi temanmu
                'pemohon_warga_id' => $faker->randomElement($wargaIds), // Sebelumnya 'warga_id'
                'jenis_id'         => $faker->randomElement($jenisSuratIds), // Sebelumnya 'jenis_surat_id'

                'tanggal_pengajuan' => $tanggal->format('Y-m-d'),
                'status'            => $faker->randomElement(['DRAFT', 'DIAJUKAN', 'DIPROSES', 'SELESAI', 'DIAMBIL', 'DITOLAK']),
                'catatan'           => $faker->sentence(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ];

            // Insert per 50 data agar lebih ringan
            if (count($data) >= 50) {
                DB::table('permohonan_surat')->insert($data);
                $data = [];
            }
        }

        // Insert sisa data
        if (!empty($data)) {
            DB::table('permohonan_surat')->insert($data);
        }
    }
}
