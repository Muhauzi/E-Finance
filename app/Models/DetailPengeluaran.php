<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\PengeluaranModel; // Ensure this class exists in the specified namespace

class DetailPengeluaran extends Model
{
    protected $table = 'detail_pengeluaran';
    protected $fillable = [
        'pengeluaran_id',
        'item',
        'jumlah',
        'satuan',
        'harga_satuan',
        'total_harga',
        'struk'
    ];
    public $timestamps = true;

    public function pengeluaran()
    {
        return $this->belongsTo(PengeluaranModel::class, 'pengeluaran_id', 'id');
    }

    public function totalPenegeluranBulanan($month, $year)
    {
        $this->table = 'detail_pengeluaran';
        return $this->join('pengeluaran', 'detail_pengeluaran.pengeluaran_id', '=', 'pengeluaran.id')
            ->whereMonth('pengeluaran.tanggal', $month)
            ->whereYear('pengeluaran.tanggal', $year)
            ->sum('total_harga');
    }

}
