import { Head, Link } from '@inertiajs/react';
import { ArrowLeft, Edit, ExternalLink, Mail, Phone } from 'lucide-react';

import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/app-layout';
import { formatDate } from '@/lib/utils';
import { adminTeamMembers, adminTeamMembersEdit } from '@/routes';
import { type BreadcrumbItem } from '@/types';

interface TeamMember {
    id: number;
    fullname: string;
    phone: string | null;
    title: string;
    email: string;
    social_media: string[] | null;
    media: Array<{
        id: number;
        name: string;
        file_name: string;
        mime_type: string;
        size: number;
        original_url: string;
    }>;
    created_at: string;
}

interface Props {
    teamMember: TeamMember;
}

export default function TeamMemberShow({ teamMember }: Props) {
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Team Members',
            href: adminTeamMembers(),
        },
        {
            title: teamMember.fullname,
            href: `/admin/team-members/${teamMember.id}`,
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Team Member: ${teamMember.fullname}`} />

            <div className="flex h-full flex-1 flex-col gap-8 p-8">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-4">
                        <Button variant="outline" size="icon" asChild>
                            <Link href={adminTeamMembers()}>
                                <ArrowLeft className="h-4 w-4" />
                            </Link>
                        </Button>
                        <div>
                            <h1 className="text-2xl font-bold">
                                Team Member Details
                            </h1>
                            <p className="text-muted-foreground">
                                Viewing profile of {teamMember.fullname}
                            </p>
                        </div>
                    </div>
                    <Button asChild>
                        <Link href={adminTeamMembersEdit(teamMember.id)}>
                            <Edit className="mr-2 h-4 w-4" />
                            Edit Member
                        </Link>
                    </Button>
                </div>

                <div className="grid gap-6 md:grid-cols-3">
                    <Card className="md:col-span-1">
                        <CardHeader>
                            <CardTitle>Profile Image</CardTitle>
                        </CardHeader>
                        <CardContent className="flex flex-col items-center">
                            {teamMember.media.length > 0 ? (
                                <img
                                    src={teamMember.media[0].original_url}
                                    alt={teamMember.fullname}
                                    className="aspect-square w-full rounded-xl object-cover shadow-md"
                                />
                            ) : (
                                <div className="flex aspect-square w-full items-center justify-center rounded-xl bg-muted text-muted-foreground">
                                    No Image Provided
                                </div>
                            )}
                        </CardContent>
                    </Card>

                    <Card className="md:col-span-2">
                        <CardHeader>
                            <CardTitle>Member Information</CardTitle>
                        </CardHeader>
                        <CardContent className="space-y-6">
                            <div className="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label className="text-sm font-medium text-muted-foreground">
                                        Full Name
                                    </label>
                                    <p className="text-lg font-semibold">
                                        {teamMember.fullname}
                                    </p>
                                </div>
                                <div>
                                    <label className="text-sm font-medium text-muted-foreground">
                                        Job Title
                                    </label>
                                    <p className="text-lg font-semibold">
                                        {teamMember.title}
                                    </p>
                                </div>
                                <div>
                                    <label className="text-sm font-medium text-muted-foreground">
                                        Email Address
                                    </label>
                                    <div className="flex items-center gap-2">
                                        <Mail className="h-4 w-4 text-muted-foreground" />
                                        <p className="">{teamMember.email}</p>
                                    </div>
                                </div>
                                <div>
                                    <label className="text-sm font-medium text-muted-foreground">
                                        Phone Number
                                    </label>
                                    <div className="flex items-center gap-2">
                                        <Phone className="h-4 w-4 text-muted-foreground" />
                                        <p className="">
                                            {teamMember.phone || 'Not provided'}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div className="space-y-3">
                                <label className="text-sm font-medium text-muted-foreground">
                                    Social Media Profiles
                                </label>
                                {teamMember.social_media &&
                                teamMember.social_media.length > 0 ? (
                                    <div className="flex flex-wrap gap-2">
                                        {teamMember.social_media.map(
                                            (link, index) => (
                                                <Button
                                                    key={index}
                                                    variant="outline"
                                                    size="sm"
                                                    asChild
                                                >
                                                    <a
                                                        href={link}
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                    >
                                                        <ExternalLink className="mr-2 h-3 w-3" />
                                                        Link {index + 1}
                                                    </a>
                                                </Button>
                                            ),
                                        )}
                                    </div>
                                ) : (
                                    <p className="text-sm text-muted-foreground italic">
                                        No social media links provided.
                                    </p>
                                )}
                            </div>

                            <div className="border-t pt-4">
                                <label className="text-sm font-medium text-muted-foreground">
                                    Created At
                                </label>
                                <p className="text-sm">
                                    {formatDate(teamMember.created_at)}
                                </p>
                            </div>
                        </CardContent>
                    </Card>
                </div>

                {teamMember.media.length > 1 && (
                    <Card>
                        <CardHeader>
                            <CardTitle>Additional Media</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div className="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6">
                                {teamMember.media.slice(1).map((media) => (
                                    <div
                                        key={media.id}
                                        className="group relative"
                                    >
                                        <img
                                            src={media.original_url}
                                            alt={media.name}
                                            className="aspect-square w-full rounded-lg object-cover shadow-sm transition-transform group-hover:scale-105"
                                        />
                                    </div>
                                ))}
                            </div>
                        </CardContent>
                    </Card>
                )}
            </div>
        </AppLayout>
    );
}
