<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cars extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_polisi',
        'user_id',
        'mobil',
        'nomor_mesin',
        'nomor_rangka',
        'km'
    ];

    /**
     * Get the user that owns the Cars
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
