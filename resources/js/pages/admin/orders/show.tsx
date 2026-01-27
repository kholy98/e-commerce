import { Head, Link } from '@inertiajs/react';
import { ArrowLeft } from 'lucide-react';

import AppLayout from '@/layouts/app-layout';
import { formatDate } from '@/lib/utils';
import { adminOrders } from '@/routes';
import { type BreadcrumbItem } from '@/types';

interface Props {
    order: any;
}

export default function OrderShow({ order }: Props) {
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Order Management',
            href: adminOrders(),
        },
        {
            title: `#${order.order_number}`,
            href: '',
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Order #${order.order_number}`} />

            <div className="flex h-full flex-1 flex-col gap-8 p-8">
                <div className="flex items-center gap-4">
                    <Link
                        href={adminOrders()}
                        className="flex h-10 w-10 items-center justify-center rounded-full shadow-sm ring-1 ring-sidebar-border transition-colors hover:bg-muted"
                    >
                        <ArrowLeft className="h-5 w-5" />
                    </Link>
                    <h1 className="text-2xl font-bold">
                        Order Detailed Information
                    </h1>
                </div>

                <div className="grid gap-6 md:grid-cols-3">
                    <div className="flex flex-col gap-6 md:col-span-2">
                        <div className="rounded-xl border border-sidebar-border/50 p-6 shadow-sm">
                            <h2 className="mb-4 text-lg font-semibold">
                                General Information
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
                                        Date
                                    </p>
                                    <p className="font-medium">
                                        {formatDate(order.created_at)}
                                    </p>
                                </div>
                                <div>
                                    <p className="text-sm text-muted-foreground">
                                        Status
                                    </p>
                                    <p className="font-medium capitalize">
                                        {order.status}
                                    </p>
                                </div>
                                <div>
                                    <p className="text-sm text-muted-foreground">
                                        Total Amount
                                    </p>
                                    <p className="font-mono font-medium">
                                        $
                                        {parseFloat(order.total_amount).toFixed(
                                            2,
                                        )}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div className="rounded-xl border border-sidebar-border/50 p-6 shadow-sm">
                            <h2 className="mb-4 text-lg font-semibold">
                                Order Items
                            </h2>
                            <div className="flex flex-col gap-4">
                                {order.items.map((item: any) => (
                                    <div
                                        key={item.id}
                                        className="flex items-center justify-between border-b pb-4 last:border-0 last:pb-0"
                                    >
                                        <div className="flex items-center gap-4">
                                            <div className="flex h-16 w-16 items-center justify-center rounded-lg p-2">
                                                {item.product?.media?.[0]
                                                    ?.original_url ? (
                                                    <img
                                                        src={
                                                            item.product
                                                                .media[0]
                                                                .original_url
                                                        }
                                                        alt={item.product.name}
                                                        className="h-full w-full object-contain"
                                                    />
                                                ) : (
                                                    <div className="bg-brown-100 h-10 w-10" />
                                                )}
                                            </div>
                                            <div>
                                                <p className="font-medium">
                                                    {item.product?.name}
                                                </p>
                                                <p className="text-sm text-muted-foreground">
                                                    Qty: {item.quantity}
                                                </p>
                                            </div>
                                        </div>
                                        <p className="font-semibold">
                                            $
                                            {parseFloat(item.subtotal).toFixed(
                                                2,
                                            )}
                                        </p>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>

                    <div className="flex flex-col gap-6">
                        <div className="rounded-xl border border-sidebar-border/50 p-6 shadow-sm">
                            <h2 className="mb-4 text-lg font-semibold">
                                Customer Info
                            </h2>
                            <div className="flex flex-col gap-3">
                                <div>
                                    <p className="text-sm text-muted-foreground">
                                        Name
                                    </p>
                                    <p className="font-medium">
                                        {order.user?.name}
                                    </p>
                                </div>
                                <div>
                                    <p className="text-sm text-muted-foreground">
                                        Email
                                    </p>
                                    <p className="font-medium">
                                        {order.user?.email}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div className="rounded-xl border border-sidebar-border/50 p-6 shadow-sm">
                            <h2 className="mb-4 text-lg font-semibold">
                                Shipping Address
                            </h2>
                            {typeof order.shipping_address === 'object' &&
                            order.shipping_address !== null ? (
                                <div className="grid gap-2 text-sm text-muted-foreground">
                                    <p>
                                        <span className="font-medium">
                                            Street:
                                        </span>{' '}
                                        {order.shipping_address.street}
                                    </p>
                                    <p>
                                        <span className="font-medium">
                                            Building:
                                        </span>{' '}
                                        {order.shipping_address.building_number}
                                        ,{' '}
                                        <span className="font-medium">
                                            Floor:
                                        </span>{' '}
                                        {order.shipping_address.floor},{' '}
                                        <span className="font-medium">
                                            Apartment:
                                        </span>{' '}
                                        {order.shipping_address.apartment}
                                    </p>
                                    <p>
                                        <span className="font-medium">
                                            Zone:
                                        </span>{' '}
                                        {order.shipping_address.zone}
                                    </p>
                                    <p>
                                        <span className="font-medium">
                                            City:
                                        </span>{' '}
                                        {order.shipping_address.city},{' '}
                                        {order.shipping_address.zip_code}
                                    </p>
                                    <p>
                                        <span className="font-medium">
                                            Country:
                                        </span>{' '}
                                        {order.shipping_address.country}
                                    </p>
                                </div>
                            ) : (
                                <p className="text-sm leading-relaxed text-muted-foreground">
                                    {order.shipping_address}
                                </p>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
