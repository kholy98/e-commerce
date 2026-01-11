<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendingCheckout extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'temp_order_id',
        'order_data',
        'shipment_data',
        'expires_at'
    ];

    protected $casts = [
        'order_data' => 'array',
        'shipment_data' => 'array',
        'expires_at' => 'datetime'
    ];

    /**
     * Scope for active (non-expired) checkouts
     */
    public function scopeActive($query)
    {
        return $query->where('expires_at', '>', now());
    }

    /**
     * Clean up expired checkouts
     */
    public static function cleanupExpired()
    {
        return static::where('expires_at', '<=', now())->delete();
    }
}
