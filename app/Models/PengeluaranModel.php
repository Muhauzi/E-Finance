<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengeluaranModel extends Model
{
    protected $table = 'pengeluaran';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_penginput',
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

    public function getTotalPengeluaranBulanan()
    {
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $total = [];
        foreach ($bulan as $key => $value) {
            $total[$value] = $this->whereMonth('tanggal', $key + 1)
                ->join('detail_pengeluaran', 'pengeluaran.id', '=', 'detail_pengeluaran.pengeluaran_id')
                ->sum('detail_pengeluaran.total_harga');
        }

        return $total;
    }
}
