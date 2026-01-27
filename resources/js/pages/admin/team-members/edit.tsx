import { Head, Link, useForm } from '@inertiajs/react';
import { ArrowLeft, Plus, Save, Trash2 } from 'lucide-react';
import { FormEventHandler } from 'react';

import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { adminTeamMembers } from '@/routes';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Team Members',
        href: adminTeamMembers(),
    },
    {
        title: 'Edit Member',
        href: '#',
    },
];

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
}

interface Props {
    teamMember: TeamMember;
}

export default function TeamMembersEdit({ teamMember }: Props) {
    const { data, setData, post, processing, errors } = useForm({
        fullname: teamMember.fullname,
        phone: teamMember.phone || '',
        title: teamMember.title,
        email: teamMember.email,
        social_media: teamMember.social_media || [],
        images: [] as File[],
        remove_images: [] as number[],
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(`/admin/team-members/${teamMember.id}`, {
            forceFormData: true,
        });
    };

    const addSocialMediaLink = () => {
        setData('social_media', [...data.social_media, '']);
    };

    const updateSocialMediaLink = (index: number, value: string) => {
        const updated = [...data.social_media];
        updated[index] = value;
        setData('social_media', updated);
    };

    const removeSocialMediaLink = (index: number) => {
        setData(
            'social_media',
            data.social_media.filter((_, i) => i !== index),
        );
    };

    const handleImageChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        if (e.target.files) {
            setData('images', Array.from(e.target.files));
        }
    };

    const removeExistingImage = (mediaId: number) => {
        setData('remove_images', [...data.remove_images, mediaId]);
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Edit ${teamMember.fullname}`} />

            <div className="flex h-full flex-1 flex-col gap-8 p-8">
                <div className="flex items-center gap-4">
                    <Button variant="outline" size="icon" asChild>
                        <Link href={adminTeamMembers()}>
                            <ArrowLeft className="h-4 w-4" />
                        </Link>
                    </Button>
                    <div>
                        <h1 className="text-2xl font-bold">Edit Team Member</h1>
                        <p className="text-muted-foreground">
                            Modify profile details for {teamMember.fullname}
                        </p>
                    </div>
                </div>

                <div className="grid gap-6">
                    <Card className="border-none shadow-sm ring-1 ring-sidebar-border/50">
                        <CardHeader>
                            <CardTitle>Member Profile</CardTitle>
                        </CardHeader>
                        <CardContent className="pt-6">
                            <form onSubmit={submit} className="space-y-6">
                                <div className="grid gap-6 md:grid-cols-2">
                                    <div className="space-y-2">
                                        <Label
                                            htmlFor="fullname"
                                            className="font-medium"
                                        >
                                            Full Name
                                        </Label>
                                        <Input
                                            id="fullname"
                                            value={data.fullname}
                                            onChange={(e) =>
                                                setData(
                                                    'fullname',
                                                    e.target.value,
                                                )
                                            }
                                            required
                                            className="ring-1 ring-sidebar-border"
                                        />
                                        {errors.fullname && (
                                            <p className="text-sm text-red-600">
                                                {errors.fullname}
                                            </p>
                                        )}
                                    </div>

                                    <div className="space-y-2">
                                        <Label
                                            htmlFor="title"
                                            className="font-medium"
                                        >
                                            Job Title
                                        </Label>
                                        <Input
                                            id="title"
                                            value={data.title}
                                            onChange={(e) =>
                                                setData('title', e.target.value)
                                            }
                                            required
                                            className="ring-1 ring-sidebar-border"
                                        />
                                        {errors.title && (
                                            <p className="text-sm text-red-600">
                                                {errors.title}
                                            </p>
                                        )}
                                    </div>

                                    <div className="space-y-2">
                                        <Label
                                            htmlFor="email"
                                            className="font-medium"
                                        >
                                            Email Address
                                        </Label>
                                        <Input
                                            id="email"
                                            type="email"
                                            value={data.email}
                                            onChange={(e) =>
                                                setData('email', e.target.value)
                                            }
                                            required
                                            className="ring-1 ring-sidebar-border"
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
                                            className="ring-1 ring-sidebar-border"
                                        />
                                        {errors.phone && (
                                            <p className="text-sm text-red-600">
                                                {errors.phone}
                                            </p>
                                        )}
                                    </div>
                                </div>

                                <div className="space-y-3">
                                    <Label className="font-medium">
                                        Social Media Links
                                    </Label>
                                    <div className="grid gap-3">
                                        {data.social_media.map(
                                            (link, index) => (
                                                <div
                                                    key={index}
                                                    className="flex gap-2"
                                                >
                                                    <Input
                                                        value={link}
                                                        onChange={(e) =>
                                                            updateSocialMediaLink(
                                                                index,
                                                                e.target.value,
                                                            )
                                                        }
                                                        placeholder="https://..."
                                                        className="ring-1 ring-sidebar-border"
                                                    />
                                                    <Button
                                                        type="button"
                                                        variant="destructive"
                                                        onClick={() =>
                                                            removeSocialMediaLink(
                                                                index,
                                                            )
                                                        }
                                                    >
                                                        Remove
                                                    </Button>
                                                </div>
                                            ),
                                        )}
                                    </div>
                                    <Button
                                        type="button"
                                        size="sm"
                                        onClick={addSocialMediaLink}
                                    >
                                        <Plus className="mr-2 h-4 w-4" />
                                        Add Social Media Link
                                    </Button>
                                    {errors.social_media && (
                                        <p className="text-sm text-red-600">
                                            {errors.social_media}
                                        </p>
                                    )}
                                </div>

                                <div className="space-y-3">
                                    <Label className="font-medium">
                                        Current Images
                                    </Label>
                                    <div className="grid gap-4 md:grid-cols-4 lg:grid-cols-6">
                                        {teamMember.media
                                            .filter(
                                                (media) =>
                                                    !data.remove_images.includes(
                                                        media.id,
                                                    ),
                                            )
                                            .map((media) => (
                                                <div
                                                    key={media.id}
                                                    className="group relative h-24"
                                                >
                                                    <img
                                                        src={media.original_url}
                                                        alt={media.name}
                                                        className="h-full w-full rounded-lg object-cover shadow-sm ring-1 ring-sidebar-border/50"
                                                    />
                                                    <Button
                                                        type="button"
                                                        variant="destructive"
                                                        size="icon"
                                                        className="absolute -top-2 -right-2 h-6 w-6 rounded-full opacity-0 shadow-lg transition-opacity group-hover:opacity-100"
                                                        onClick={() =>
                                                            removeExistingImage(
                                                                media.id,
                                                            )
                                                        }
                                                    >
                                                        <Trash2 className="h-3 w-3" />
                                                    </Button>
                                                </div>
                                            ))}
                                    </div>
                                </div>

                                <div className="space-y-3">
                                    <Label
                                        htmlFor="images"
                                        className="font-medium"
                                    >
                                        Add New Images
                                    </Label>
                                    <Input
                                        id="images"
                                        type="file"
                                        multiple
                                        accept="image/*"
                                        onChange={handleImageChange}
                                        className="cursor-pointer ring-1 ring-sidebar-border"
                                    />
                                    {errors.images && (
                                        <p className="text-sm text-red-600">
                                            {errors.images}
                                        </p>
                                    )}
                                </div>

                                <div className="flex justify-end border-t pt-4">
                                    <Button type="submit" disabled={processing}>
                                        <Save className="mr-2 h-4 w-4" />
                                        Update Team Member
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
