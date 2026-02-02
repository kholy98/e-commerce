import { BestSellerTable } from '@/components/dashboard/BestSellerTable';
import { DonutCharts } from '@/components/dashboard/DonutCharts';
import { RevenueChart } from '@/components/dashboard/RevenueChart';
import { StatCard } from '@/components/dashboard/StatCard';
import AppLayout from '@/layouts/app-layout';
import { dashboard } from '@/routes';
import { bestSellers, revenue, stats } from '@/routes/dashboard';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import { FileText, ShoppingBag, TrendingUp, Users } from 'lucide-react';
import { useEffect, useState } from 'react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

interface DashboardData {
    stats: {
        total_users: number;
        total_products: number;
        total_categories: number;
        total_orders: number;
        active_products: number;
        low_stock_products: number;
        pending_orders: number;
        total_revenue: number;
        customer_stats: {
            new: number;
            active: number;
            total: number;
        };
        user_stats: {
            admins: number;
            customers: number;
        };
        order_stats: {
            complete: number;
            canceled: number;
            pending: number;
            total: number;
        };
    };
    revenue: any[];
    bestSellers: any[];
}

export default function Dashboard() {
    const { auth } = usePage<SharedData>().props;
    const [data, setData] = useState<DashboardData | null>(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchDashboardData = async () => {
            try {
                const fetchOptions = {
                    headers: {
                        Accept: 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    credentials: 'same-origin' as const,
                };

                const [statsRes, revenueRes, bestSellersRes] =
                    await Promise.all([
                        fetch(stats.url(), fetchOptions),
                        fetch(revenue.url(), fetchOptions),
                        fetch(bestSellers.url(), fetchOptions),
                    ]);

                // Check if responses are OK before parsing JSON
                if (!statsRes.ok || !revenueRes.ok || !bestSellersRes.ok) {
                    if (
                        statsRes.status === 403 ||
                        revenueRes.status === 403 ||
                        bestSellersRes.status === 403
                    ) {
                        console.error(
                            'Access denied: Admin privileges required',
                        );
                        // Redirect to login if not authorized
                        window.location.href = '/login';
                        return;
                    }
                    throw new Error('Failed to fetch dashboard data');
                }

                const [statsData, revenueData, bestSellersData] =
                    await Promise.all([
                        statsRes.json(),
                        revenueRes.json(),
                        bestSellersRes.json(),
                    ]);

                setData({
                    stats: statsData.data,
                    revenue: revenueData.data,
                    bestSellers: bestSellersData.data,
                });
            } catch (error) {
                console.error('Failed to fetch dashboard data:', error);
            } finally {
                setLoading(false);
            }
        };

        fetchDashboardData();
    }, []);

    if (loading) {
        return (
            <AppLayout breadcrumbs={breadcrumbs}>
                <Head title="Dashboard" />
                <div className="flex h-full flex-1 flex-col gap-4 p-4 md:p-8">
                    <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        {[...Array(4)].map((_, i) => (
                            <div
                                key={i}
                                className="h-40 animate-pulse rounded-lg bg-muted/50"
                            />
                        ))}
                    </div>
                </div>
            </AppLayout>
        );
    }

    if (!data) return null;

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />

            <div className="relative min-h-screen">
                {/* Gradient Backdrop */}
                <div className="pointer-events-none absolute top-0 right-0 left-0 h-[400px] bg-linear-to-b from-[#5D3E1D]/40 via-[#5D3E1D]/10 to-transparent" />

                <div className="relative z-10 flex h-full flex-1 flex-col gap-8 p-4 md:p-8">
                    {/* Stats Grid */}
                    <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        <StatCard
                            title="All products"
                            value={data.stats?.total_products ?? 0}
                            icon={FileText}
                        />
                        <StatCard
                            title="All revenue"
                            value={`${(data.stats?.total_revenue ?? 0).toLocaleString()} EGP`}
                            icon={TrendingUp}
                        />
                        <StatCard
                            title="All customers"
                            value={data.stats?.total_users ?? 0}
                            icon={Users}
                        />
                        <StatCard
                            title="All orders"
                            value={data.stats?.total_orders ?? 0}
                            icon={ShoppingBag}
                        />
                    </div>

                    {/* Middle Charts Grid */}
                    <div className="grid grid-cols-1 gap-6 lg:grid-cols-4">
                        <div className="lg:col-span-3">
                            <RevenueChart data={data.revenue ?? []} />
                        </div>
                        <div className="lg:col-span-1">
                            <DonutCharts
                                customerStats={
                                    data.stats?.customer_stats ?? {
                                        new: 0,
                                        active: 0,
                                        total: 0,
                                    }
                                }
                                userStats={
                                    data.stats?.user_stats ?? {
                                        admins: 0,
                                        customers: 0,
                                    }
                                }
                                orderStats={
                                    data.stats?.order_stats ?? {
                                        complete: 0,
                                        canceled: 0,
                                        pending: 0,
                                        total: 0,
                                    }
                                }
                            />
                        </div>
                    </div>

                    {/* Bottom Table */}
                    <BestSellerTable products={data.bestSellers ?? []} />
                </div>
            </div>
        </AppLayout>
    );
}
