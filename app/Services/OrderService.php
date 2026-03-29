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

                if (! $product->hasStock($item['quantity'])) {
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
            if (! $order->canBeCancelled()) {
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
     * Create order after successful payment and shipment
     *
     * @param  array  $orderData  Order data including items, addresses, etc.
     * @param  array  $shipmentData  Shipment data from Bosta
     * @param  string|null  $paymentId  Payment transaction ID (null for COD)
     * @param  bool  $isCod  Whether this is a Cash on Delivery order
     */
    public function createOrderAfterPayment(array $orderData, array $shipmentData, ?string $paymentId = null, bool $isCod = false): Order
    {
        return DB::transaction(function () use ($orderData, $shipmentData, $paymentId, $isCod) {
            // Create order (user_id is nullable for guest checkout)
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => $orderData['user_id'] ?? null,
                'status' => $orderData['status'] ?? Order::STATUS_PROCESSING,
                'payment_status' => $isCod ? Order::PAYMENT_STATUS_PENDING : Order::PAYMENT_STATUS_PAID,
                'payment_method' => $orderData['payment_method'] ?? Order::PAYMENT_METHOD_ONLINE,
                'payment_id' => $paymentId,
                'tracking_number' => $shipmentData['tracking_number'] ?? null,
                'shipment_status' => $shipmentData['status'] ?? 'pending',
                'subtotal' => $orderData['subtotal'] ?? 0,
                'tax' => $orderData['tax'] ?? 0,
                'shipping_cost' => $orderData['shipping_cost'] ?? 0,
                'total_amount' => $orderData['total_amount'] ?? 0,
                'shipping_address' => $orderData['shipping_address'] ?? null,
                'billing_address' => $orderData['billing_address'] ?? null,
                'notes' => $orderData['notes'] ?? null,
            ]);

            // Create order items
            foreach ($orderData['items'] as $key => $value) {
                // Handle both formats: ['product_id' => quantity] or [['product_id' => 1, 'quantity' => 2], ...]
                if (is_array($value) && isset($value['product_id'])) {
                    $productId = $value['product_id'];
                    $quantity = $value['quantity'];
                } else {
                    $productId = $key;
                    $quantity = $value;
                }

                $product = Product::findOrFail($productId);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $product->price,
                    'subtotal' => round($product->price * $quantity, 2),
                ]);

                // Reduce product stock
                $product->reduceStock($quantity);
            }

            return $order;
        });
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
