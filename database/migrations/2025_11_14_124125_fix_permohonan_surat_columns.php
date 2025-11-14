<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus tabel jika ada struktur yang salah
        Schema::dropIfExists('permohonan_surat');

        // Buat ulang tabel dengan struktur yang benar
        Schema::create('permohonan_surat', function (Blueprint $table) {
            $table->id('permohonan_id');
            $table->string('nomor_permohonan')->unique();
            $table->foreignId('warga_id')->constrained('warga')->onDelete('cascade');
            $table->foreignId('jenis_surat_id')->constrained('jenis_surat')->onDelete('cascade');
            $table->date('tanggal_pengajuan');
            $table->enum('status', ['DRAFT', 'DIAJUKAN', 'DIPROSES', 'SELESAI', 'DIAMBIL', 'DITOLAK']);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permohonan_surat');
    }
};
