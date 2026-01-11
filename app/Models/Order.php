<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'tracking_number',
        'shipment_status',
        'user_id',
        'status',
        'payment_status',
        'subtotal',
        'tax',
        'shipping_cost',
        'total_amount',
        'shipping_address',
        'billing_address',
        'notes',
        'payment_id',
        'bosta_id',
        'state_code',
        'type',
        'cod',
        'state_changed_at',
        'is_confirmed_delivery',
        'delivery_promise_date',
        'exception_reason',
        'exception_code',
        'business_reference',
        'number_of_attempts',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'shipping_address' => 'array',
        'billing_address' => 'array',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELLED = 'cancelled';

    const PAYMENT_STATUS_PENDING = 'pending';
    const PAYMENT_STATUS_PAID = 'paid';
    const PAYMENT_STATUS_FAILED = 'failed';
    const PAYMENT_STATUS_REFUNDED = 'refunded';

    /**
     * Get the user this order belongs to
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all items in this order
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Generate a unique order number
     */
    public static function generateOrderNumber(): string
    {
        return 'ORD-' . date('YmdHis') . '-' . strtoupper(bin2hex(random_bytes(3)));
    }

    /**
     * Calculate total amount
     */
    public function calculateTotal(): void
    {
        $this->subtotal = $this->items->sum('subtotal');
        $this->tax = round($this->subtotal * 0.1, 2); // 10% tax
        $this->shipping_cost = $this->subtotal > 100 ? 0 : 10; // Free shipping over 100
        $this->total_amount = $this->subtotal + $this->tax + $this->shipping_cost;
        $this->save();
    }

    /**
     * Check if order can be cancelled
     */
    public function canBeCancelled(): bool
    {
        return in_array($this->status, [self::STATUS_PENDING, self::STATUS_PROCESSING]);
    }

    /**
     * Cancel the order and restore stock
     */
    public function cancel(): void
    {
        if (!$this->canBeCancelled()) {
            throw new \Exception('Order cannot be cancelled at this status');
        }

        foreach ($this->items as $item) {
            $item->product->increaseStock($item->quantity);
        }

        $this->status = self::STATUS_CANCELLED;
        $this->save();
    }
}
