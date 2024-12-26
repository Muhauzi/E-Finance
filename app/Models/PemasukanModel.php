<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemasukanModel extends Model
{
    protected $table = 'pemasukan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_detail_account',
        'sumber_pemasukan',
        'nominal',
        'keterangan',
        'tanggal',
    ];
    public $timestamps = true;

    public function getPemasukanAll()
    {
        return $this->join('detail_account', 'pemasukan.id_detail_account', '=', 'detail_account.id')
            ->join('users', $this->table . '.id_penginput', '=', 'users.id')
            ->select('pemasukan.*', 'detail_account.*', 'users.username', 'pemasukan.id as id_pemasukan', 'detail_account.id as id_detail_account', 'users.id as id_user')
            ->get();
    }

    public function getPemasukanByAccount($id)
    {
        return $this->join('detail_account', 'pemasukan.id_detail_account', '=', 'detail_account.id')
            ->join('users', $this->table . '.id_penginput', '=', 'users.id')
            ->select('pemasukan.*', 'detail_account.*', 'users.username', 'pemasukan.id as id_pemasukan', 'detail_account.id as id_detail_account', 'users.id as id_user')
            ->where('pemasukan.id_detail_account', $id)
            ->get();
    }
}
