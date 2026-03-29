import { Head, Link, router } from '@inertiajs/react';
import { Eye, Search } from 'lucide-react';
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
import SupplierLayout from '@/layouts/supplier-layout';
import { formatDate } from '@/lib/utils';
import { type BreadcrumbItem } from '@/types';

interface OrderItem {
    id: number;
    product_name: string;
    quantity: number;
}

interface Order {
    id: number;
    order_number: string;
    status: string;
    status_ar: string;
    payment_status: string;
    tracking_number: string | null;
    shipment_status: string | null;
    created_at: string;
    customer: {
        id: number;
        name: string;
        email: string;
    } | null;
    items: OrderItem[];
}

interface Props {
    stats: {
        total_orders: number;
        pending_orders: number;
        processing_orders: number;
        shipped_orders: number;
        delivered_orders: number;
        cancelled_orders: number;
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
        title: 'Supplier Dashboard',
        href: '/supplier/dashboard',
    },
];

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

export default function SupplierDashboard({ stats, orders, filters }: Props) {
    const [search, setSearch] = useState(filters.search || '');
    const activeTab = filters.status || 'all';

    const handleSearch = (e: React.FormEvent) => {
        e.preventDefault();
        router.get(
            '/supplier/dashboard',
            { ...filters, search, page: 1 },
            { preserveState: true },
        );
    };

    const handleTabChange = (status: string) => {
        const newFilters: any = { ...filters, status, page: 1 };
        if (status === 'all') delete newFilters.status;
        router.get('/supplier/dashboard', newFilters, { preserveState: true });
    };

    const getStatusInfo = (status: string) => {
        switch (status) {
            case 'cancelled':
                return { label: 'Cancelled', color: '#E74033' };
            case 'delivered':
                return { label: 'Delivered', color: '#27AE60' };
            case 'shipped':
                return { label: 'Shipped', color: '#2F3E75' };
            case 'processing':
                return { label: 'Processing', color: '#4FB0E3' };
            case 'pending':
            default:
                return { label: 'Pending', color: '#F39C12' };
        }
    };

    return (
        <SupplierLayout breadcrumbs={breadcrumbs}>
            <Head title="Supplier Dashboard" />

            <div className="flex h-full flex-1 flex-col gap-8 p-8">
                <div>
                    <h1 className="text-2xl font-bold">Supplier Dashboard</h1>
                </div>

                {/* Stats Grid */}
                <div className="grid gap-6 md:grid-cols-5">
                    <StatCard title="All Orders" count={stats.total_orders} />
                    <StatCard title="Pending" count={stats.pending_orders} />
                    <StatCard
                        title="Processing"
                        count={stats.processing_orders}
                    />
                    <StatCard title="Shipped" count={stats.shipped_orders} />
                    <StatCard
                        title="Delivered"
                        count={stats.delivered_orders}
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
                                    placeholder="Search orders..."
                                    value={search}
                                    onChange={(e) => setSearch(e.target.value)}
                                    className="pl-10"
                                />
                            </form>

                            <div className="flex gap-1 rounded-lg p-1">
                                {[
                                    'all',
                                    'pending',
                                    'processing',
                                    'shipped',
                                    'delivered',
                                    'cancelled',
                                ].map((tab) => (
                                    <button
                                        key={tab}
                                        onClick={() => handleTabChange(tab)}
                                        className={`rounded-md px-4 py-2 text-sm capitalize transition-colors ${
                                            activeTab === tab
                                                ? 'bg-primary text-primary-foreground shadow-sm hover:bg-white/50'
                                                : ''
                                        }`}
                                    >
                                        {tab}
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
                                            Products
                                        </TableHead>
                                        <TableHead className="font-semibold">
                                            Status
                                        </TableHead>
                                        <TableHead className="font-semibold">
                                            Customer
                                        </TableHead>
                                        <TableHead className="font-semibold">
                                            Date
                                        </TableHead>
                                        <TableHead className="font-semibold">
                                            Update Status
                                        </TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    {orders.data.map((order) => (
                                        <TableRow
                                            key={order.id}
                                            className="border-b/50 py-4"
                                        >
                                            <TableCell className="font-medium">
                                                #{order.order_number}
                                            </TableCell>
                                            <TableCell>
                                                <div className="flex flex-col gap-1">
                                                    {order.items.map((item) => (
                                                        <span
                                                            key={item.id}
                                                            className="text-sm"
                                                        >
                                                            {item.product_name}{' '}
                                                            (x{item.quantity})
                                                        </span>
                                                    ))}
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
                                                </div>
                                            </TableCell>
                                            <TableCell>
                                                {order.customer?.name || 'N/A'}
                                            </TableCell>
                                            <TableCell>
                                                {formatDate(order.created_at)}
                                            </TableCell>
                                            <TableCell>
                                                <div className="flex items-center gap-2">
                                                    <Link
                                                        href={`/supplier/orders/${order.id}`}
                                                    >
                                                        <Button
                                                            variant="outline"
                                                            size="sm"
                                                        >
                                                            <Eye className="mr-1 h-4 w-4" />
                                                            View
                                                        </Button>
                                                    </Link>
                                                    <StatusUpdateModal
                                                        order={order}
                                                    />
                                                </div>
                                            </TableCell>
                                        </TableRow>
                                    ))}
                                    {orders.data.length === 0 && (
                                        <TableRow>
                                            <TableCell
                                                colSpan={6}
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
        </SupplierLayout>
    );
}

import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';

function StatusUpdateModal({ order }: { order: Order }) {
    const [status, setStatus] = useState(order.status);
    const [open, setOpen] = useState(false);
    const [processing, setProcessing] = useState(false);

    const handleUpdate = () => {
        setProcessing(true);
        router.patch(
            `/supplier/orders/${order.id}/status`,
            { status },
            {
                onSuccess: () => {
                    setOpen(false);
                    setProcessing(false);
                },
                onError: () => {
                    setProcessing(false);
                },
            },
        );
    };

    return (
        <Dialog open={open} onOpenChange={setOpen}>
            <DialogTrigger asChild>
                <Button variant="outline" size="sm">
                    Update
                </Button>
            </DialogTrigger>
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Update Order Status</DialogTitle>
                    <DialogDescription>
                        Order #{order.order_number}
                    </DialogDescription>
                </DialogHeader>
                <div className="py-4">
                    <Select value={status} onValueChange={setStatus}>
                        <SelectTrigger>
                            <SelectValue placeholder="Select status" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem value="pending">Pending</SelectItem>
                            <SelectItem value="processing">
                                Processing
                            </SelectItem>
                            <SelectItem value="shipped">Shipped</SelectItem>
                            <SelectItem value="delivered">Delivered</SelectItem>
                            <SelectItem value="cancelled">Cancelled</SelectItem>
                        </SelectContent>
                    </Select>
                </div>
                <DialogFooter>
                    <Button variant="outline" onClick={() => setOpen(false)}>
                        Cancel
                    </Button>
                    <Button
                        onClick={handleUpdate}
                        disabled={processing || status === order.status}
                    >
                        {processing ? 'Updating...' : 'Update Status'}
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    );
}
