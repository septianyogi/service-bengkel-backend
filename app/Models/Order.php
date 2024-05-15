<?php

namespace App\Models;

use App\Models\Sparepart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'alamat',
        'tanggal',
        'status',
        'pembayaran',
        'sparepart_id',
        'jumlah',
        'harga',
        'total_harga',
    ];

    /**
     * Get the user that owns the Orderdetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sparepart(): BelongsTo
    {
        return $this->belongsTo(Sparepart::class, 'sparepart_id', 'id');
    }
}
