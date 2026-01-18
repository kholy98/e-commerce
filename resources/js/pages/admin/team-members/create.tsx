import { Head, Link, useForm } from '@inertiajs/react';
import { ArrowLeft, Save } from 'lucide-react';
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
        title: 'Create',
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
        post('/admin/team-members');
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
            <Head title="Create Team Member" />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center gap-4">
                    <Button variant="outline" asChild>
                        <Link href={adminTeamMembers()}>
                            <ArrowLeft className="mr-2 h-4 w-4" />
                            Back to Team Members
                        </Link>
                    </Button>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle>Create Team Member</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <form onSubmit={submit} className="space-y-6">
                            <div className="grid gap-4 md:grid-cols-2">
                                <div className="space-y-2">
                                    <Label htmlFor="fullname">Full Name</Label>
                                    <Input
                                        id="fullname"
                                        value={data.fullname}
                                        onChange={(e) =>
                                            setData('fullname', e.target.value)
                                        }
                                        required
                                    />
                                    {errors.fullname && (
                                        <p className="text-sm text-red-600">
                                            {errors.fullname}
                                        </p>
                                    )}
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="title">Title</Label>
                                    <Input
                                        id="title"
                                        value={data.title}
                                        onChange={(e) =>
                                            setData('title', e.target.value)
                                        }
                                        required
                                    />
                                    {errors.title && (
                                        <p className="text-sm text-red-600">
                                            {errors.title}
                                        </p>
                                    )}
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="email">Email</Label>
                                    <Input
                                        id="email"
                                        type="email"
                                        value={data.email}
                                        onChange={(e) =>
                                            setData('email', e.target.value)
                                        }
                                        required
                                    />
                                    {errors.email && (
                                        <p className="text-sm text-red-600">
                                            {errors.email}
                                        </p>
                                    )}
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="phone">Phone</Label>
                                    <Input
                                        id="phone"
                                        value={data.phone}
                                        onChange={(e) =>
                                            setData('phone', e.target.value)
                                        }
                                    />
                                    {errors.phone && (
                                        <p className="text-sm text-red-600">
                                            {errors.phone}
                                        </p>
                                    )}
                                </div>
                            </div>

                            <div className="space-y-2">
                                <Label>Social Media Links</Label>
                                {data.social_media.map((link, index) => (
                                    <div key={index} className="flex gap-2">
                                        <Input
                                            value={link}
                                            onChange={(e) =>
                                                updateSocialMediaLink(
                                                    index,
                                                    e.target.value,
                                                )
                                            }
                                            placeholder="https://..."
                                        />
                                        <Button
                                            type="button"
                                            variant="outline"
                                            onClick={() =>
                                                removeSocialMediaLink(index)
                                            }
                                        >
                                            Remove
                                        </Button>
                                    </div>
                                ))}
                                <Button
                                    type="button"
                                    variant="outline"
                                    onClick={addSocialMediaLink}
                                >
                                    Add Social Media Link
                                </Button>
                                {errors.social_media && (
                                    <p className="text-sm text-red-600">
                                        {errors.social_media}
                                    </p>
                                )}
                            </div>

                            <div className="space-y-2">
                                <Label htmlFor="images">Images</Label>
                                <Input
                                    id="images"
                                    type="file"
                                    multiple
                                    accept="image/*"
                                    onChange={handleImageChange}
                                />
                                {errors.images && (
                                    <p className="text-sm text-red-600">
                                        {errors.images}
                                    </p>
                                )}
                            </div>

                            <Button type="submit" disabled={processing}>
                                <Save className="mr-2 h-4 w-4" />
                                Create Team Member
                            </Button>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
