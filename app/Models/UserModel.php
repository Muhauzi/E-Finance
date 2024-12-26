<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DataPegawaiModel;
use Illuminate\Support\Facades\Auth;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'username',
        'password',
        'role',
        'id_data_pegawai',
    ];
    public $timestamps = true;


    public function data_pegawai()
    {
        return $this->belongsTo(DataPegawaiModel::class, 'id_data_pegawai', 'id');
    }

    public function data_pegawai_auth()
    {
        $user = Auth::user();
        return $this->data_pegawai()->where('id', $user->id_data_pegawai)->first();
    }
}
