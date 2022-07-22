<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal', 'qty', 'total', 'sub_total', 'total_bayar', 'id_barang'
    ];

    public function product()
    {
        return $this->belongsTo('App\Model\product', 'id_barang');
    }
}
