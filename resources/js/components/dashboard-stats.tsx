import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import {
    AlertTriangle,
    DollarSign,
    FolderOpen,
    Package,
    ShoppingCart,
    Users,
} from 'lucide-react';

interface DashboardStatsProps {
    stats: {
        total_users: number;
        total_products: number;
        total_categories: number;
        total_orders: number;
        active_products: number;
        low_stock_products: number;
        pending_orders: number;
        total_revenue: number;
    };
}

export function DashboardStats({ stats }: DashboardStatsProps) {
    const statItems = [
        {
            title: 'Total Users',
            value: stats.total_users,
            icon: Users,
            color: 'text-blue-600',
        },
        {
            title: 'Total Products',
            value: stats.total_products,
            icon: Package,
            color: 'text-green-600',
        },
        {
            title: 'Active Products',
            value: stats.active_products,
            icon: Package,
            color: 'text-emerald-600',
        },
        {
            title: 'Total Categories',
            value: stats.total_categories,
            icon: FolderOpen,
            color: 'text-purple-600',
        },
        {
            title: 'Total Orders',
            value: stats.total_orders,
            icon: ShoppingCart,
            color: 'text-orange-600',
        },
        {
            title: 'Pending Orders',
            value: stats.pending_orders,
            icon: ShoppingCart,
            color: 'text-yellow-600',
        },
        {
            title: 'Total Revenue',
            value: `$${parseFloat(stats.total_revenue || 0).toFixed(2)}`,
            icon: DollarSign,
            color: 'text-green-600',
        },
        {
            title: 'Low Stock Products',
            value: stats.low_stock_products,
            icon: AlertTriangle,
            color: 'text-red-600',
        },
    ];

    return (
        <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
            {statItems.map((item) => (
                <Card key={item.title}>
                    <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                        <CardTitle className="text-sm font-medium">
                            {item.title}
                        </CardTitle>
                        <item.icon className={`h-4 w-4 ${item.color}`} />
                    </CardHeader>
                    <CardContent>
                        <div className="text-2xl font-bold">{item.value}</div>
                        {item.title === 'Low Stock Products' &&
                            item.value > 0 && (
                                <Badge variant="destructive" className="mt-1">
                                    Attention Required
                                </Badge>
                            )}
                    </CardContent>
                </Card>
            ))}
        </div>
    );
}
