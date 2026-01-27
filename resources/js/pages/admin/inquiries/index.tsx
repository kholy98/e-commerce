import { Head, Link } from '@inertiajs/react';
import { Eye } from 'lucide-react';

import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import AppLayout from '@/layouts/app-layout';
import { adminInquiries, adminInquiriesShow } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { formatDate } from '@/lib/utils';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Inquiries',
        href: adminInquiries(),
    },
];

interface ContactInquiry {
    id: number;
    full_name: string;
    email: string;
    phone: string | null;
    company: string | null;
    message: string;
    status: 'pending' | 'replied' | 'closed';
    replied_at: string | null;
    created_at: string;
    service?: {
        id: number;
        name: string;
    };
}

interface Props {
    inquiries: {
        data: ContactInquiry[];
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
    };
}

export default function InquiriesIndex({ inquiries }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Contact Inquiries" />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold">
                            Contact Inquiries
                        </h1>
                        <p className="text-muted-foreground">
                            Manage customer inquiries and replies
                        </p>
                    </div>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle>All Inquiries</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Name</TableHead>
                                    <TableHead>Email</TableHead>
                                    <TableHead>Company</TableHead>
                                    <TableHead>Status</TableHead>
                                    <TableHead>Created</TableHead>
                                    <TableHead className="w-[100px]">
                                        Actions
                                    </TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {inquiries.data.map((inquiry) => (
                                    <TableRow key={inquiry.id}>
                                        <TableCell className="font-medium">
                                            {inquiry.full_name}
                                        </TableCell>
                                        <TableCell>{inquiry.email}</TableCell>
                                        <TableCell>
                                            {inquiry.company || 'N/A'}
                                        </TableCell>
                                        <TableCell>
                                            <Badge
                                                variant={
                                                    inquiry.status === 'pending'
                                                        ? 'destructive'
                                                        : inquiry.status ===
                                                            'replied'
                                                          ? 'default'
                                                          : 'secondary'
                                                }
                                            >
                                                {inquiry.status}
                                            </Badge>
                                        </TableCell>
                                        <TableCell>
                                            {formatDate(inquiry.created_at)}
                                        </TableCell>
                                        <TableCell>
                                            <Button
                                                variant="ghost"
                                                size="sm"
                                                asChild
                                            >
                                                <Link
                                                    href={adminInquiriesShow(
                                                        inquiry.id,
                                                    )}
                                                >
                                                    <Eye className="mr-1 h-4 w-4" />
                                                    View
                                                </Link>
                                            </Button>
                                        </TableCell>
                                    </TableRow>
                                ))}
                            </TableBody>
                        </Table>
                        {inquiries.data.length === 0 && (
                            <p className="py-4 text-center text-muted-foreground">
                                No inquiries found
                            </p>
                        )}

                        {/* Pagination */}
                        {inquiries.last_page > 1 && (
                            <div className="mt-4 flex justify-center gap-2">
                                {/* Simple pagination - can be enhanced */}
                                <span className="flex items-center px-3">
                                    Page {inquiries.current_page} of{' '}
                                    {inquiries.last_page}
                                </span>
                            </div>
                        )}
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
