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
}
