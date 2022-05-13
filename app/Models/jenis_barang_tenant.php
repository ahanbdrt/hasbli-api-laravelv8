<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_barang_tenant extends Model
{
    use HasFactory;
    protected $fillable = [
        'jenis_barang', 'id_tenant'
    ];
}
