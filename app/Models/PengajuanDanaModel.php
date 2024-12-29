<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanDanaModel extends Model
{

    protected $table = 'pengajuan_dana';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tanggal_pengajuan',
        'tujuan_pengajuan',
        'keterangan_pengajuan',
        'nominal_pengajuan',
        'verifikasi_pimpinan',
        'verifikasi_bendahara',
        'keterangan_verifikasi_pimpinan',
        'keterangan_verifikasi_bendahara',
        'id_user',
    ];
    public $timestamps = true;

    public function getDataPengajuan()
    {
        return $this->join('users', 'pengajuan_dana.id_user', '=', 'users.id')
            ->join('data_pegawai', 'data_pegawai.id', '=', 'users.id_data_pegawai')
            ->select('pengajuan_dana.*', 'data_pegawai.nama')
            ->get();
    }

    public function getDataPengajuanById($id)
    {
        return $this->join('users', 'pengajuan_dana.id_user', '=', 'users.id')
            ->join('data_pegawai', 'data_pegawai.id', '=', 'users.id_data_pegawai')
            ->select('pengajuan_dana.*', 'data_pegawai.nama')
            ->where('pengajuan_dana.id', $id)
            ->first();
    }

    public function getDetailPengajuanById($id)
    {
        return $this->join('users', 'pengajuan_dana.id_user', '=', 'users.id')
            ->join('data_pegawai', 'data_pegawai.id', '=', 'users.id_data_pegawai')
            ->join('detail_pengajuan_dana', 'pengajuan_dana.id', '=', 'detail_pengajuan_dana.pengajuan_dana_id')
            ->select('pengajuan_dana.*', 'data_pegawai.nama', 'detail_pengajuan_dana.*')
            ->where('pengajuan_dana.id', $id)
            ->get();
    }
}
