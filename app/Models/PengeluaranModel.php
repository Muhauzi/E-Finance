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
}
