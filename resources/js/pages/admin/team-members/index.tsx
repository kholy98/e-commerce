import { Head, Link, router } from '@inertiajs/react';
import { Edit, Eye, Plus, Trash2 } from 'lucide-react';

import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
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
import {
    adminTeamMembers,
    adminTeamMembersCreate,
    adminTeamMembersEdit,
    adminTeamMembersShow,
} from '@/routes';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Team Members',
        href: adminTeamMembers(),
    },
];

interface TeamMember {
    id: number;
    fullname: string;
    phone: string | null;
    title: string;
    email: string;
    social_media: string[] | null;
    created_at: string;
}

interface Props {
    teamMembers: TeamMember[];
}

export default function TeamMembersIndex({ teamMembers }: Props) {
    const handleDelete = (teamMemberId: number) => {
        if (confirm('Are you sure you want to delete this team member?')) {
            router.delete(`/admin/team-members/${teamMemberId}`, {
                onSuccess: () => {
                    // Success handling if needed
                },
            });
        }
    };
    console.log(teamMembers);

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Team Members" />

            <div className="flex h-full flex-1 flex-col gap-8 p-8">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold">Team Members</h1>
                        <p className="text-muted-foreground">
                            Manage your organizational team members
                        </p>
                    </div>
                    <Button asChild>
                        <Link href={adminTeamMembersCreate()}>
                            <Plus className="mr-2 h-4 w-4" />
                            Add Team Member
                        </Link>
                    </Button>
                </div>

                <div className="overflow-hidden rounded-xl border-none shadow-none">
                    <Table className="border-separate border-spacing-y-3">
                        <TableHeader>
                            <TableRow className="border-none">
                                <TableHead className="rounded-l-lg font-semibold">
                                    Full Name
                                </TableHead>
                                <TableHead className="font-semibold">
                                    Title
                                </TableHead>
                                <TableHead className="font-semibold">
                                    Email
                                </TableHead>
                                <TableHead className="font-semibold">
                                    Phone
                                </TableHead>
                                <TableHead className="font-semibold">
                                    Social Media
                                </TableHead>
                                <TableHead className="font-semibold">
                                    Created
                                </TableHead>
                                <TableHead className="rounded-r-lg text-right font-semibold">
                                    Actions
                                </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            {teamMembers.map((teamMember) => (
                                <TableRow
                                    key={teamMember.id}
                                    className="h-20 border-none shadow-sm ring-1 ring-sidebar-border/50"
                                >
                                    <TableCell className="rounded-l-lg font-medium">
                                        {teamMember.fullname}
                                    </TableCell>
                                    <TableCell className="">
                                        {teamMember.title}
                                    </TableCell>
                                    <TableCell className="">
                                        {teamMember.email}
                                    </TableCell>
                                    <TableCell className="">
                                        {teamMember.phone || 'N/A'}
                                    </TableCell>
                                    <TableCell>
                                        {teamMember.social_media &&
                                        teamMember.social_media.length > 0 ? (
                                            <Badge
                                                variant="secondary"
                                                className="bg-[#F5EFEA] hover:bg-[#F5EFEA]"
                                            >
                                                {teamMember.social_media.length}{' '}
                                                links
                                            </Badge>
                                        ) : (
                                            <span className="text-muted-foreground italic">
                                                N/A
                                            </span>
                                        )}
                                    </TableCell>
                                    <TableCell className="">
                                        {formatDate(teamMember.created_at)}
                                    </TableCell>
                                    <TableCell className="rounded-r-lg">
                                        <div className="flex items-center justify-end gap-2">
                                            <Link
                                                href={adminTeamMembersShow(
                                                    teamMember.id,
                                                )}
                                                className="flex h-10 w-10 items-center justify-center rounded-full transition-colors hover:bg-muted"
                                            >
                                                <Eye className="h-5 w-5" />
                                            </Link>
                                            <Link
                                                href={adminTeamMembersEdit(
                                                    teamMember.id,
                                                )}
                                                className="flex h-10 w-10 items-center justify-center rounded-full transition-colors hover:bg-muted"
                                            >
                                                <Edit className="h-5 w-5" />
                                            </Link>
                                            <button
                                                onClick={() =>
                                                    handleDelete(teamMember.id)
                                                }
                                                className="flex h-10 w-10 items-center justify-center rounded-full text-red-600 transition-colors hover:bg-red-50"
                                            >
                                                <Trash2 className="h-5 w-5" />
                                            </button>
                                        </div>
                                    </TableCell>
                                </TableRow>
                            ))}
                        </TableBody>
                    </Table>
                    {teamMembers.length === 0 && (
                        <div className="flex h-32 flex-col items-center justify-center rounded-xl bg-white text-muted-foreground shadow-sm ring-1 ring-sidebar-border/50">
                            <p>No team members found</p>
                        </div>
                    )}
                </div>
            </div>
        </AppLayout>
    );
}
