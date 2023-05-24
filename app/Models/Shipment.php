<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Shipment extends Model
{
    use HasFactory;

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (Shipment $shipment) {
            $shipment->number = time();
        });

        static::created(function (Shipment $shipment) {
            $shipment->air_waybill = (int)(Carbon::now()->format('ym') . '00000000') + $shipment->id;
            $shipment->save();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'receiver_id',
        'category_id',
        'number',
        'air_waybill',
        'weight',
        'content',
        'pcs',
        'value',
        'dimension',
    ];

    /**
     * Get the user's first name.
     */
    protected function allItems(): Attribute
    {
        return Attribute::make(
            get: function () {
                $items = [];

                foreach ($this->items as $item) {
                    $items[] = $item->description;
                }

                return implode(', ', $items);
            }
        );
    }

    /**
     * Scope a query to only include certain keyword.
     */
    public function scopeKeyword(Builder $query): void
    {
        if (!request()->keyword) {
            return;
        }

        $query->where('air_waybill', 'LIKE', '%' . request()->keyword . '%')
            ->orWhereHas('receiver', function ($q) {
                $q->where('name', 'LIKE', '%' . request()->keyword . '%')
                    ->orWhere('phone', 'LIKE', '%' . request()->keyword . '%')
                    ->orWhereHas('address', function ($q) {
                        $q->where('street', 'LIKE', '%' . request()->keyword . '%')
                            ->orWhereHas('postalCode', function ($q) {
                                $q->where('postal_code', 'LIKE', '%' . request()->keyword . '%')
                                    ->orWhereHas('country', function ($q) {
                                        $q->where('name', 'LIKE', '%' . request()->keyword . '%');
                                    });
                            });
                    });
            })
            ->orWhereHas('shipper', function ($q) {
                $q->where('name', 'LIKE', '%' . request()->keyword . '%')
                    ->orWhere('phone', 'LIKE', '%' . request()->keyword . '%');
            });
    }

    /**
     * Scope a query to only include spesific date.
     */
    public function scopeDate(Builder $query): void
    {
        $start_date = request()->start_date;
        $end_date = request()->end_date;

        if (!$start_date && !$end_date) {
            return;
        }

        if ($start_date && $end_date) {
            $query->whereDate('created_at', '>=', $start_date)
                ->whereDate('created_at', '<=', $end_date);
        } else if (!$end_date) {
            $query->whereDate('created_at', '>=', $start_date);
        } else if (!$start_date) {
            $query->whereDate('created_at', '<=', $end_date);
        }
    }

    /**
     * Sum item quantity.
     */
    public function getSumQuantityAttribute()
    {
        return $this->items->sum('quantity');
    }

    /**
     * Sum total value quantity.
     */
    public function getSumTotalValueAttribute()
    {
        return $this->items->sum('total_value');
    }

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
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(Receiver::class);
    }

    /**
     * Get the category associated with the shipment.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the items associated with the shipment.
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    /**
     * Get the items associated with the shipment.
     */
    public function item(): HasOne
    {
        return $this->hasOne(Item::class);
    }

    /**
     * Get the address associated with the shipment.
     */
    public function address(): HasOneThrough
    {
        return $this->hasOneThrough(ReceiverAddress::class, Receiver::class);
    }
}
