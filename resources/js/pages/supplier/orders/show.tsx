import { Head, Link, router } from '@inertiajs/react';
import { ArrowLeft, MapPin, Package, User } from 'lucide-react';
import { useState } from 'react';

import { Button } from '@/components/ui/button';
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
import SupplierLayout from '@/layouts/supplier-layout';
import { formatDate } from '@/lib/utils';
import { type BreadcrumbItem } from '@/types';

interface OrderItem {
    id: number;
    product_name: string;
    product_image: string | null;
    quantity: number;
}

interface Address {
    first_name?: string;
    last_name?: string;
    name?: string;
    email?: string;
    phone?: string;
    street?: string;
    building_number?: string;
    floor?: string;
    apartment?: string;
    zone?: string;
    city?: string;
    zip_code?: string;
    country?: string;
}

interface Customer {
    name: string;
    email: string | null;
    phone: string | null;
}

interface Order {
    id: number;
    order_number: string;
    status: string;
    status_ar: string | null;
    payment_status: string;
    payment_method: string;
    tracking_number: string | null;
    shipment_status: string | null;
    shipping_address: Address | null;
    billing_address: Address | null;
    notes: string | null;
    created_at: string;
    updated_at: string;
    customer: Customer;
    items: OrderItem[];
}

interface Props {
    order: Order;
}

export default function SupplierOrderShow({ order }: Props) {
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Supplier Dashboard',
            href: '/supplier/dashboard',
        },
        {
            title: `#${order.order_number}`,
            href: `/supplier/orders/${order.id}`,
        },
    ];

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

    const formatAddress = (address: Address | null) => {
        if (!address) return null;
        return address;
    };

    const statusInfo = getStatusInfo(order.status);

    return (
        <SupplierLayout breadcrumbs={breadcrumbs}>
            <Head title={`Order #${order.order_number}`} />

            <div className="flex h-full flex-1 flex-col gap-8 p-8">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-4">
                        <Link
                            href="/supplier/dashboard"
                            className="flex h-10 w-10 items-center justify-center rounded-full shadow-sm ring-1 ring-sidebar-border transition-colors hover:bg-muted"
                        >
                            <ArrowLeft className="h-5 w-5" />
                        </Link>
                        <div>
                            <h1 className="text-2xl font-bold">
                                Order #{order.order_number}
                            </h1>
                            <p className="text-sm text-muted-foreground">
                                Placed on {formatDate(order.created_at)}
                            </p>
                        </div>
                    </div>
                    <StatusUpdateModal order={order} />
                </div>

                <div className="grid gap-6 md:grid-cols-3">
                    <div className="flex flex-col gap-6 md:col-span-2">
                        {/* Order Status Card */}
                        <div className="rounded-xl border border-sidebar-border/50 p-6 shadow-sm">
                            <h2 className="mb-4 flex items-center gap-2 text-lg font-semibold">
                                <Package className="h-5 w-5" />
                                Order Information
                            </h2>
                            <div className="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <p className="text-sm text-muted-foreground">
                                        Order Number
                                    </p>
                                    <p className="font-medium">
                                        #{order.order_number}
                                    </p>
                                </div>
                                <div>
                                    <p className="text-sm text-muted-foreground">
                                        Status
                                    </p>
                                    <p
                                        className="font-medium capitalize"
                                        style={{ color: statusInfo.color }}
                                    >
                                        {order.status_ar || statusInfo.label}
                                    </p>
                                </div>
                                <div>
                                    <p className="text-sm text-muted-foreground">
                                        Payment Method
                                    </p>
                                    <p className="font-medium uppercase">
                                        {order.payment_method === 'cod'
                                            ? 'Cash on Delivery'
                                            : 'Online Payment'}
                                    </p>
                                </div>
                                <div>
                                    <p className="text-sm text-muted-foreground">
                                        Payment Status
                                    </p>
                                    <p className="font-medium capitalize">
                                        {order.payment_status}
                                    </p>
                                </div>
                                {order.tracking_number && (
                                    <div>
                                        <p className="text-sm text-muted-foreground">
                                            Tracking Number
                                        </p>
                                        <p className="font-mono font-medium">
                                            {order.tracking_number}
                                        </p>
                                    </div>
                                )}
                                {order.shipment_status && (
                                    <div>
                                        <p className="text-sm text-muted-foreground">
                                            Shipment Status
                                        </p>
                                        <p className="font-medium capitalize">
                                            {order.shipment_status}
                                        </p>
                                    </div>
                                )}
                            </div>
                        </div>

                        {/* Order Items */}
                        <div className="rounded-xl border border-sidebar-border/50 p-6 shadow-sm">
                            <h2 className="mb-4 flex items-center gap-2 text-lg font-semibold">
                                <Package className="h-5 w-5" />
                                Order Items ({order.items.length})
                            </h2>
                            <div className="flex flex-col gap-4">
                                {order.items.map((item) => (
                                    <div
                                        key={item.id}
                                        className="flex items-center gap-4 rounded-lg border border-sidebar-border/30 p-4"
                                    >
                                        <div className="flex h-16 w-16 items-center justify-center rounded-lg bg-muted">
                                            {item.product_image ? (
                                                <img
                                                    src={item.product_image}
                                                    alt={item.product_name}
                                                    className="h-full w-full rounded-lg object-contain"
                                                />
                                            ) : (
                                                <Package className="h-6 w-6 text-muted-foreground" />
                                            )}
                                        </div>
                                        <div className="flex-1">
                                            <p className="font-medium">
                                                {item.product_name}
                                            </p>
                                            <p className="text-sm text-muted-foreground">
                                                Quantity: {item.quantity}
                                            </p>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* Notes */}
                        {order.notes && (
                            <div className="rounded-xl border border-sidebar-border/50 p-6 shadow-sm">
                                <h2 className="mb-4 text-lg font-semibold">
                                    Order Notes
                                </h2>
                                <p className="text-sm leading-relaxed text-muted-foreground">
                                    {order.notes}
                                </p>
                            </div>
                        )}
                    </div>

                    <div className="flex flex-col gap-6">
                        {/* Customer Info */}
                        <div className="rounded-xl border border-sidebar-border/50 p-6 shadow-sm">
                            <h2 className="mb-4 flex items-center gap-2 text-lg font-semibold">
                                <User className="h-5 w-5" />
                                Customer Information
                            </h2>
                            <div className="flex flex-col gap-3">
                                <div>
                                    <p className="text-sm text-muted-foreground">
                                        Name
                                    </p>
                                    <p className="font-medium">
                                        {order.customer.name}
                                    </p>
                                </div>
                                {order.customer.email && (
                                    <div>
                                        <p className="text-sm text-muted-foreground">
                                            Email
                                        </p>
                                        <p className="font-medium">
                                            {order.customer.email}
                                        </p>
                                    </div>
                                )}
                                {order.customer.phone && (
                                    <div>
                                        <p className="text-sm text-muted-foreground">
                                            Phone
                                        </p>
                                        <p className="font-medium" dir="ltr">
                                            {order.customer.phone}
                                        </p>
                                    </div>
                                )}
                            </div>
                        </div>

                        {/* Shipping Address */}
                        <div className="rounded-xl border border-sidebar-border/50 p-6 shadow-sm">
                            <h2 className="mb-4 flex items-center gap-2 text-lg font-semibold">
                                <MapPin className="h-5 w-5" />
                                Shipping Address
                            </h2>
                            {formatAddress(order.shipping_address) ? (
                                <div className="flex flex-col gap-2 text-sm">
                                    {(order.shipping_address?.first_name ||
                                        order.shipping_address?.name) && (
                                        <p>
                                            <span className="text-muted-foreground">
                                                Name:{' '}
                                            </span>
                                            <span className="font-medium">
                                                {order.shipping_address
                                                    .first_name
                                                    ? `${order.shipping_address.first_name} ${order.shipping_address.last_name ?? ''}`.trim()
                                                    : order.shipping_address
                                                          .name}
                                            </span>
                                        </p>
                                    )}
                                    {order.shipping_address?.phone && (
                                        <p dir="ltr">
                                            <span className="text-muted-foreground">
                                                Phone:{' '}
                                            </span>
                                            <span className="font-medium">
                                                {order.shipping_address.phone}
                                            </span>
                                        </p>
                                    )}
                                    {order.shipping_address?.street && (
                                        <p>
                                            <span className="text-muted-foreground">
                                                Street:{' '}
                                            </span>
                                            <span className="font-medium">
                                                {order.shipping_address.street}
                                            </span>
                                        </p>
                                    )}
                                    {(order.shipping_address?.building_number ||
                                        order.shipping_address?.floor ||
                                        order.shipping_address?.apartment) && (
                                        <p>
                                            <span className="text-muted-foreground">
                                                Building:{' '}
                                            </span>
                                            <span className="font-medium">
                                                {[
                                                    order.shipping_address
                                                        .building_number,
                                                    order.shipping_address
                                                        .floor &&
                                                        `Floor ${order.shipping_address.floor}`,
                                                    order.shipping_address
                                                        .apartment &&
                                                        `Apt ${order.shipping_address.apartment}`,
                                                ]
                                                    .filter(Boolean)
                                                    .join(', ')}
                                            </span>
                                        </p>
                                    )}
                                    {order.shipping_address?.zone && (
                                        <p>
                                            <span className="text-muted-foreground">
                                                Zone:{' '}
                                            </span>
                                            <span className="font-medium">
                                                {order.shipping_address.zone}
                                            </span>
                                        </p>
                                    )}
                                    {order.shipping_address?.city && (
                                        <p>
                                            <span className="text-muted-foreground">
                                                City:{' '}
                                            </span>
                                            <span className="font-medium">
                                                {order.shipping_address.city}
                                                {order.shipping_address
                                                    .zip_code &&
                                                    `, ${order.shipping_address.zip_code}`}
                                            </span>
                                        </p>
                                    )}
                                    {order.shipping_address?.country && (
                                        <p>
                                            <span className="text-muted-foreground">
                                                Country:{' '}
                                            </span>
                                            <span className="font-medium">
                                                {order.shipping_address.country}
                                            </span>
                                        </p>
                                    )}
                                </div>
                            ) : (
                                <p className="text-sm text-muted-foreground">
                                    No shipping address provided
                                </p>
                            )}
                        </div>

                        {/* Billing Address */}
                        {order.billing_address && (
                            <div className="rounded-xl border border-sidebar-border/50 p-6 shadow-sm">
                                <h2 className="mb-4 flex items-center gap-2 text-lg font-semibold">
                                    <MapPin className="h-5 w-5" />
                                    Billing Address
                                </h2>
                                <div className="flex flex-col gap-2 text-sm">
                                    {(order.billing_address?.first_name ||
                                        order.billing_address?.name) && (
                                        <p>
                                            <span className="text-muted-foreground">
                                                Name:{' '}
                                            </span>
                                            <span className="font-medium">
                                                {order.billing_address
                                                    .first_name
                                                    ? `${order.billing_address.first_name} ${order.billing_address.last_name ?? ''}`.trim()
                                                    : order.billing_address
                                                          .name}
                                            </span>
                                        </p>
                                    )}
                                    {order.billing_address?.phone && (
                                        <p dir="ltr">
                                            <span className="text-muted-foreground">
                                                Phone:{' '}
                                            </span>
                                            <span className="font-medium">
                                                {order.billing_address.phone}
                                            </span>
                                        </p>
                                    )}
                                    {order.billing_address?.email && (
                                        <p>
                                            <span className="text-muted-foreground">
                                                Email:{' '}
                                            </span>
                                            <span className="font-medium">
                                                {order.billing_address.email}
                                            </span>
                                        </p>
                                    )}
                                    {order.billing_address?.street && (
                                        <p>
                                            <span className="text-muted-foreground">
                                                Street:{' '}
                                            </span>
                                            <span className="font-medium">
                                                {order.billing_address.street}
                                            </span>
                                        </p>
                                    )}
                                    {order.billing_address?.city && (
                                        <p>
                                            <span className="text-muted-foreground">
                                                City:{' '}
                                            </span>
                                            <span className="font-medium">
                                                {order.billing_address.city}
                                            </span>
                                        </p>
                                    )}
                                    {order.billing_address?.country && (
                                        <p>
                                            <span className="text-muted-foreground">
                                                Country:{' '}
                                            </span>
                                            <span className="font-medium">
                                                {order.billing_address.country}
                                            </span>
                                        </p>
                                    )}
                                </div>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </SupplierLayout>
    );
}

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
                <Button>Update Status</Button>
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
