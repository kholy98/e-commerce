<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->filled('search')) {
            $query->where('order_number', 'like', '%'.$request->search.'%')
                ->orWhereHas('user', function ($q) use ($request) {
                    $q->where('name', 'like', '%'.$request->search.'%');
                });
        }

        if ($request->filled('status')) {
            $status = $request->status;
            if ($status === 'in-progress') {
                $query->whereIn('status', [Order::STATUS_PENDING, Order::STATUS_PROCESSING]);
            } elseif ($status === 'complete') {
                $query->where('status', Order::STATUS_DELIVERED);
            } elseif ($status === 'cancelled') {
                $query->where('status', Order::STATUS_CANCELLED);
            }
        }

        $stats = [
            'all' => Order::count(),
            'new' => Order::where('status', Order::STATUS_PENDING)->count(),
            'completed' => Order::where('status', Order::STATUS_DELIVERED)->count(),
            'cancelled' => Order::where('status', Order::STATUS_CANCELLED)->count(),
        ];

        $orders = $query->with(['user', 'items.product.media'])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('admin/orders/index', [
            'stats' => $stats,
            'orders' => $orders,
            'filters' => $request->only(['search', 'status']),
        ]);
    }

    public function show(Order $order)
    {
        return Inertia::render('admin/orders/show', [
            'order' => $order->load(['user', 'items.product.media']),
        ]);
    }
}
