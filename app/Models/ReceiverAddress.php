<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReceiverAddress extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'receiver_id',
        'postal_code_id',
        'street',
        'postal_code',
        'country',
    ];

    /**
     * Get the receiver associated with the address.
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(Receiver::class);
    }

    /**
     * Get the postal code associated with the address.
     */
    public function postalCode(): BelongsTo
    {
        return $this->belongsTo(PostalCode::class);
    }
}
