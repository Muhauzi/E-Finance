<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountModel extends Model
{
    protected $table = 'account';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_akun',
        'jenis_akun',
        'nama_group_akun',
        'keterangan',
    ];
    public $timestamps = true;
}
