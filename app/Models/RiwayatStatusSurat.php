<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatStatusSurat extends Model
{
    use HasFactory;
    protected $table = 'riwayat_status_surat';
    protected $primaryKey = 'riwayat_id';
    public $timestamps = false;
}
