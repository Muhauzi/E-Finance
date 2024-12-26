<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailAccountModel extends Model
{
    protected $table = 'detail_account';
    protected $primaryKey = 'id';
    protected $fillable = [
        'account_id',
        'jenis_akun',
        'kode_akun',
        'nama_akun',
        'keterangan',
    ];
    public $timestamps = true;
}
