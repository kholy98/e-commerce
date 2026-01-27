import { Head, Link, router } from '@inertiajs/react';
import { Info, Search } from 'lucide-react';
import { useState } from 'react';

import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import AppLayout from '@/layouts/app-layout';
import { formatDate } from '@/lib/utils';
import { adminOrders, adminOrdersShow } from '@/routes';
import { type BreadcrumbItem } from '@/types';

interface OrderItem {
    id: number;
    product: {
        name: string;
        media?: { original_url: string }[];
    };
}

interface Order {
    id: number;
    order_number: string;
    status: string;
    status_ar: string;
    created_at: string;
    total_amount: string;
    user: {
        name: string;
    };
    items: OrderItem[];
}

interface Props {
    stats: {
        all: number;
        new: number;
        completed: number;
        cancelled: number;
    };
    orders: {
        data: Order[];
        links: { url: string | null; label: string; active: boolean }[];
        current_page: number;
        last_page: number;
        from: number | null;
        to: number | null;
        total: number;
    };
    filters: {
        search?: string;
        status?: string;
    };
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Order Management',
        href: adminOrders(),
    },
];

export default function OrdersIndex({ stats, orders, filters }: Props) {
    const [search, setSearch] = useState(filters.search || '');
    const activeTab = filters.status || 'all';

    const handleSearch = (e: React.FormEvent) => {
        e.preventDefault();
        router.get(
            adminOrders(),
            { ...filters, search, page: 1 },
            { preserveState: true },
        );
    };

    const handleTabChange = (status: string) => {
        const newFilters: any = { ...filters, status, page: 1 };
        if (status === 'all') delete newFilters.status;
        router.get(adminOrders(), newFilters, { preserveState: true });
    };

    const getStatusInfo = (status: string) => {
        switch (status) {
            case 'cancelled':
                return { label: 'cancelled', color: '#E74033', icon: 'truck' };
            case 'delivered':
                return {
                    label: 'تم الاستلام',
                    color: '#27AE60',
                    icon: 'truck',
                };
            case 'shipped':
                return { label: 'تم الشحن', color: '#2F3E75', icon: 'truck' };
            case 'processing':
                return {
                    label: 'بانتظار التسليم',
                    color: '#4FB0E3',
                    icon: 'truck',
                };
            case 'pending':
            default:
                return {
                    label: 'بانتظار الموافقه',
                    color: '#F39C12',
                    icon: 'truck',
                };
        }
    };

    const StatCard = ({ title, count }: { title: string; count: number }) => (
        <Card className="border-sidebar-border/50 shadow-sm transition-shadow hover:shadow-md">
            <CardContent className="flex items-center gap-4 p-6">
                <div className="flex h-14 w-14 items-center justify-center rounded-xl">
                    <div className="flex h-10 w-10 items-center justify-center rounded-lg shadow-sm">
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M3 21H21"
                                stroke="currentColor"
                                strokeWidth="1.5"
                                strokeLinecap="round"
                            />
                            <path
                                d="M5 21V7L12 3L19 7V21"
                                stroke="currentColor"
                                strokeWidth="1.5"
                                strokeLinejoin="round"
                            />
                            <path
                                d="M9 21V11H15V21"
                                stroke="currentColor"
                                strokeWidth="1.5"
                                strokeLinecap="round"
                                strokeLinejoin="round"
                            />
                            <path
                                d="M9 7H15"
                                stroke="currentColor"
                                strokeWidth="1.5"
                                strokeLinecap="round"
                            />
                        </svg>
                    </div>
                </div>
                <div>
                    <p className="text-sm font-medium">{title}</p>
                    <p className="text-3xl font-bold">{count}</p>
                </div>
            </CardContent>
        </Card>
    );

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Order Management" />

            <div className="flex h-full flex-1 flex-col gap-8 p-8">
                <div>
                    <h1 className="text-2xl font-bold">Order Management</h1>
                </div>

                {/* Stats Grid */}
                <div className="grid gap-6 md:grid-cols-4">
                    <StatCard title="All orders" count={stats.all} />
                    <StatCard title="New orders" count={stats.new} />
                    <StatCard
                        title="Completed orders"
                        count={stats.completed}
                    />
                    <StatCard
                        title="Cancelled orders"
                        count={stats.cancelled}
                    />
                </div>

                <Card className="border-none shadow-none">
                    <CardContent className="p-0">
                        <div className="mb-6 flex flex-col items-center justify-between gap-4 md:flex-row">
                            <form
                                onSubmit={handleSearch}
                                className="relative w-full max-w-sm"
                            >
                                <Search className="absolute top-1/2 left-3 h-4 w-4 -translate-y-1/2 text-muted-foreground" />
                                <Input
                                    placeholder="search"
                                    value={search}
                                    onChange={(e) => setSearch(e.target.value)}
                                    className="pl-10"
                                />
                            </form>

                            <div className="flex gap-1 rounded-lg p-1">
                                {[
                                    'all',
                                    'in-progress',
                                    'complete',
                                    'cancelled',
                                ].map((tab) => (
                                    <button
                                        key={tab}
                                        onClick={() => handleTabChange(tab)}
                                        className={`rounded-md px-6 py-2 text-sm capitalize transition-colors ${
                                            activeTab === tab
                                                ? 'bg-primary text-primary-foreground shadow-sm hover:bg-white/50'
                                                : ''
                                        }`}
                                    >
                                        {tab === 'all'
                                            ? `All orders (${orders.total})`
                                            : tab.replace('-', ' ')}
                                    </button>
                                ))}
                            </div>
                        </div>

                        <div className="overflow-hidden rounded-xl border border-sidebar-border/50">
                            <Table>
                                <TableHeader>
                                    <TableRow className="hover:bg-transparent">
                                        <TableHead className="font-semibold">
                                            Order Number
                                        </TableHead>
                                        <TableHead className="font-semibold">
                                            The product
                                        </TableHead>
                                        <TableHead className="font-semibold">
                                            Case
                                        </TableHead>
                                        <TableHead className="font-semibold">
                                            Client Name
                                        </TableHead>
                                        <TableHead className="font-semibold">
                                            History
                                        </TableHead>
                                        <TableHead className="font-semibold">
                                            Order Status
                                        </TableHead>
                                        <TableHead className="w-[100px] font-semibold">
                                            Information
                                        </TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    {orders.data.map((order) => {
                                        const firstItem = order.items?.[0];
                                        const productImage =
                                            firstItem?.product?.media?.[0]
                                                ?.original_url || '';
                                        const productName =
                                            firstItem?.product?.name ||
                                            'Unknown Product';

                                        return (
                                            <TableRow
                                                key={order.id}
                                                className="border-b/50 py-4"
                                            >
                                                <TableCell className="font-medium">
                                                    #{order.order_number}
                                                </TableCell>
                                                <TableCell>
                                                    <div className="flex items-center gap-3">
                                                        <div className="flex h-10 w-10 items-center justify-center rounded-lg bg-[#F5F5F5] p-2">
                                                            {productImage ? (
                                                                <img
                                                                    src={
                                                                        productImage
                                                                    }
                                                                    alt={
                                                                        productName
                                                                    }
                                                                    className="h-full w-full object-contain"
                                                                />
                                                            ) : (
                                                                <div className="bg-brown-200 h-6 w-6" />
                                                            )}
                                                        </div>
                                                        <span className="text-sm font-medium">
                                                            {productName}
                                                        </span>
                                                    </div>
                                                </TableCell>
                                                <TableCell>
                                                    <div
                                                        className="flex items-center gap-2"
                                                        style={{
                                                            color: getStatusInfo(
                                                                order.status,
                                                            ).color,
                                                        }}
                                                    >
                                                        <span className="text-sm font-medium">
                                                            {order.status_ar ||
                                                                getStatusInfo(
                                                                    order.status,
                                                                ).label}
                                                        </span>
                                                        <svg
                                                            width="20"
                                                            height="20"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path
                                                                d="M16 3H1V16H16V3Z"
                                                                stroke="currentColor"
                                                                strokeWidth="2"
                                                                strokeLinecap="round"
                                                                strokeLinejoin="round"
                                                            />
                                                            <path
                                                                d="M16 8H20L23 11V16H16V8Z"
                                                                stroke="currentColor"
                                                                strokeWidth="2"
                                                                strokeLinecap="round"
                                                                strokeLinejoin="round"
                                                            />
                                                            <circle
                                                                cx="5.5"
                                                                cy="18.5"
                                                                r="2.5"
                                                                stroke="currentColor"
                                                                strokeWidth="2"
                                                            />
                                                            <circle
                                                                cx="18.5"
                                                                cy="18.5"
                                                                r="2.5"
                                                                stroke="currentColor"
                                                                strokeWidth="2"
                                                            />
                                                        </svg>
                                                    </div>
                                                </TableCell>
                                                <TableCell className="">
                                                    {order.user?.name}
                                                </TableCell>
                                                <TableCell className="">
                                                    {formatDate(
                                                        order.created_at,
                                                    )}
                                                </TableCell>
                                                <TableCell>
                                                    <span className="text-sm">
                                                        {order.status}
                                                    </span>
                                                </TableCell>
                                                <TableCell>
                                                    <Link
                                                        href={adminOrdersShow(
                                                            order.id,
                                                        )}
                                                        className="flex h-8 w-8 items-center justify-center rounded-full bg-[#F5B575]/20 text-[#F5B575]"
                                                    >
                                                        <Info className="h-5 w-5" />
                                                    </Link>
                                                </TableCell>
                                            </TableRow>
                                        );
                                    })}
                                    {orders.data.length === 0 && (
                                        <TableRow>
                                            <TableCell
                                                colSpan={7}
                                                className="h-24 text-center text-muted-foreground"
                                            >
                                                No orders found.
                                            </TableCell>
                                        </TableRow>
                                    )}
                                </TableBody>
                            </Table>
                        </div>

                        {/* Pagination */}
                        {orders.last_page > 1 && (
                            <div className="mt-6 flex items-center justify-between">
                                <p className="text-sm text-muted-foreground">
                                    Showing {orders.from} to {orders.to} of{' '}
                                    {orders.total} entries
                                </p>
                                <div className="flex gap-2">
                                    <Button
                                        variant="outline"
                                        size="sm"
                                        disabled={orders.current_page === 1}
                                        onClick={() =>
                                            orders.links[0].url &&
                                            router.get(orders.links[0].url)
                                        }
                                    >
                                        Previous
                                    </Button>
                                    <Button
                                        variant="outline"
                                        size="sm"
                                        disabled={
                                            orders.current_page ===
                                            orders.last_page
                                        }
                                        onClick={() =>
                                            orders.links[
                                                orders.links.length - 1
                                            ].url &&
                                            router.get(
                                                orders.links[
                                                    orders.links.length - 1
                                                ].url as string,
                                            )
                                        }
                                    >
                                        Next
                                    </Button>
                                </div>
                            </div>
                        )}
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
