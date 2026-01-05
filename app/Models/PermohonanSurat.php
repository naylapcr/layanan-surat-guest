<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Tambahkan import Model Media
use App\Models\Media;

class PermohonanSurat extends Model
{
    use HasFactory;

    protected $table = 'permohonan_surat';
    protected $primaryKey = 'permohonan_id';

    protected $fillable = [
        'nomor_permohonan',
        'pemohon_warga_id',
        'jenis_id',
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
        return $this->belongsTo(JenisSurat::class, 'jenis_id', 'jenis_id');
    }

    /**
     * Relasi ke Warga
     */
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'pemohon_warga_id', 'warga_id');
    }

    /**
     * PERBAIKAN: Menggunakan Model Media (bukan Multipleuploads)
     * Karena tabel 'multiuploads' sudah tidak ada.
     */
    public function files()
    {
        return $this->hasMany(Media::class, 'ref_id', 'permohonan_id')
                    ->where('ref_table', 'permohonan_surat');
    }
}
