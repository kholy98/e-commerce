<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
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

    public function show(Order $order)
    {
        $order->load(['user', 'items.product.media']);

        $customerName = null;
        $customerEmail = null;
        $customerPhone = null;

        if ($order->user) {
            $customerName = $order->user->name;
            $customerEmail = $order->user->email;
            $customerPhone = $order->billing_address['phone'] ?? $order->shipping_address['phone'] ?? null;
        } else {
            $billingAddress = $order->billing_address;
            $customerName = trim(($billingAddress['first_name'] ?? '').' '.($billingAddress['last_name'] ?? ''));
            $customerEmail = $billingAddress['email'] ?? null;
            $customerPhone = $billingAddress['phone'] ?? null;
        }

        return Inertia::render('supplier/orders/show', [
            'order' => [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'status' => $order->status,
                'status_ar' => $order->status_ar,
                'payment_status' => $order->payment_status,
                'payment_method' => $order->payment_method,
                'tracking_number' => $order->tracking_number,
                'shipment_status' => $order->shipment_status,
                'shipping_address' => $order->shipping_address,
                'billing_address' => $order->billing_address,
                'notes' => $order->notes,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
                'customer' => [
                    'name' => $customerName ?: 'Guest Customer',
                    'email' => $customerEmail,
                    'phone' => $customerPhone,
                ],
                'items' => $order->items->map(fn ($item) => [
                    'id' => $item->id,
                    'product_name' => $item->product?->name ?? 'Deleted Product',
                    'product_image' => $item->product?->media?->first()?->original_url ?? null,
                    'quantity' => $item->quantity,
                ]),
            ],
        ]);
    }

    public function updateStatus(\Illuminate\Http\Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'status_ar' => 'nullable|string',
            'payment_status' => 'nullable|in:pending,paid,failed,refunded',
        ]);

        $order->update($validated);

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
