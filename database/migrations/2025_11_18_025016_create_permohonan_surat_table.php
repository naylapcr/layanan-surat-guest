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

        // Perhatikan penambahan parameter kedua pada constrained()
        $table->foreignId('warga_id')
              ->constrained('warga', 'warga_id') // Referensi ke 'warga_id' bukan 'id'
              ->onDelete('cascade');

        $table->foreignId('jenis_surat_id')
              ->constrained('jenis_surat', 'jenis_id') // Referensi ke 'jenis_id' bukan 'id'
              ->onDelete('cascade');

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
