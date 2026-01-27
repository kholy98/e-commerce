import { Head, Link, useForm } from '@inertiajs/react';
import { ArrowLeft, Plus, Save } from 'lucide-react';
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
        title: 'Add Member',
        href: '/admin/team-members/create',
    },
];

export default function TeamMembersCreate() {
    const { data, setData, post, processing, errors } = useForm({
        fullname: '',
        phone: '',
        title: '',
        email: '',
        social_media: [] as string[],
        images: [] as File[],
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post('/admin/team-members', {
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

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Add Team Member" />

            <div className="flex h-full flex-1 flex-col gap-8 p-8">
                <div className="flex items-center gap-4">
                    <Button variant="outline" size="icon" asChild>
                        <Link href={adminTeamMembers()}>
                            <ArrowLeft className="h-4 w-4" />
                        </Link>
                    </Button>
                    <div>
                        <h1 className="text-2xl font-bold">Add Team Member</h1>
                        <p className="text-muted-foreground">
                            Create a new profile for a team member
                        </p>
                    </div>
                </div>

                <div className="grid gap-6">
                    <Card className="shadow-sm ring-1 ring-sidebar-border/50">
                        <CardHeader>
                            <CardTitle className="">Member Profile</CardTitle>
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
                                            className="ring-1 ring-sidebar-border transition-all focus-visible:ring-2 focus-visible:ring-[#4A2C2A]"
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
                                            className="ring-1 ring-sidebar-border transition-all focus-visible:ring-2 focus-visible:ring-[#4A2C2A]"
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
                                                        placeholder="https://facebook.com/profile"
                                                        className="ring-1 ring-sidebar-border transition-all focus-visible:ring-2 focus-visible:ring-[#4A2C2A]"
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
                                        // variant="outline"
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
                                    <Label
                                        htmlFor="images"
                                        className="font-medium"
                                    >
                                        Profile & Additional Images
                                    </Label>
                                    <Input
                                        id="images"
                                        type="file"
                                        multiple
                                        accept="image/*"
                                        onChange={handleImageChange}
                                        className="cursor-pointer ring-1 ring-sidebar-border transition-all focus-visible:ring-2 focus-visible:ring-[#4A2C2A]"
                                    />
                                    <p className="text-xs text-muted-foreground italic">
                                        Tip: First image will be used as the
                                        main profile picture.
                                    </p>
                                    {errors.images && (
                                        <p className="text-sm text-red-600">
                                            {errors.images}
                                        </p>
                                    )}
                                </div>

                                <div className="flex justify-end border-t pt-4">
                                    <Button type="submit" disabled={processing}>
                                        <Save className="mr-2 h-4 w-4" />
                                        Create Team Member
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
