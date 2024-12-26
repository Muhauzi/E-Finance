<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPengajuanModel extends Model
{
    protected $table = 'laporan_pengajuan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pengajuan',
        'file_laporan',
    ];
    public $timestamps = true;
}
