<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Get dashboard statistics
     */
    public function stats(): JsonResponse
    {
        $stats = [
            'total_users' => User::count(),
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_orders' => Order::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'low_stock_products' => Product::where('stock', '<=', 10)->count(),
            'pending_orders' => Order::where('status', Order::STATUS_PENDING)->count(),
            'total_revenue' => (float) Order::where('payment_status', Order::PAYMENT_STATUS_PAID)
                ->sum('total_amount'),
        ];

        // Distribution data for donut charts
        $customer_stats = [
            'new' => User::where('created_at', '>=', now()->subDays(30))->count(),
            'active' => Order::distinct('user_id')->count(), // Simplified: any user with an order
            'total' => User::count(),
        ];

        $user_stats = [
            'admins' => User::where('is_admin', true)->count(),
            'customers' => User::where('is_admin', false)->count(),
        ];

        $order_stats = [
            'complete' => Order::where('status', Order::STATUS_DELIVERED)->count(),
            'canceled' => Order::where('status', Order::STATUS_CANCELLED)->count(),
            'pending' => Order::where('status', Order::STATUS_PENDING)->count(),
            'total' => Order::count(),
        ];

        return response()->json([
            'success' => true,
            'data' => array_merge($stats, [
                'customer_stats' => $customer_stats,
                'user_stats' => $user_stats,
                'order_stats' => $order_stats,
            ]),
        ]);
    }

    /**
     * Get database-specific date extraction function
     */
    private function getDateFunction(string $unit): string
    {
        $driver = DB::getDriverName();

        return match ($unit) {
            'hour' => $driver === 'sqlite' ? "strftime('%H', created_at)" : 'HOUR(created_at)',
            'month' => $driver === 'sqlite' ? "strftime('%m', created_at)" : 'MONTH(created_at)',
            'day' => $driver === 'sqlite' ? "strftime('%d', created_at)" : 'DAY(created_at)',
            default => throw new \InvalidArgumentException("Unknown date unit: {$unit}")
        };
    }

    /**
     * Get revenue chart data
     */
    public function revenueChart(): JsonResponse
    {
        $period = request()->query('period', 'daily');
        $query = Order::where('payment_status', Order::PAYMENT_STATUS_PAID);

        if ($period === 'yearly') {
            $revenue = $query->where('created_at', '>=', now()->startOfYear())
                ->select(
                    DB::raw($this->getDateFunction('month').' as label'),
                    DB::raw('SUM(total_amount) as total')
                )
                ->groupBy('label')
                ->orderBy('label')
                ->get()
                ->map(function ($item) {
                    return [
                        'name' => Carbon::create()->month($item->label)->format('M'),
                        'value' => (float) $item->total,
                    ];
                });
        } elseif ($period === 'monthly') {
            $revenue = $query->where('created_at', '>=', now()->startOfMonth())
                ->select(
                    DB::raw($this->getDateFunction('day').' as label'),
                    DB::raw('SUM(total_amount) as total')
                )
                ->groupBy('label')
                ->orderBy('label')
                ->get()
                ->map(function ($item) {
                    return [
                        'name' => 'Day '.$item->label,
                        'value' => (float) $item->total,
                    ];
                });
        } else {
            // Daily (Hourly)
            $revenue = $query->where('created_at', '>=', now()->startOfDay())
                ->select(
                    DB::raw($this->getDateFunction('hour').' as label'),
                    DB::raw('SUM(total_amount) as total')
                )
                ->groupBy('label')
                ->orderBy('label')
                ->get()
                ->map(function ($item) {
                    return [
                        'name' => Carbon::createFromTime($item->label)->format('hA'),
                        'value' => (float) $item->total,
                    ];
                });
        }

        return response()->json([
            'success' => true,
            'data' => $revenue,
        ]);
    }

    /**
     * Get best selling products
     */
    public function bestSellers(): JsonResponse
    {
        $bestSellers = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_sales'))
            ->groupBy('product_id')
            ->orderByDesc('total_sales')
            ->limit(5)
            ->with(['product' => function ($query) {
                $query->with('category');
            }])
            ->get()
            ->map(function ($item) {
                if (! $item->product) {
                    return null;
                }

                return [
                    'id' => $item->product->id,
                    'name' => $item->product->name,
                    'flavor' => $item->product->grind_type, // Using grind_type as flavor context
                    'price' => (float) $item->product->price,
                    'sales' => (int) $item->total_sales,
                    'condition' => 'Successful', // Dummy condition as requested in visual
                    'image' => $item->product->getFirstMediaUrl('images', 'thumb') ?: 'https://placehold.co/40x40/5D3E1D/white?text='.urlencode(substr($item->product->name, 0, 1)),
                ];
            })
            ->filter();

        return response()->json([
            'success' => true,
            'data' => $bestSellers->values(),
        ]);
    }

    /**
     * Get recent products
     */
    public function recentProducts(): JsonResponse
    {
        $products = Product::with('category')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => (float) $product->price,
                    'stock' => $product->stock,
                    'is_active' => $product->is_active,
                    'category' => $product->category ? $product->category->name : null,
                    'created_at' => $product->created_at->format('Y-m-d'),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    /**
     * Get all categories
     */
    public function categories(): JsonResponse
    {
        $categories = Category::orderBy('name')
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'product_count' => $category->products()->count(),
                    'created_at' => $category->created_at->format('Y-m-d'),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }
}
