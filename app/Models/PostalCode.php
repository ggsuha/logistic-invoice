<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostalCode extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_id',
        'postal_code',
        'city',
        'state',
    ];

    /**
     * Get the country associated with the detail.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
