<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengeluaranImages extends Model
{
    protected $table = 'pengeluaran_images';
    protected $fillable = ['pengeluaran_id', 'image_path'];
    public $timestamps = true;

    public function detail_pengeluaran()
    {
        return $this->belongsTo(PengeluaranModel::class, 'pengeluaran_id', 'id');
    }
    
    public function getImagePath($id)
    {
        return $this->where('pengeluaran_id', $id)->get();
    }
}
