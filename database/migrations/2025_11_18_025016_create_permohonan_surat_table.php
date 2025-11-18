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
            $table->foreignId('warga_id')->constrained('warga')->onDelete('cascade'); // Pastikan ini ada
            $table->foreignId('jenis_surat_id')->constrained('jenis_surat')->onDelete('cascade'); // Pastikan ini ada
            $table->date('tanggal_pengajuan');
            $table->enum('status', ['DRAFT', 'DIAJUKAN', 'DIPROSES', 'SELESAI', 'DIAMBIL', 'DITOLAK']);
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
