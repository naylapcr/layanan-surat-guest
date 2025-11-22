<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class CreateJenisSurat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Hapus data lama jika ada
        DB::table('jenis_surat')->truncate();

        $jenisSuratDasar = [
            ['kode' => 'SKTM', 'nama' => 'Surat Keterangan Tidak Mampu'],
            ['kode' => 'SKD', 'nama' => 'Surat Keterangan Domisili'],
            ['kode' => 'SKU', 'nama' => 'Surat Keterangan Usaha'],
            ['kode' => 'SKK', 'nama' => 'Surat Keterangan Kematian'],
            ['kode' => 'SKP', 'nama' => 'Surat Keterangan Penghasilan'],
            ['kode' => 'SKBM', 'nama' => 'Surat Keterangan Belum Menikah'],
            ['kode' => 'SKM', 'nama' => 'Surat Keterangan Miskin'],
            ['kode' => 'SKT', 'nama' => 'Surat Keterangan Tanah'],
            ['kode' => 'SKPL', 'nama' => 'Surat Keterangan Pengantar Lainnya'],
            ['kode' => 'SP', 'nama' => 'Surat Pengantar'],
            ['kode' => 'SKB', 'nama' => 'Surat Keterangan Beda Nama'],
            ['kode' => 'SKN', 'nama' => 'Surat Keterangan Nikah'],
            ['kode' => 'SKS', 'nama' => 'Surat Keterangan Sehat'],
            ['kode' => 'SKG', 'nama' => 'Surat Keterangan Ghoib'],
            ['kode' => 'SKJ', 'nama' => 'Surat Keterangan Janda/Duda'],
        ];

        $syaratUmum = [
            'Fotokopi KTP',
            'Fotokopi Kartu Keluarga',
            'Pas foto 3x4',
            'Surat pengantar RT/RW',
            'Formulir permohonan',
            'Fotokopi Akta Kelahiran',
            'Fotokopi Buku Nikah',
            'Surat Keterangan Kerja',
            'Slip Gaji',
            'NPWP'
        ];

        $data = [];

        // Create 120 jenis surat dengan variasi (lebih dari 12 untuk testing pagination)
        for ($i = 0; $i < 120; $i++) {
            $jenisDasar = $jenisSuratDasar[$i % count($jenisSuratDasar)];
            $counter = floor($i / count($jenisSuratDasar)) + 1;

            // Beberapa data tanpa syarat untuk testing filter
            $hasSyarat = $faker->boolean(80); // 80% punya syarat, 20% tanpa syarat

            $syaratKhusus = $hasSyarat ? $faker->randomElements($syaratUmum, $faker->numberBetween(2, 5)) : [];

            $data[] = [
                'kode' => $jenisDasar['kode'] . str_pad($counter, 2, '0', STR_PAD_LEFT),
                'nama_jenis' => $jenisDasar['nama'] . ' ' . $counter,
                'syarat_json' => $hasSyarat ? json_encode($syaratKhusus) : null,
                'created_at' => Carbon::now()->subDays($faker->numberBetween(0, 365)),
                'updated_at' => Carbon::now()->subDays($faker->numberBetween(0, 30)),
            ];

            // Insert setiap 20 data untuk menghindari memory issue
            if (count($data) >= 20) {
                DB::table('jenis_surat')->insert($data);
                $data = [];
            }
        }

        // Insert sisa data
        if (count($data) > 0) {
            DB::table('jenis_surat')->insert($data);
        }

        $this->command->info('Berhasil membuat 120 data jenis surat untuk testing pagination!');
        $this->command->info('Total halaman: ' . ceil(120 / 12) . ' halaman');
    }
}
