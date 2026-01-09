<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Get all orders for authenticated user
     */
    public function index(Request $request): JsonResponse
    {
        $query = auth()->user()->orders();

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment status
        if ($request->has('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        $orders = $query->with('items.product')
            ->latest()
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $orders,
        ]);
    }

    /**
     * Get a specific order
     */
    public function show(Order $order): JsonResponse
    {
        $this->authorize('view', $order);

        $order->load('items.product', 'user');

        return response()->json([
            'success' => true,
            'data' => $order,
        ]);
    }

    /**
     * Create a new order from cart items (DEPRECATED - use checkout flow)
     * Orders are now created only through checkout process after successful payment and shipment
     */
    public function store(Request $request): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Direct order creation is deprecated. Please use the checkout flow: POST /checkout/initiate',
            'checkout_url' => '/checkout/initiate',
        ], 422);
    }

    /**
     * Update order status (Admin only)
     */
    public function updateStatus(Request $request, Order $order): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'sometimes|in:pending,paid,failed,refunded',
        ]);

        $order->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully',
            'data' => $order,
        ]);
    }

    /**
     * Cancel an order
     */
    public function cancel(Order $order): JsonResponse
    {
        $this->authorize('update', $order);

        try {
            $order->cancel();

            return response()->json([
                'success' => true,
                'message' => 'Order cancelled successfully',
                'data' => $order,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Get order statistics (Admin only)
     */
    public function statistics(): JsonResponse
    {
        $stats = [
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
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
        ]);
    }
}
