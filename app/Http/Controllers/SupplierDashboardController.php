<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;

class SupplierDashboardController extends Controller
{
    public function stats(): JsonResponse
    {
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', Order::STATUS_PENDING)->count(),
            'processing_orders' => Order::where('status', Order::STATUS_PROCESSING)->count(),
            'shipped_orders' => Order::where('status', Order::STATUS_SHIPPED)->count(),
            'delivered_orders' => Order::where('status', Order::STATUS_DELIVERED)->count(),
            'cancelled_orders' => Order::where('status', Order::STATUS_CANCELLED)->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
        ]);
    }

    public function orders(): JsonResponse
    {
        $query = Order::with(['user', 'items.product']);

        if (request()->has('status') && request('status') !== 'all') {
            $query->where('status', request('status'));
        }

        if (request()->has('search') && request('search')) {
            $query->where('order_number', 'like', '%'.request('search').'%');
        }

        $orders = $query->orderBy('created_at', 'desc')
            ->paginate(request()->query('per_page', 15))
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'order_number' => $order->order_number,
                    'status' => $order->status,
                    'status_ar' => $order->status_ar,
                    'payment_status' => $order->payment_status,
                    'payment_method' => $order->payment_method,
                    'tracking_number' => $order->tracking_number,
                    'shipment_status' => $order->shipment_status,
                    'created_at' => $order->created_at->format('Y-m-d H:i:s'),
                    'customer' => $order->user ? [
                        'id' => $order->user->id,
                        'name' => $order->user->name,
                        'email' => $order->user->email,
                    ] : null,
                    'items' => $order->items->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'product_name' => $item->product ? $item->product->name : 'Unknown Product',
                            'quantity' => $item->quantity,
                        ];
                    }),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $orders,
        ]);
    }

    public function updateStatus(\Illuminate\Http\Request $request, Order $order): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'status_ar' => 'nullable|string',
            'payment_status' => 'nullable|in:pending,paid,failed,refunded',
        ]);

        $order->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully',
            'data' => [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'status' => $order->status,
                'status_ar' => $order->status_ar,
                'payment_status' => $order->payment_status,
                'payment_method' => $order->payment_method,
            ],
        ]);
    }
}
