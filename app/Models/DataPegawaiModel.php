<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPegawaiModel extends Model
{
    protected $table = 'data_pegawai';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nama',
        'nip',
        'alamat',
        'no_hp',
        'email',
        'jabatan',
        'golongan',
        'status',
        'keterangan'
    ];
    public $timestamps = true;
}
