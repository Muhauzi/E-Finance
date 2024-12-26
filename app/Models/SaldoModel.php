<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaldoModel extends Model
{
    protected $table = 'saldo';
    protected $primaryKey = 'id';
    protected $fillable = [
        'detail_account_id',
        'nominal',
        'keterangan',
    ];
    public $timestamps = true;

    public function getSaldoAll()
    {
        return $this->join('detail_account', 'saldo.detail_account_id', '=', 'detail_account.id')
            ->select('saldo.*', 'detail_account.*')
            ->get();
    }

}
