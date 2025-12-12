<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisSurat extends Model
{
    use HasFactory;
    protected $table = 'jenis_surat';
    protected $primaryKey = 'jenis_id';
    protected $fillable = [
        'kode',
        'nama_jenis',
        'syarat_json'
    ];

    public function permohonanSurat()
    {
        return $this->hasMany(PermohonanSurat::class, 'jenis_surat_id', 'jenis_id');
    }
}
