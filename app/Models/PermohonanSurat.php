<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanSurat extends Model
{
    use HasFactory;
    protected $table = 'permohonan_surat';
    protected $primaryKey = 'permohonan_id';
    public $timestamps = false;
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_id', 'jenis_id');
    }

    public function riwayatStatus()
    {
        return $this->hasMany(RiwayatStatusSurat::class, 'permohonan_id', 'permohonan_id');
    }
}
