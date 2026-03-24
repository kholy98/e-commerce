<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Inertia\Inertia;

class SupplierDashboardWebController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', Order::STATUS_PENDING)->count(),
            'processing_orders' => Order::where('status', Order::STATUS_PROCESSING)->count(),
            'shipped_orders' => Order::where('status', Order::STATUS_SHIPPED)->count(),
            'delivered_orders' => Order::where('status', Order::STATUS_DELIVERED)->count(),
            'cancelled_orders' => Order::where('status', Order::STATUS_CANCELLED)->count(),
        ];

        $query = Order::with(['user', 'items.product']);

        if (request()->has('status') && request('status') !== 'all') {
            $query->where('status', request('status'));
        }

        if (request()->has('search') && request('search')) {
            $query->where('order_number', 'like', '%'.request('search').'%');
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(15);

        return Inertia::render('supplier/dashboard', [
            'stats' => $stats,
            'orders' => $orders,
            'filters' => request()->only(['search', 'status']),
        ]);
    }

    public function updateStatus(\Illuminate\Http\Request $request, Order $order): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'status_ar' => 'nullable|string',
        ]);

        $order->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully',
        ]);
    }
}
