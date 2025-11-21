<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateJenisSurat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

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

        // Create 100 jenis surat dengan variasi
        for ($i = 0; $i < 100; $i++) {
            $jenisDasar = $jenisSuratDasar[$i % count($jenisSuratDasar)];
            $counter = floor($i / count($jenisSuratDasar)) + 1;

            $syaratKhusus = $faker->randomElements($syaratUmum, $faker->numberBetween(2, 5));

            $data[] = [
                'kode' => $jenisDasar['kode'] . str_pad($counter, 2, '0', STR_PAD_LEFT),
                'nama_jenis' => $jenisDasar['nama'] . ' ' . $counter,
                'syarat_json' => json_encode($syaratKhusus),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('jenis_surat')->insert($data);
    }
}
