import { Head, Link } from '@inertiajs/react';
import { Edit, Eye, Plus, Trash2 } from 'lucide-react';

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
    const handleDelete = async (teamMemberId: number) => {
        if (!confirm('Are you sure you want to delete this team member?')) {
            return;
        }

        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute('content');

        fetch(`/admin/team-members/${teamMemberId}`, {
            method: 'DELETE',
            headers: {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken || '',
            },
            credentials: 'same-origin',
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert(data.message || 'Failed to delete team member');
                }
            })
            .catch((error) => {
                console.error('Failed to delete team member:', error);
            });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Team Members" />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold">Team Members</h1>
                        <p className="text-muted-foreground">
                            Manage your team members
                        </p>
                    </div>
                    <Button asChild>
                        <Link href={adminTeamMembersCreate()}>
                            <Plus className="mr-2 h-4 w-4" />
                            Add Team Member
                        </Link>
                    </Button>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle>All Team Members</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Full Name</TableHead>
                                    <TableHead>Title</TableHead>
                                    <TableHead>Email</TableHead>
                                    <TableHead>Phone</TableHead>
                                    <TableHead>Social Media</TableHead>
                                    <TableHead>Created</TableHead>
                                    <TableHead className="w-[100px]">
                                        Actions
                                    </TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {teamMembers.map((teamMember) => (
                                    <TableRow key={teamMember.id}>
                                        <TableCell className="font-medium">
                                            {teamMember.fullname}
                                        </TableCell>
                                        <TableCell>
                                            {teamMember.title}
                                        </TableCell>
                                        <TableCell>
                                            {teamMember.email}
                                        </TableCell>
                                        <TableCell>
                                            {teamMember.phone || 'N/A'}
                                        </TableCell>
                                        <TableCell>
                                            {teamMember.social_media &&
                                            teamMember.social_media.length >
                                                0 ? (
                                                <Badge variant="secondary">
                                                    {
                                                        teamMember.social_media
                                                            .length
                                                    }{' '}
                                                    links
                                                </Badge>
                                            ) : (
                                                'N/A'
                                            )}
                                        </TableCell>
                                        <TableCell>
                                            {teamMember.created_at}
                                        </TableCell>
                                        <TableCell>
                                            <div className="flex items-center gap-2">
                                                <Button
                                                    variant="ghost"
                                                    size="sm"
                                                    asChild
                                                >
                                                    <Link
                                                        href={adminTeamMembersShow(
                                                            teamMember.id,
                                                        )}
                                                    >
                                                        <Eye className="h-4 w-4" />
                                                    </Link>
                                                </Button>
                                                <Button
                                                    variant="ghost"
                                                    size="sm"
                                                    asChild
                                                >
                                                    <Link
                                                        href={adminTeamMembersEdit(
                                                            teamMember.id,
                                                        )}
                                                    >
                                                        <Edit className="h-4 w-4" />
                                                    </Link>
                                                </Button>
                                                <Button
                                                    variant="ghost"
                                                    size="sm"
                                                    onClick={() =>
                                                        handleDelete(
                                                            teamMember.id,
                                                        )
                                                    }
                                                >
                                                    <Trash2 className="h-4 w-4" />
                                                </Button>
                                            </div>
                                        </TableCell>
                                    </TableRow>
                                ))}
                            </TableBody>
                        </Table>
                        {teamMembers.length === 0 && (
                            <p className="py-4 text-center text-muted-foreground">
                                No team members found
                            </p>
                        )}
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
