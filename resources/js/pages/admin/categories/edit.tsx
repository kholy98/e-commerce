import { Head, Link, router, usePage } from '@inertiajs/react';
import { ArrowLeft, Save } from 'lucide-react';
import { useState } from 'react';

import SingleImageUpload from '@/components/single-image-upload';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/app-layout';
import { adminCategories } from '@/routes';
import { type BreadcrumbItem, type SharedData } from '@/types';

interface Category {
    id: number;
    name: string;
    name_ar: string;
    description: string | null;
    description_ar: string | null;
    slug: string;
    is_active: boolean;
    product_count: number;
    created_at: string;
    updated_at: string;
    media?: Array<{
        id: number;
        name: string;
        file_name: string;
        mime_type: string;
        size: number;
        url: string;
    }>;
}

interface PageProps extends SharedData {
    category: Category;
}

export default function CategoriesEdit() {
    const { auth, category } = usePage<PageProps>().props;
    const [loading, setLoading] = useState(false);
    const [formData, setFormData] = useState({
        name: category.name,
        name_ar: category.name_ar || '',
        description: category.description || '',
        description_ar: category.description_ar || '',
        is_active: category.is_active,
    });
    const [image, setImage] = useState<File | null>(null);
    const [removeImage, setRemoveImage] = useState(false);
    const [errors, setErrors] = useState<Record<string, string>>({});

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Categories',
            href: adminCategories(),
        },
        {
            title: category.name,
            href: adminCategories(),
        },
        {
            title: 'Edit Category',
            href: adminCategories(),
        },
    ];

    const handleInputChange = (field: string, value: string | boolean) => {
        setFormData((prev) => ({
            ...prev,
            [field]: value,
        }));
        // Clear error when user starts typing
        if (errors[field]) {
            setErrors((prev) => ({
                ...prev,
                [field]: '',
            }));
        }
    };

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        setLoading(true);
        setErrors({});

        try {
            const formDataToSend = new FormData();
            formDataToSend.append('name', formData.name);
            formDataToSend.append('name_ar', formData.name_ar);
            formDataToSend.append('description', formData.description);
            formDataToSend.append('description_ar', formData.description_ar);
            formDataToSend.append('is_active', formData.is_active ? '1' : '0');

            // Handle image
            if (image) {
                formDataToSend.append('image', image);
            }
            if (removeImage) {
                formDataToSend.append('remove_image', '1');
            }

            router.post(`/admin/categories/${category.id}`, formDataToSend, {
                onSuccess: () => {
                    router.visit(adminCategories());
                },
                onError: (errors) => {
                    setErrors(errors);
                },
            });
        } catch (error) {
            console.error('Failed to update category:', error);
            setErrors({
                general: 'Failed to update category. Please try again.',
            });
        } finally {
            setLoading(false);
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Edit Category: ${category.name}`} />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center gap-4">
                    <Button variant="outline" size="sm" asChild>
                        <Link href={adminCategories()}>
                            <ArrowLeft className="mr-2 h-4 w-4" />
                            Back to Categories
                        </Link>
                    </Button>
                    <div>
                        <h1 className="text-2xl font-bold">Edit Category</h1>
                        <p className="text-muted-foreground">
                            Update category information
                        </p>
                    </div>
                </div>

                <Card className="max-w-2xl">
                    <CardHeader>
                        <CardTitle>Category Information</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <form onSubmit={handleSubmit} className="space-y-6">
                            {errors.general && (
                                <div className="rounded-md bg-destructive/15 p-3 text-sm text-destructive">
                                    {errors.general}
                                </div>
                            )}

                            <div className="grid gap-4 md:grid-cols-2">
                                <div className="space-y-2">
                                    <Label htmlFor="name">
                                        Name (English) *
                                    </Label>
                                    <Input
                                        id="name"
                                        value={formData.name}
                                        onChange={(e) =>
                                            handleInputChange(
                                                'name',
                                                e.target.value,
                                            )
                                        }
                                        placeholder="Enter category name"
                                        className={
                                            errors.name
                                                ? 'border-destructive'
                                                : ''
                                        }
                                    />
                                    {errors.name && (
                                        <p className="text-sm text-destructive">
                                            {errors.name}
                                        </p>
                                    )}
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="name_ar">
                                        Name (Arabic)
                                    </Label>
                                    <Input
                                        id="name_ar"
                                        value={formData.name_ar}
                                        onChange={(e) =>
                                            handleInputChange(
                                                'name_ar',
                                                e.target.value,
                                            )
                                        }
                                        placeholder="Enter category name in Arabic"
                                        dir="rtl"
                                        className={
                                            errors.name_ar
                                                ? 'border-destructive'
                                                : ''
                                        }
                                    />
                                    {errors.name_ar && (
                                        <p className="text-sm text-destructive">
                                            {errors.name_ar}
                                        </p>
                                    )}
                                </div>
                            </div>

                            <div className="grid gap-4 md:grid-cols-2">
                                <div className="space-y-2">
                                    <Label htmlFor="description">
                                        Description (English)
                                    </Label>
                                    <Textarea
                                        id="description"
                                        value={formData.description}
                                        onChange={(e) =>
                                            handleInputChange(
                                                'description',
                                                e.target.value,
                                            )
                                        }
                                        placeholder="Enter category description"
                                        rows={3}
                                        className={
                                            errors.description
                                                ? 'border-destructive'
                                                : ''
                                        }
                                    />
                                    {errors.description && (
                                        <p className="text-sm text-destructive">
                                            {errors.description}
                                        </p>
                                    )}
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="description_ar">
                                        Description (Arabic)
                                    </Label>
                                    <Textarea
                                        id="description_ar"
                                        value={formData.description_ar}
                                        onChange={(e) =>
                                            handleInputChange(
                                                'description_ar',
                                                e.target.value,
                                            )
                                        }
                                        placeholder="Enter category description in Arabic"
                                        rows={3}
                                        dir="rtl"
                                        className={
                                            errors.description_ar
                                                ? 'border-destructive'
                                                : ''
                                        }
                                    />
                                    {errors.description_ar && (
                                        <p className="text-sm text-destructive">
                                            {errors.description_ar}
                                        </p>
                                    )}
                                </div>
                            </div>

                            <div className="space-y-2">
                                <Label>Category Image</Label>
                                <SingleImageUpload
                                    file={image}
                                    existingImage={category.media?.[0]}
                                    onFileChange={(file) => {
                                        setImage(file);
                                        setRemoveImage(false);
                                    }}
                                    label="Upload category image"
                                />
                                {category.media?.[0] && (
                                    <div className="flex items-center space-x-2">
                                        <Checkbox
                                            id="remove_image"
                                            checked={removeImage}
                                            onCheckedChange={(checked) => {
                                                setRemoveImage(!!checked);
                                                if (checked) {
                                                    setImage(null);
                                                }
                                            }}
                                        />
                                        <Label htmlFor="remove_image">
                                            Remove current image
                                        </Label>
                                    </div>
                                )}
                            </div>

                            <div className="flex items-center space-x-2">
                                <Checkbox
                                    id="is_active"
                                    checked={formData.is_active}
                                    onCheckedChange={(checked) =>
                                        handleInputChange(
                                            'is_active',
                                            !!checked,
                                        )
                                    }
                                />
                                <Label htmlFor="is_active">Active</Label>
                            </div>

                            <div className="rounded-md bg-muted p-4">
                                <h4 className="mb-2 text-sm font-medium">
                                    Category Statistics
                                </h4>
                                <div className="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span className="text-muted-foreground">
                                            Products:
                                        </span>
                                        <span className="ml-2 font-medium">
                                            {category.product_count}
                                        </span>
                                    </div>
                                    <div>
                                        <span className="text-muted-foreground">
                                            Created:
                                        </span>
                                        <span className="ml-2 font-medium">
                                            {new Date(
                                                category.created_at,
                                            ).toLocaleDateString()}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div className="flex gap-4">
                                <Button type="submit" disabled={loading}>
                                    <Save className="mr-2 h-4 w-4" />
                                    {loading
                                        ? 'Updating...'
                                        : 'Update Category'}
                                </Button>
                                <Button type="button" variant="outline" asChild>
                                    <Link href={adminCategories()}>Cancel</Link>
                                </Button>
                            </div>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
