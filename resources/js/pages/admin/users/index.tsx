import { Head, Link, router, useForm } from '@inertiajs/react';
import { Edit, Eye, Plus, Search, Trash2 } from 'lucide-react';
import { useState } from 'react';

import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
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
import { edit } from '@/routes/admin/users';
import { type BreadcrumbItem } from '@/types';

interface User {
    id: number;
    name: string;
    email: string;
    phone: string;
    orders_count: number;
    is_admin: boolean;
}

interface Props {
    users: {
        data: User[];
        links: { url: string | null; label: string; active: boolean }[];
        current_page: number;
        last_page: number;
        from: number | null;
        to: number | null;
        total: number;
    };
    filters: {
        search?: string;
    };
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Users Management',
        href: '/admin/users',
    },
];

export default function UsersIndex({ users, filters }: Props) {
    const [search, setSearch] = useState(filters.search || '');
    const [deleteUser, setDeleteUser] = useState<User | null>(null);
    const { delete: destroy, processing } = useForm();

    const handleSearch = (e: React.FormEvent) => {
        e.preventDefault();
        router.get(
            '/admin/users',
            { ...filters, search, page: 1 },
            { preserveState: true },
        );
    };

    const handleDelete = () => {
        if (deleteUser) {
            destroy(`users/${deleteUser.id}`, {
                onSuccess: () => setDeleteUser(null),
            });
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Customers Management" />

            <div className="flex h-full flex-1 flex-col gap-8 p-8">
                <div className="flex items-center justify-between">
                    <h1 className="text-2xl font-bold">Users Management</h1>
                    <Button asChild>
                        <Link href="/admin/users/create">
                            <Plus className="mr-2 h-4 w-4" />
                            Add Admin
                        </Link>
                    </Button>
                </div>

                <div className="flex flex-col gap-4">
                    <div className="mb-2 flex items-center justify-between">
                        <form
                            onSubmit={handleSearch}
                            className="relative w-full max-w-sm"
                        >
                            <Search className="absolute top-1/2 left-3 h-4 w-4 -translate-y-1/2 text-muted-foreground" />
                            <Input
                                placeholder="Search users..."
                                value={search}
                                onChange={(e) => setSearch(e.target.value)}
                                className="border-none pl-10 ring-1 ring-sidebar-border"
                            />
                        </form>
                    </div>

                    <div className="overflow-hidden rounded-xl border-none shadow-none">
                        <Table className="border-separate border-spacing-y-3">
                            <TableHeader>
                                <TableRow className="border-none">
                                    <TableHead className="rounded-l-lg font-semibold">
                                        Customer name
                                    </TableHead>
                                    <TableHead className="font-semibold">
                                        e-mail
                                    </TableHead>
                                    <TableHead className="font-semibold">
                                        Mobile number
                                    </TableHead>
                                    <TableHead className="font-semibold">
                                        Orders
                                    </TableHead>
                                    <TableHead className="font-semibold">
                                        Type
                                    </TableHead>
                                    <TableHead className="rounded-r-lg font-semibold">
                                        Actions
                                    </TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {users.data.map((user) => (
                                    <TableRow key={user.id} className="h-20">
                                        <TableCell className="rounded-l-lg font-medium">
                                            {user.name}
                                        </TableCell>
                                        <TableCell className="">
                                            {user.email}
                                        </TableCell>
                                        <TableCell className="">
                                            {user.phone || 'N/A'}
                                        </TableCell>
                                        <TableCell className="">
                                            {user.orders_count}
                                        </TableCell>
                                        <TableCell className="">
                                            {user.is_admin ? (
                                                <span className="inline-flex items-center rounded-full bg-blue-100 px-2 py-1 text-xs font-medium text-blue-800">
                                                    Admin
                                                </span>
                                            ) : (
                                                <span className="inline-flex items-center rounded-full bg-gray-100 px-2 py-1 text-xs font-medium text-gray-800">
                                                    Customer
                                                </span>
                                            )}
                                        </TableCell>
                                        <TableCell className="rounded-r-lg">
                                            <div className="flex items-center gap-2">
                                                <Link
                                                    href={`/admin/users/${user.id}`}
                                                    className="flex h-10 w-10 items-center justify-center rounded-full transition-colors hover:bg-muted"
                                                    title="View"
                                                >
                                                    <Eye className="h-5 w-5" />
                                                </Link>
                                                <Link
                                                    href={edit(user.id)}
                                                    className="flex h-10 w-10 items-center justify-center rounded-full transition-colors hover:bg-muted"
                                                    title="Edit"
                                                >
                                                    <Edit className="h-5 w-5" />
                                                </Link>
                                                <button
                                                    type="button"
                                                    onClick={() =>
                                                        setDeleteUser(user)
                                                    }
                                                    className="flex h-10 w-10 items-center justify-center rounded-full transition-colors hover:bg-muted hover:text-red-600"
                                                    title="Delete"
                                                >
                                                    <Trash2 className="h-5 w-5" />
                                                </button>
                                            </div>
                                        </TableCell>
                                    </TableRow>
                                ))}
                                {users.data.length === 0 && (
                                    <TableRow>
                                        <TableCell
                                            colSpan={6}
                                            className="h-24 text-center text-muted-foreground"
                                        >
                                            No users found.
                                        </TableCell>
                                    </TableRow>
                                )}
                            </TableBody>
                        </Table>
                    </div>

                    {/* Delete Confirmation Dialog */}
                    <Dialog
                        open={!!deleteUser}
                        onOpenChange={() => setDeleteUser(null)}
                    >
                        <DialogContent>
                            <DialogHeader>
                                <DialogTitle>Delete Customer</DialogTitle>
                                <DialogDescription>
                                    Are you sure you want to delete{' '}
                                    <strong>{deleteUser?.name}</strong>? This
                                    action cannot be undone.
                                </DialogDescription>
                            </DialogHeader>
                            <DialogFooter>
                                <Button
                                    variant="outline"
                                    onClick={() => setDeleteUser(null)}
                                >
                                    Cancel
                                </Button>
                                <Button
                                    variant="destructive"
                                    onClick={handleDelete}
                                    disabled={processing}
                                >
                                    {processing ? 'Deleting...' : 'Delete'}
                                </Button>
                            </DialogFooter>
                        </DialogContent>
                    </Dialog>

                    {/* Pagination */}
                    {users.last_page > 1 && (
                        <div className="mt-6 flex items-center justify-between">
                            <p className="text-sm text-muted-foreground">
                                Showing {users.from} to {users.to} of{' '}
                                {users.total} entries
                            </p>
                            <div className="flex gap-2">
                                <Button
                                    variant="outline"
                                    size="sm"
                                    disabled={users.current_page === 1}
                                    onClick={() =>
                                        users.links[0].url &&
                                        router.get(users.links[0].url)
                                    }
                                >
                                    Previous
                                </Button>
                                <Button
                                    variant="outline"
                                    size="sm"
                                    disabled={
                                        users.current_page === users.last_page
                                    }
                                    onClick={() =>
                                        users.links[users.links.length - 1]
                                            .url &&
                                        router.get(
                                            users.links[users.links.length - 1]
                                                .url as string,
                                        )
                                    }
                                >
                                    Next
                                </Button>
                            </div>
                        </div>
                    )}
                </div>
            </div>
        </AppLayout>
    );
}
