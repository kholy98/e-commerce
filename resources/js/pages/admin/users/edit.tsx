import { Head, Link, useForm } from '@inertiajs/react';
import { ArrowLeft, Save } from 'lucide-react';
import { FormEventHandler } from 'react';

import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { index, show } from '@/routes/admin/users';
import { type BreadcrumbItem } from '@/types';

interface User {
    id: number;
    name: string;
    email: string;
    phone: string | null;
    is_admin: boolean;
    created_at: string;
}

interface Props {
    user: User;
}

export default function UsersEdit({ user }: Props) {
    const { data, setData, post, processing, errors } = useForm({
        name: user.name,
        email: user.email,
        phone: user.phone || '',
        password: '',
        is_admin: user.is_admin,
    });

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Users Management',
            href: index(),
        },
        {
            title: user.name,
            href: show(user.id),
        },
        {
            title: 'Edit',
            href: '',
        },
    ];

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(`/admin/users/${user.id}`);
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Edit User - ${user.name}`} />

            <div className="flex h-full flex-1 flex-col gap-8 p-8">
                <div className="flex items-center gap-4">
                    <Button variant="outline" size="icon" asChild>
                        <Link href={show(user.id)}>
                            <ArrowLeft className="h-4 w-4" />
                        </Link>
                    </Button>
                    <div>
                        <h1 className="text-2xl font-bold">Edit User</h1>
                        <p className="text-muted-foreground">
                            Update account information for {user.name}
                        </p>
                    </div>
                </div>

                <div className="grid gap-6">
                    <Card className="shadow-sm ring-1 ring-sidebar-border/50">
                        <CardHeader>
                            <CardTitle className="">
                                Account Information
                            </CardTitle>
                        </CardHeader>
                        <CardContent className="pt-6">
                            <form onSubmit={submit} className="space-y-6">
                                <div className="grid gap-6 md:grid-cols-2">
                                    <div className="space-y-2">
                                        <Label
                                            htmlFor="name"
                                            className="font-medium"
                                        >
                                            Full Name *
                                        </Label>
                                        <Input
                                            id="name"
                                            value={data.name}
                                            onChange={(e) =>
                                                setData('name', e.target.value)
                                            }
                                            required
                                            className="ring-1 ring-sidebar-border transition-all focus-visible:ring-2 focus-visible:ring-[#4A2C2A]"
                                        />
                                        {errors.name && (
                                            <p className="text-sm text-red-600">
                                                {errors.name}
                                            </p>
                                        )}
                                    </div>

                                    <div className="space-y-2">
                                        <Label
                                            htmlFor="email"
                                            className="font-medium"
                                        >
                                            Email Address *
                                        </Label>
                                        <Input
                                            id="email"
                                            type="email"
                                            value={data.email}
                                            onChange={(e) =>
                                                setData('email', e.target.value)
                                            }
                                            required
                                            className="ring-1 ring-sidebar-border transition-all focus-visible:ring-2 focus-visible:ring-[#4A2C2A]"
                                        />
                                        {errors.email && (
                                            <p className="text-sm text-red-600">
                                                {errors.email}
                                            </p>
                                        )}
                                    </div>

                                    <div className="space-y-2">
                                        <Label
                                            htmlFor="phone"
                                            className="font-medium"
                                        >
                                            Phone Number
                                        </Label>
                                        <Input
                                            id="phone"
                                            value={data.phone}
                                            onChange={(e) =>
                                                setData('phone', e.target.value)
                                            }
                                            className="ring-1 ring-sidebar-border transition-all focus-visible:ring-2 focus-visible:ring-[#4A2C2A]"
                                        />
                                        {errors.phone && (
                                            <p className="text-sm text-red-600">
                                                {errors.phone}
                                            </p>
                                        )}
                                    </div>

                                    <div className="space-y-2">
                                        <Label
                                            htmlFor="password"
                                            className="font-medium"
                                        >
                                            New Password
                                        </Label>
                                        <Input
                                            id="password"
                                            type="password"
                                            value={data.password}
                                            onChange={(e) =>
                                                setData(
                                                    'password',
                                                    e.target.value,
                                                )
                                            }
                                            placeholder="Leave blank to keep current password"
                                            className="ring-1 ring-sidebar-border transition-all focus-visible:ring-2 focus-visible:ring-[#4A2C2A]"
                                        />
                                        {errors.password && (
                                            <p className="text-sm text-red-600">
                                                {errors.password}
                                            </p>
                                        )}
                                    </div>
                                </div>

                                <div className="flex items-center space-x-2 border-t pt-4">
                                    <Checkbox
                                        id="is_admin"
                                        checked={data.is_admin}
                                        onCheckedChange={(checked) =>
                                            setData('is_admin', !!checked)
                                        }
                                    />
                                    <Label
                                        htmlFor="is_admin"
                                        className="font-medium"
                                    >
                                        Admin User
                                    </Label>
                                    <p className="ml-2 text-sm text-muted-foreground">
                                        (Grants access to admin dashboard)
                                    </p>
                                </div>
                                {errors.is_admin && (
                                    <p className="text-sm text-red-600">
                                        {errors.is_admin}
                                    </p>
                                )}

                                <div className="flex justify-end gap-4 border-t pt-4">
                                    <Button variant="outline" asChild>
                                        <Link href={show(user.id)}>Cancel</Link>
                                    </Button>
                                    <Button type="submit" disabled={processing}>
                                        <Save className="mr-2 h-4 w-4" />
                                        Save Changes
                                    </Button>
                                </div>
                            </form>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </AppLayout>
    );
}
