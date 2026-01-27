import { Head, Link, useForm } from '@inertiajs/react';
import { ArrowLeft, Send } from 'lucide-react';
import { FormEventHandler } from 'react';

import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/app-layout';
import { formatDate } from '@/lib/utils';
import { adminInquiries } from '@/routes';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Inquiries',
        href: adminInquiries(),
    },
    {
        title: 'View',
        href: '/admin/inquiries/view',
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
    reply_message: string | null;
    created_at: string;
    service?: {
        id: number;
        name: string;
    };
}

interface Props {
    inquiry: ContactInquiry;
}

export default function InquiriesShow({ inquiry }: Props) {
    const { data, setData, post, processing, errors } = useForm({
        reply_message: '',
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(`/admin/inquiries/${inquiry.id}/reply`);
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Inquiry from ${inquiry.full_name}`} />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center gap-4">
                    <Button variant="outline" asChild>
                        <Link href={adminInquiries()}>
                            <ArrowLeft className="mr-2 h-4 w-4" />
                            Back to Inquiries
                        </Link>
                    </Button>
                </div>

                <div className="grid gap-6 md:grid-cols-2">
                    {/* Inquiry Details */}
                    <Card>
                        <CardHeader>
                            <CardTitle className="flex items-center justify-between">
                                Inquiry Details
                                <Badge
                                    variant={
                                        inquiry.status === 'pending'
                                            ? 'destructive'
                                            : inquiry.status === 'replied'
                                              ? 'default'
                                              : 'secondary'
                                    }
                                >
                                    {inquiry.status}
                                </Badge>
                            </CardTitle>
                        </CardHeader>
                        <CardContent className="space-y-4">
                            <div>
                                <Label className="text-sm font-medium">
                                    Name
                                </Label>
                                <p className="text-sm text-muted-foreground">
                                    {inquiry.full_name}
                                </p>
                            </div>

                            <div>
                                <Label className="text-sm font-medium">
                                    Email
                                </Label>
                                <p className="text-sm text-muted-foreground">
                                    {inquiry.email}
                                </p>
                            </div>

                            {inquiry.phone && (
                                <div>
                                    <Label className="text-sm font-medium">
                                        Phone
                                    </Label>
                                    <p className="text-sm text-muted-foreground">
                                        {inquiry.phone}
                                    </p>
                                </div>
                            )}

                            {inquiry.company && (
                                <div>
                                    <Label className="text-sm font-medium">
                                        Company
                                    </Label>
                                    <p className="text-sm text-muted-foreground">
                                        {inquiry.company}
                                    </p>
                                </div>
                            )}

                            <div>
                                <Label className="text-sm font-medium">
                                    Created
                                </Label>
                                <p className="text-sm text-muted-foreground">
                                    {formatDate(inquiry.created_at)}
                                </p>
                            </div>

                            <div>
                                <Label className="text-sm font-medium">
                                    Message
                                </Label>
                                <div className="mt-1 rounded-md border p-3 text-sm">
                                    {inquiry.message}
                                </div>
                            </div>

                            {inquiry.status === 'replied' &&
                                inquiry.reply_message && (
                                    <div>
                                        <Label className="text-sm font-medium">
                                            Previous Reply
                                        </Label>
                                        <div className="mt-1 rounded-md border bg-muted p-3 text-sm">
                                            {inquiry.reply_message}
                                        </div>
                                        <p className="mt-1 text-xs text-muted-foreground">
                                            Replied on{' '}
                                            {new Date(
                                                inquiry.replied_at!,
                                            ).toLocaleString()}
                                        </p>
                                    </div>
                                )}
                        </CardContent>
                    </Card>

                    {/* Reply Form */}
                    {inquiry.status !== 'replied' && (
                        <Card>
                            <CardHeader>
                                <CardTitle>Send Reply</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <form onSubmit={submit} className="space-y-4">
                                    <div>
                                        <Label htmlFor="reply_message">
                                            Reply Message
                                        </Label>
                                        <Textarea
                                            id="reply_message"
                                            value={data.reply_message}
                                            onChange={(e) =>
                                                setData(
                                                    'reply_message',
                                                    e.target.value,
                                                )
                                            }
                                            placeholder="Type your reply here..."
                                            rows={8}
                                            required
                                        />
                                        {errors.reply_message && (
                                            <p className="mt-1 text-sm text-red-600">
                                                {errors.reply_message}
                                            </p>
                                        )}
                                    </div>

                                    <Button type="submit" disabled={processing}>
                                        <Send className="mr-2 h-4 w-4" />
                                        Send Reply
                                    </Button>
                                </form>
                            </CardContent>
                        </Card>
                    )}
                </div>
            </div>
        </AppLayout>
    );
}
