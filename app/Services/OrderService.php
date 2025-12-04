<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * Create an order from cart items
     */
    public function createOrder(array $data, int $userId): Order
    {
        return DB::transaction(function () use ($data, $userId) {
            // Create order
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => $userId,
                'status' => Order::STATUS_PENDING,
                'payment_status' => Order::PAYMENT_STATUS_PENDING,
                'shipping_address' => $data['shipping_address'],
                'notes' => $data['notes'] ?? null,
            ]);

            // Add items to order
            foreach ($data['items'] as $item) {
                $product = Product::lockForUpdate()->find($item['product_id']);

                if (!$product->hasStock($item['quantity'])) {
                    throw new \Exception("Product {$product->name} has insufficient stock");
                }

                // Create order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'subtotal' => round($product->price * $item['quantity'], 2),
                ]);

                // Reduce product stock
                $product->reduceStock($item['quantity']);
            }

            // Calculate totals
            $order->calculateTotal();

            return $order;
        });
    }

    /**
     * Cancel an order and restore stock
     */
    public function cancelOrder(Order $order): void
    {
        DB::transaction(function () use ($order) {
            if (!$order->canBeCancelled()) {
                throw new \Exception('Order cannot be cancelled at this status');
            }

            foreach ($order->items as $item) {
                $item->product->increaseStock($item->quantity);
            }

            $order->update([
                'status' => Order::STATUS_CANCELLED,
                'payment_status' => Order::PAYMENT_STATUS_REFUNDED,
            ]);
        });
    }

    /**
     * Process refund for an order
     */
    public function refundOrder(Order $order): void
    {
        DB::transaction(function () use ($order) {
            // Restore stock
            foreach ($order->items as $item) {
                $item->product->increaseStock($item->quantity);
            }

            $order->update([
                'payment_status' => Order::PAYMENT_STATUS_REFUNDED,
                'status' => Order::STATUS_CANCELLED,
            ]);
        });
    }

    /**
     * Update order status
     */
    public function updateOrderStatus(Order $order, string $status): Order
    {
        $order->update(['status' => $status]);
        return $order;
    }

    /**
     * Get order statistics
     */
    public function getStatistics(): array
    {
        return [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', Order::STATUS_PENDING)->count(),
            'processing_orders' => Order::where('status', Order::STATUS_PROCESSING)->count(),
            'shipped_orders' => Order::where('status', Order::STATUS_SHIPPED)->count(),
            'delivered_orders' => Order::where('status', Order::STATUS_DELIVERED)->count(),
            'cancelled_orders' => Order::where('status', Order::STATUS_CANCELLED)->count(),
            'total_revenue' => Order::where('payment_status', Order::PAYMENT_STATUS_PAID)
                ->sum('total_amount'),
            'pending_revenue' => Order::where('payment_status', Order::PAYMENT_STATUS_PENDING)
                ->sum('total_amount'),
            'average_order_value' => Order::where('payment_status', Order::PAYMENT_STATUS_PAID)
                ->avg('total_amount') ?? 0,
        ];
    }
}
