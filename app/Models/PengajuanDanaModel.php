<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanDanaModel extends Model
{

    protected $table = 'pengajuan_dana';
    protected $primaryKey = 'id';
    protected $fillable = [
        'subjek_pengajuan',
        'tujuan_pengajuan',
        'verifikasi_pimpinan',
        'verifikasi_bendahara',
        'keterangan_verifikasi_pimpinan',
        'keterangan_verifikasi_bendahara',
        'id_user',
    ];
    public $timestamps = true;
}
