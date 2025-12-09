<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanSurat extends Model
{
    use HasFactory;

    protected $table = 'permohonan_surat';
    protected $primaryKey = 'permohonan_id';

    protected $fillable = [
        'nomor_permohonan',
        'warga_id',
        'jenis_surat_id',
        'tanggal_pengajuan',
        'status',
        'catatan',
    ];

    public function scopeFilter($query, $request, $filterableColumns)
    {
        foreach ($filterableColumns as $column) {
            if ($request->has($column) && $request->$column != '') {
                $query->where($column, $request->$column);
            }
        }
        return $query;
    }

    /**
     * Relasi ke JenisSurat
     */
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id', 'jenis_id');
    }

    /**
     * Relasi ke Warga
     */
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    public function files()
    {
        return $this->hasMany(Multipleuploads::class, 'ref_id', 'permohonan_id')
                    ->where('ref_table', 'permohonan_surat');
    }
}

