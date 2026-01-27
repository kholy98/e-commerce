import { Head, Link } from '@inertiajs/react';
import { ArrowLeft } from 'lucide-react';

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
import { adminUsers } from '@/routes';
import { type BreadcrumbItem } from '@/types';

interface Props {
    user: any;
}

export default function UserShow({ user }: Props) {
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Customers Management',
            href: adminUsers(),
        },
        {
            title: user.name,
            href: '',
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Customer - ${user.name}`} />

            <div className="flex h-full flex-1 flex-col gap-8 p-8">
                <div className="flex items-center gap-4">
                    <Link
                        href={adminUsers()}
                        className="flex h-10 w-10 items-center justify-center rounded-full shadow-sm ring-1 ring-sidebar-border transition-colors hover:bg-muted"
                    >
                        <ArrowLeft className="h-5 w-5" />
                    </Link>
                    <h1 className="text-2xl font-bold">Customer Details</h1>
                </div>

                <div className="grid gap-6 md:grid-cols-3">
                    <div className="flex flex-col gap-6 md:col-span-2">
                        <div className="rounded-xl border border-sidebar-border/50 p-6 shadow-sm">
                            <h2 className="mb-4 text-lg font-semibold">
                                Personal Information
                            </h2>
                            <div className="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <p className="text-sm text-muted-foreground">
                                        Full Name
                                    </p>
                                    <p className="font-medium">{user.name}</p>
                                </div>
                                <div>
                                    <p className="text-sm text-muted-foreground">
                                        Email
                                    </p>
                                    <p className="font-medium">{user.email}</p>
                                </div>
                                <div>
                                    <p className="text-sm text-muted-foreground">
                                        Phone Number
                                    </p>
                                    <p className="font-medium">
                                        {user.phone || 'N/A'}
                                    </p>
                                </div>
                                <div>
                                    <p className="text-sm text-muted-foreground">
                                        Joined Date
                                    </p>
                                    <p className="font-medium">
                                        {formatDate(user.created_at)}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div className="flex flex-col gap-4">
                            <h2 className="text-xl font-bold">
                                Orders history
                            </h2>
                            <div className="overflow-hidden">
                                <Table className="border-separate border-spacing-y-3">
                                    <TableHeader>
                                        <TableRow className="border-none">
                                            <TableHead className="rounded-l-lg font-semibold">
                                                Order Number
                                            </TableHead>
                                            <TableHead className="font-semibold">
                                                The product
                                            </TableHead>
                                            <TableHead className="font-semibold">
                                                history
                                            </TableHead>
                                            <TableHead className="font-semibold">
                                                Order Status
                                            </TableHead>
                                            <TableHead className="rounded-r-lg font-semibold">
                                                Total amount
                                            </TableHead>
                                        </TableRow>
                                    </TableHeader>
                                    <TableBody>
                                        {user.orders?.map((order: any) => {
                                            const firstItem = order.items?.[0];
                                            const productImage =
                                                firstItem?.product?.media?.[0]
                                                    ?.original_url;
                                            const productName =
                                                firstItem?.product?.name ||
                                                'N/A';

                                            return (
                                                <TableRow
                                                    key={order.id}
                                                    className="h-20 border-none shadow-sm ring-1 ring-sidebar-border/50"
                                                >
                                                    <TableCell className="rounded-l-lg font-medium">
                                                        {order.order_number.slice(
                                                            -3,
                                                        )}
                                                    </TableCell>
                                                    <TableCell>
                                                        <div className="flex items-center gap-3">
                                                            <div className="flex h-10 w-10 items-center justify-center rounded-lg p-1 ring-1 ring-sidebar-border/50">
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
                                                                    <div className="h-6 w-6 rounded bg-muted" />
                                                                )}
                                                            </div>
                                                            <span className="">
                                                                {productName}
                                                            </span>
                                                        </div>
                                                    </TableCell>
                                                    <TableCell className="">
                                                        {formatDate(
                                                            order.created_at,
                                                        )}
                                                    </TableCell>
                                                    <TableCell className="text-[#BC8B5D]">
                                                        {order.status}
                                                    </TableCell>
                                                    <TableCell className="rounded-r-lg font-bold text-[#2F4F94]">
                                                        {parseFloat(
                                                            order.total_amount,
                                                        ).toFixed(0)}
                                                    </TableCell>
                                                </TableRow>
                                            );
                                        })}
                                        {(!user.orders ||
                                            user.orders.length === 0) && (
                                            <TableRow>
                                                <TableCell
                                                    colSpan={5}
                                                    className="h-24 text-center text-muted-foreground"
                                                >
                                                    No orders found for this
                                                    customer.
                                                </TableCell>
                                            </TableRow>
                                        )}
                                    </TableBody>
                                </Table>
                            </div>
                        </div>
                    </div>

                    <div className="flex flex-col gap-6">
                        <div className="rounded-xl border border-sidebar-border/50 p-6 shadow-sm">
                            <h2 className="mb-4 text-lg font-semibold">
                                Addresses
                            </h2>
                            <div className="flex flex-col gap-3">
                                {user.addresses?.map((address: any) => (
                                    <div
                                        key={address.id}
                                        className="rounded-lg border p-3 text-sm"
                                    >
                                        <p className="font-medium">
                                            {address.type || 'Primary'}
                                        </p>
                                        <p className="text-muted-foreground">
                                            {address.street}, {address.city},{' '}
                                            {address.country}
                                        </p>
                                    </div>
                                ))}
                                {(!user.addresses ||
                                    user.addresses.length === 0) && (
                                    <p className="text-sm text-muted-foreground">
                                        No addresses found.
                                    </p>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
