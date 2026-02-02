<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Orders
 *
 * APIs for managing customer orders.
 *
 * All endpoints in this group require authentication via Laravel Sanctum.
 */
class OrderController extends Controller
{
    /**
     * List all orders
     *
     * Get a paginated list of orders for the authenticated user.
     *
     * @authenticated
     *
     * @queryParam status string Filter by order status. Example: pending
     * @queryParam payment_status string Filter by payment status. Example: paid
     * @queryParam per_page integer Number of items per page. Default: 15. Example: 10
     *
     * @response 200 scenario="Success" {
     *   "data": {
     *     "success": true,
     *     "en": [
     *       {
     *         "id": 1,
     *         "order_number": "ORD-2024-001",
     *         "user_id": 1,
     *         "status": "pending",
     *         "payment_status": "pending",
     *         "subtotal": 100.00,
     *         "tax": 10.00,
     *         "shipping_cost": 15.00,
     *         "total_amount": 125.00,
     *         "shipping_address": {
     *           "street": "123 Main St",
     *           "city": "Cairo",
     *           "zip_code": "12345",
     *           "country": "Egypt",
     *           "building_number": "15",
     *           "floor": "3",
     *           "apartment": "5A",
     *           "zone": "Maadi"
     *         },
     *         "notes": "Please deliver in the morning",
     *         "created_at": "2024-01-15T10:00:00.000000Z",
     *         "updated_at": "2024-01-15T10:00:00.000000Z"
     *       }
     *     ],
     *     "ar": [
     *       {
     *         "id": 1,
     *         "order_number": "ORD-2024-001",
     *         "user_id": 1,
     *         "status": "قيد الانتظار",
     *         "payment_status": "pending",
     *         "subtotal": 100.00,
     *         "tax": 10.00,
     *         "shipping_cost": 15.00,
     *         "total_amount": 125.00,
     *         "shipping_address": {
     *           "street": "123 الشارع الرئيسي",
     *           "city": "القاهرة",
     *           "zip_code": "12345",
     *           "country": "مصر",
     *           "building_number": "15",
     *           "floor": "3",
     *           "apartment": "5A",
     *           "zone": "المعادي"
     *         },
     *         "notes": "يرجى التسليم في الصباح",
     *         "created_at": "2024-01-15T10:00:00.000000Z",
     *         "updated_at": "2024-01-15T10:00:00.000000Z"
     *       }
     *     ],
     *     "pagination": {
     *       "current_page": 1,
     *       "last_page": 5,
     *       "per_page": 15,
     *       "total": 75
     *     }
     *   }
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
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

        $enOrders = $orders->getCollection()->map(function ($order) {
            return [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'user_id' => $order->user_id,
                'status' => $order->status,
                'payment_status' => $order->payment_status,
                'subtotal' => (float) $order->subtotal,
                'tax' => (float) $order->tax,
                'shipping_cost' => (float) $order->shipping_cost,
                'total_amount' => (float) $order->total_amount,
                'shipping_address' => $order->shipping_address,
                'notes' => $order->notes,
                'items' => $order->items->map(function ($item) {
                    return [
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'unit_price' => (float) $item->unit_price,
                        'subtotal' => (float) $item->subtotal,
                        'product' => $item->product ? [
                            'id' => $item->product->id,
                            'name' => $item->product->name,
                            'slug' => $item->product->slug,
                            'image' => $item->product->image,
                            'price' => (float) $item->product->price,
                        ] : null,
                    ];
                }),
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
            ];
        });

        $arOrders = $orders->getCollection()->map(function ($order) {
            return [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'user_id' => $order->user_id,
                'status' => $order->status_ar ?: $order->status,
                'payment_status' => $order->payment_status,
                'subtotal' => (float) $order->subtotal,
                'tax' => (float) $order->tax,
                'shipping_cost' => (float) $order->shipping_cost,
                'total_amount' => (float) $order->total_amount,
                'shipping_address' => $order->shipping_address,
                'notes' => $order->notes_ar ?: $order->notes,
                'items' => $order->items->map(function ($item) {
                    return [
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'unit_price' => (float) $item->unit_price,
                        'subtotal' => (float) $item->subtotal,
                        'product' => $item->product ? [
                            'id' => $item->product->id,
                            'name' => $item->product->name_ar ?: $item->product->name,
                            'slug' => $item->product->slug,
                            'image' => $item->product->image,
                            'price' => (float) $item->product->price,
                        ] : null,
                    ];
                }),
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
            ];
        });

        return response()->json([
            'data' => [
                'success' => true,
                'en' => $enOrders,
                'ar' => $arOrders,
                'pagination' => [
                    'current_page' => $orders->currentPage(),
                    'last_page' => $orders->lastPage(),
                    'per_page' => $orders->perPage(),
                    'total' => $orders->total(),
                ],
            ],
        ]);
    }

    /**
     * Get order details
     *
     * Retrieve details of a specific order including all items.
     *
     * @authenticated
     *
     * @urlParam order integer required The order ID. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "data": {
     *     "id": 1,
     *     "order_number": "ORD-2024-001",
     *     "user_id": 1,
     *     "status": "pending",
     *     "payment_status": "paid",
     *     "subtotal": 100.00,
     *     "tax": 10.00,
     *     "shipping_cost": 15.00,
     *     "total_amount": 125.00,
     *     "items": [
     *       {
     *         "id": 1,
     *         "product_id": 5,
     *         "quantity": 2,
     *         "price": 50.00,
     *         "product": {"id": 5, "name": "Premium Coffee"}
     *       }
     *     ]
     *   }
     * }
     * @response 403 scenario="Forbidden" {
     *   "message": "This action is unauthorized."
     * }
     * @response 404 scenario="Not Found" {
     *   "message": "Order not found."
     * }
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
     * Create order (Deprecated)
     *
     * This endpoint is deprecated. Orders are now created only through the checkout flow after successful payment.
     *
     * @authenticated
     *
     * @response 422 scenario="Deprecated" {
     *   "success": false,
     *   "message": "Direct order creation is deprecated. Please use the checkout flow: POST /checkout/initiate",
     *   "checkout_url": "/checkout/initiate"
     * }
     *
     * @deprecated Use POST /api/checkout/initiate instead
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
     * Update order status
     *
     * Update the status of an order. This endpoint is typically used by administrators.
     *
     * @authenticated
     *
     * @urlParam order integer required The order ID. Example: 1
     *
     * @bodyParam status string required The new order status. Example: shipped
     * @bodyParam status_ar string Optional Arabic status text. Example: تم الشحن
     * @bodyParam payment_status string Optional payment status update. Example: paid
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "message": "Order status updated successfully",
     *   "data": {
     *     "id": 1,
     *     "order_number": "ORD-2024-001",
     *     "status": "shipped",
     *     "payment_status": "paid"
     *   }
     * }
     * @response 422 scenario="Validation Error" {
     *   "message": "The status field is required.",
     *   "errors": {"status": ["The status field is required."]}
     * }
     */
    public function updateStatus(Request $request, Order $order): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'status_ar' => 'nullable|string',
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
     * Cancel order
     *
     * Cancel an existing order. Only orders that haven't been shipped can be cancelled.
     *
     * @authenticated
     *
     * @urlParam order integer required The order ID. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "message": "Order cancelled successfully",
     *   "data": {
     *     "id": 1,
     *     "order_number": "ORD-2024-001",
     *     "status": "cancelled"
     *   }
     * }
     * @response 403 scenario="Forbidden" {
     *   "message": "This action is unauthorized."
     * }
     * @response 422 scenario="Cannot Cancel" {
     *   "success": false,
     *   "message": "Order cannot be cancelled after shipping."
     * }
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
     * Get order statistics
     *
     * Get aggregated order statistics. This endpoint is typically used by administrators for dashboard displays.
     *
     * @authenticated
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "data": {
     *     "total_orders": 150,
     *     "pending_orders": 25,
     *     "processing_orders": 30,
     *     "shipped_orders": 45,
     *     "delivered_orders": 40,
     *     "cancelled_orders": 10,
     *     "total_revenue": 15000.00,
     *     "pending_revenue": 2500.00
     *   }
     * }
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
