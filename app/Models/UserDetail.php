<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'header',
        'logo',
        'logo_url',
    ];

    /**
     * Get the user associated with the detail.
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
