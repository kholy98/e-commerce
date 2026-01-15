import { Head, usePage } from '@inertiajs/react';
import { useEffect, useState } from 'react';

import { CategoriesModule } from '@/components/categories-module';
import { DashboardStats } from '@/components/dashboard-stats';
import { ProductsModule } from '@/components/products-module';
import AppLayout from '@/layouts/app-layout';
import {
    dashboard,
    dashboardCategories,
    dashboardProducts,
    dashboardStats,
} from '@/routes';
import { type BreadcrumbItem, type SharedData } from '@/types';

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
    };
    products: Array<{
        id: number;
        name: string;
        price: number;
        stock: number;
        is_active: boolean;
        category: string | null;
        created_at: string;
    }>;
    categories: Array<{
        id: number;
        name: string;
        slug: string;
        product_count: number;
        created_at: string;
    }>;
}

export default function Dashboard() {
    const { auth } = usePage<SharedData>().props;
    const [data, setData] = useState<DashboardData | null>(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchDashboardData = async () => {
            try {
                const [statsResponse, productsResponse, categoriesResponse] =
                    await Promise.all([
                        fetch(dashboardStats().url, {
                            headers: {
                                Accept: 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                            credentials: 'same-origin',
                        }),
                        fetch(dashboardProducts().url, {
                            headers: {
                                Accept: 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                            credentials: 'same-origin',
                        }),
                        fetch(dashboardCategories().url, {
                            headers: {
                                Accept: 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                            credentials: 'same-origin',
                        }),
                    ]);

                const [statsData, productsData, categoriesData] =
                    await Promise.all([
                        statsResponse.json(),
                        productsResponse.json(),
                        categoriesResponse.json(),
                    ]);

                setData({
                    stats: statsData.data,
                    products: productsData.data,
                    categories: categoriesData.data,
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
                <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                    <div className="grid auto-rows-min gap-4 md:grid-cols-3">
                        {[...Array(8)].map((_, i) => (
                            <div
                                key={i}
                                className="relative aspect-video animate-pulse overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
                            >
                                <div className="absolute inset-0 bg-muted" />
                            </div>
                        ))}
                    </div>
                    <div className="relative min-h-[50vh] flex-1 animate-pulse overflow-hidden rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                        <div className="absolute inset-0 bg-muted" />
                    </div>
                </div>
            </AppLayout>
        );
    }

    if (!data) {
        return (
            <AppLayout breadcrumbs={breadcrumbs}>
                <Head title="Dashboard" />
                <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                    <div className="py-8 text-center">
                        <p className="text-muted-foreground">
                            Failed to load dashboard data
                        </p>
                    </div>
                </div>
            </AppLayout>
        );
    }

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <DashboardStats stats={data.stats} />

                <div className="grid gap-4 md:grid-cols-2">
                    <ProductsModule products={data.products} />
                    <CategoriesModule categories={data.categories} />
                </div>
            </div>
        </AppLayout>
    );
}
