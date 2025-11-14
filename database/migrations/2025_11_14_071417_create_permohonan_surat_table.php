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
            $table->id('permohonan_id');
            $table->string('nomor_permohonan')->unique();
            // Foreign Key ke tabel warga
            $table->foreignId('pemohon_warga_id')->constrained('warga', 'warga_id')->onDelete('cascade');
            // Foreign Key ke tabel jenis_surat
            $table->foreignId('jenis_id')->constrained('jenis_surat', 'jenis_id')->onDelete('cascade');

            $table->date('tanggal_pengajuan');
            $table->enum('status', ['DRAFT', 'DIAJUKAN', 'DIPROSES', 'DITOLAK', 'SELESAI', 'DIAMBIL']);
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
