<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{

    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
        'movement_type',
        'movement_date'
    ];

    public function casts(): array
    {
        return [
            'quantity' => 'integer',
        ];
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
