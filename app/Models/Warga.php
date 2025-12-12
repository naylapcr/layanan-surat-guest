<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warga extends Model
{
    use HasFactory;
    protected $table = 'warga';
    protected $primaryKey = 'warga_id';
    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email'
    ];

    public $timestamps = true;

    public function getRouteKeyName()
    {
        return 'warga_id';
    }

    public function permohonanSurat()
    {
        return $this->hasMany(PermohonanSurat::class, 'warga_id', 'warga_id');
    }
}
