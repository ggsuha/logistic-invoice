<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shipment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['number', 'air_waybill'];

    /**
     * Get the shipper associated with the shipment.
     */
    public function shipper(): HasOne
    {
        return $this->hasOne(Shipper::class);
    }

    /**
     * Get the receiver/recipient associated with the shipment.
     */
    public function receiver(): HasOne
    {
        return $this->hasOne(Receiver::class);
    }

    /**
     * Get the items associated with the shipment.
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
