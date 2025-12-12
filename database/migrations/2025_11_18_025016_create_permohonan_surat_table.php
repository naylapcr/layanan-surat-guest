<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('permohonan_surat', function (Blueprint $table) {
        $table->id('permohonan_id'); // Primary Key
        $table->string('nomor_permohonan')->unique();

        // Foreign Key ke tabel 'warga' (NAMA KOLOM BERBEDA DENGAN PUNYA KAMU SEBELUMNYA)
        $table->unsignedBigInteger('pemohon_warga_id');
        $table->foreign('pemohon_warga_id')->references('warga_id')->on('warga')->onDelete('cascade');

        // Foreign Key ke tabel 'jenis_surat' (NAMA KOLOM BERBEDA)
        $table->unsignedBigInteger('jenis_id');
        $table->foreign('jenis_id')->references('jenis_id')->on('jenis_surat')->onDelete('cascade');

        $table->date('tanggal_pengajuan');
        $table->string('status'); // Temanmu pakai string, bukan enum
        $table->text('catatan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_surat');
    }
};
