<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'tipe',
        'keterangan',
        'jumlah_stock',
        'harga'
    ];
}
