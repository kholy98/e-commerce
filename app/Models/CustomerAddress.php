<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'label',
        'name',
        'phone',
        'address',
        'street',
        'building_number',
        'floor',
        'apartment',
        'zone',
        'city',
        'zip_code',
        'country',
        'state',
        'is_default',
        'is_billing',
        'is_shipping',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'is_billing' => 'boolean',
        'is_shipping' => 'boolean',
    ];

    /**
     * Get the user that owns the address
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for default addresses
     */
    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    /**
     * Scope for billing addresses
     */
    public function scopeBilling($query)
    {
        return $query->where('is_billing', true);
    }

    /**
     * Scope for shipping addresses
     */
    public function scopeShipping($query)
    {
        return $query->where('is_shipping', true);
    }

    /**
     * Get formatted address for Bosta API
     */
    public function toBostaAddress(): array
    {
        return [
            'buildingNumber' => $this->building_number,
            'firstLine' => $this->street,
            'city' => $this->city,
            'zone' => $this->zone,
            'floor' => $this->floor,
            'apartment' => $this->apartment,
        ];
    }

    /**
     * Get formatted address for Paymob API
     */
    public function toPaymobAddress(): array
    {
        $nameParts = explode(' ', $this->name, 2);

        return [
            'first_name' => $nameParts[0] ?? '',
            'last_name' => $nameParts[1] ?? '',
            'email' => $this->user->email ?? '',
            'phone_number' => $this->phone,
            'street' => $this->street,
            'building' => $this->building_number,
            'floor' => $this->floor ?: 'NA',
            'apartment' => $this->apartment ?: 'NA',
            'city' => $this->city,
            'country' => $this->country,
            'postal_code' => $this->zip_code,
            'state' => $this->state ?: 'NA',
            'shipping_method' => 'NA',
        ];
    }

    /**
     * Extract building number from address (simple implementation)
     */
    private function extractBuildingNumber(): string
    {
        // Simple extraction - can be enhanced with regex
        $parts = explode(',', $this->address);

        return trim($parts[0] ?? $this->address);
    }

    /**
     * Extract floor from address (placeholder)
     */
    private function extractFloor(): ?string
    {
        // This could be enhanced to parse from address field
        return null;
    }

    /**
     * Extract apartment from address (placeholder)
     */
    private function extractApartment(): ?string
    {
        // This could be enhanced to parse from address field
        return null;
    }

    /**
     * Set this address as default and unset others
     */
    public function setAsDefault(): void
    {
        // Remove default flag from other addresses
        static::where('user_id', $this->user_id)
            ->where('id', '!=', $this->id)
            ->update(['is_default' => false]);

        $this->update(['is_default' => true]);
    }
}
