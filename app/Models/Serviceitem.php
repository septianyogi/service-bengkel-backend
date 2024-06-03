<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Serviceitem extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'user_id',
        'tanggal',
        'status',
        'home_pickup',
        'no_polisi',
        'mobil',
        'jenis_service',
        'keluhan',
        'alamat',
        'latlng',
        'sparepart',
        'biaya'
    ];

    /**
     * Get the user that owns the Serviceitem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
