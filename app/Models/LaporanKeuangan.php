<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    protected $table = 'laporan_keuangan';
    protected $fillable = [
        'id',
        'tanggal',
        'keterangan',
        'pengeluaran',
        'pemasukan',
        'saldo_akhir',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    public function getLaporanKeuangan()
    {
        return $this->all();
    }

    public function getSaldoAkhir()
    {
        return $this->latest()->select('saldo_akhir')->first();
    }

}
