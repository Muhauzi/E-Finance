<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengeluaranModel extends Model
{
    protected $table = 'pengeluaran';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_penginput',
        'id_detail_account',
        'tanggal',
        'jenis_pengeluaran',
        'keterangan',
    ];
    public $timestamps = true;


    public function getDataPengeluaran()
    {
        return $this->with('user', 'pengeluaranDetail', 'pengeluaranImages')->get();
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_penginput', 'id');
    }

    public function pengeluaranDetail()
    {
        return $this->hasMany(DetailPengeluaran::class, 'pengeluaran_id', 'id');
    }

    public function pengeluaranImages()
    {
        return $this->hasMany(PengeluaranImages::class, 'pengeluaran_id', 'id');
    }

    public function detailAccount()
    {
        return $this->belongsTo(DetailAccountModel::class, 'id_detail_account', 'id');
    }

    public function getTotalPengeluaranAll()
    {
        return $this->join('detail_pengeluaran', 'pengeluaran.id', '=', 'detail_pengeluaran.pengeluaran_id')
            ->sum('detail_pengeluaran.total_harga');
    }

    public function getPengeluaranBulanan($month, $year)
    {
        return $this->join('detail_pengeluaran', 'pengeluaran.id', '=', 'detail_pengeluaran.pengeluaran_id')
            ->whereMonth('pengeluaran.tanggal', $month)
            ->whereYear('pengeluaran.tanggal', $year)
            ->sum('detail_pengeluaran.total_harga');
    }

    public function getTotalPengeluaranBulanan($year)
    {
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $total = [];
        foreach ($bulan as $key => $value) {
            $total[$value] = $this->getPengeluaranBulanan($key + 1, $year);
        }

        return $total;
    }

    public function getTotalPengeluaran($id_detail_account)
    {
        return $this->join('detail_pengeluaran', 'pengeluaran.id', '=', 'detail_pengeluaran.pengeluaran_id')
            ->where('pengeluaran.id_detail_account', $id_detail_account)
            ->sum('detail_pengeluaran.total_harga');
    }

    public function getPengeluaranByAccount($id_detail_account)
    {
        return $this->join('detail_pengeluaran', 'pengeluaran.id', '=', 'detail_pengeluaran.pengeluaran_id')
            ->where('pengeluaran.id_detail_account', $id_detail_account)
            ->get();
    }   
}
