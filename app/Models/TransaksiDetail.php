<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'qty'
    ];
    public function product()
    {
        return $this->belongsTo('App\Model\product', 'id_barang');
    }

    public function order()
    {
        return $this->belongsTo('App\Model\penjualan', 'id_penjualan');
    }
}
