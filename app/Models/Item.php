<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shipment_id',
        'description',
        'quantity',
        'unit',
        'value',
    ];

    /**
     * Get total value.
     */
    public function getTotalValueAttribute()
    {
        return $this->value * $this->quantity;
    }

    /**
     * Get the shipment associated with the item.
     */
    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }
}
