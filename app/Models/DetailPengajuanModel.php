<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPengajuanModel extends Model
{
    protected $table = 'detail_pengajuan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'pengajuan_dana_id',
        'item',
        'jumlah',
        'satuan',
        'harga_satuan',
        'total_harga',
        'keterangan',
    ];
    public $timestamps = true;
}
