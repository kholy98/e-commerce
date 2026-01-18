import { Head, Link, router, usePage } from '@inertiajs/react';
import { ArrowLeft, Save } from 'lucide-react';
import { useState } from 'react';

import ImageUpload from '@/components/image-upload';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/app-layout';
import { adminProducts } from '@/routes';
import { type BreadcrumbItem, type SharedData } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Products',
        href: adminProducts(),
    },
    {
        title: 'Edit Product',
        href: '/admin/products/{product}/edit',
    },
];

interface Category {
    id: number;
    name: string;
    name_ar: string;
}

interface Product {
    id: number;
    name: string;
    name_ar: string;
    description: string;
    description_ar: string;
    price: number;
    cost: number;
    stock: number;
    sku: string;
    category_id: number;
    is_active: boolean;
    media: Array<{
        id: number;
        name: string;
        file_name: string;
        mime_type: string;
        size: number;
        url: string;
    }>;
}

interface Props {
    product: Product;
    categories: Category[];
}

export default function ProductEdit({ product, categories }: Props) {
    const { auth } = usePage<SharedData>().props;
    const [loading, setLoading] = useState(false);

    // Form state
    const [name, setName] = useState(product.name);
    const [nameAr, setNameAr] = useState(product.name_ar || '');
    const [description, setDescription] = useState(product.description);
    const [descriptionAr, setDescriptionAr] = useState(
        product.description_ar || '',
    );
    const [price, setPrice] = useState(product.price.toString());
    const [cost, setCost] = useState(product.cost?.toString() || '');
    const [stock, setStock] = useState(product.stock.toString());
    const [sku, setSku] = useState(product.sku);
    const [categoryId, setCategoryId] = useState(
        product.category_id.toString(),
    );
    const [isActive, setIsActive] = useState(product.is_active);
    const [images, setImages] = useState<File[]>([]);
    const [existingImages, setExistingImages] = useState(product.media || []);
    const [imagesToDelete, setImagesToDelete] = useState<number[]>([]);

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        setLoading(true);

        try {
            const formData = new FormData();
            formData.append('name', name);
            formData.append('name_ar', nameAr);
            formData.append('description', description);
            formData.append('description_ar', descriptionAr);
            formData.append('price', price);
            formData.append('cost', cost);
            formData.append('stock', stock);
            formData.append('sku', sku);
            formData.append('category_id', categoryId);
            formData.append('is_active', isActive ? '1' : '0');

            // Add new images
            images.forEach((image, index) => {
                formData.append(`images[${index}]`, image);
            });

            // Add images to delete
            imagesToDelete.forEach((imageId) => {
                formData.append('remove_images[]', imageId.toString());
            });

            router.post(`/admin/products/${product.id}`, formData, {
                onSuccess: () => {
                    router.visit(adminProducts());
                },
                onError: (errors) => {
                    console.error('Failed to update product:', errors);
                    alert(
                        'Failed to update product. Please check the form data.',
                    );
                },
            });
        } catch (error) {
            console.error('Failed to update product:', error);
            alert('Failed to update product. Please try again.');
        } finally {
            setLoading(false);
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit Product" />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold">Edit Product</h1>
                        <p className="text-muted-foreground">
                            Update product information and images
                        </p>
                    </div>
                    <Button variant="outline" asChild>
                        <Link href={adminProducts()}>
                            <ArrowLeft className="mr-2 h-4 w-4" />
                            Back to Products
                        </Link>
                    </Button>
                </div>

                <form onSubmit={handleSubmit}>
                    <div className="grid gap-6 md:grid-cols-2">
                        {/* Basic Information */}
                        <Card>
                            <CardHeader>
                                <CardTitle>Basic Information</CardTitle>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                <div className="space-y-2">
                                    <Label htmlFor="name">Name (English)</Label>
                                    <Input
                                        id="name"
                                        value={name}
                                        onChange={(e) =>
                                            setName(e.target.value)
                                        }
                                        required
                                    />
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="name_ar">
                                        Name (Arabic)
                                    </Label>
                                    <Input
                                        id="name_ar"
                                        value={nameAr}
                                        onChange={(e) =>
                                            setNameAr(e.target.value)
                                        }
                                    />
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="description">
                                        Description (English)
                                    </Label>
                                    <Textarea
                                        id="description"
                                        value={description}
                                        onChange={(e) =>
                                            setDescription(e.target.value)
                                        }
                                        rows={3}
                                        required
                                    />
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="description_ar">
                                        Description (Arabic)
                                    </Label>
                                    <Textarea
                                        id="description_ar"
                                        value={descriptionAr}
                                        onChange={(e) =>
                                            setDescriptionAr(e.target.value)
                                        }
                                        rows={3}
                                    />
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="sku">SKU</Label>
                                    <Input
                                        id="sku"
                                        value={sku}
                                        onChange={(e) => setSku(e.target.value)}
                                        required
                                    />
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="category">Category</Label>
                                    <Select
                                        value={categoryId}
                                        onValueChange={setCategoryId}
                                    >
                                        <SelectTrigger>
                                            <SelectValue placeholder="Select a category" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            {categories.map((category) => (
                                                <SelectItem
                                                    key={category.id}
                                                    value={category.id.toString()}
                                                >
                                                    {category.name}
                                                </SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                </div>

                                <div className="flex items-center space-x-2">
                                    <Checkbox
                                        id="is_active"
                                        checked={isActive}
                                        onCheckedChange={(checked) =>
                                            setIsActive(checked as boolean)
                                        }
                                    />
                                    <Label htmlFor="is_active">Active</Label>
                                </div>
                            </CardContent>
                        </Card>

                        {/* Pricing & Inventory */}
                        <Card>
                            <CardHeader>
                                <CardTitle>Pricing & Inventory</CardTitle>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                <div className="space-y-2">
                                    <Label htmlFor="price">Price ($)</Label>
                                    <Input
                                        id="price"
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        value={price}
                                        onChange={(e) =>
                                            setPrice(e.target.value)
                                        }
                                        required
                                    />
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="cost">Cost ($)</Label>
                                    <Input
                                        id="cost"
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        value={cost}
                                        onChange={(e) =>
                                            setCost(e.target.value)
                                        }
                                    />
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="stock">
                                        Stock Quantity
                                    </Label>
                                    <Input
                                        id="stock"
                                        type="number"
                                        min="0"
                                        value={stock}
                                        onChange={(e) =>
                                            setStock(e.target.value)
                                        }
                                        required
                                    />
                                </div>
                            </CardContent>
                        </Card>

                        {/* Images */}
                        <Card className="md:col-span-2">
                            <CardHeader>
                                <CardTitle>Product Images</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <ImageUpload
                                    files={images}
                                    existingImages={existingImages}
                                    imagesToDelete={imagesToDelete}
                                    onFilesChange={setImages}
                                    onRemoveExisting={(imageId) => {
                                        setImagesToDelete((prev) =>
                                            prev.includes(imageId)
                                                ? prev.filter(
                                                      (id) => id !== imageId,
                                                  )
                                                : [...prev, imageId],
                                        );
                                    }}
                                    onRemoveFile={(index) => {
                                        const newImages = images.filter(
                                            (_, i) => i !== index,
                                        );
                                        setImages(newImages);
                                    }}
                                />
                            </CardContent>
                        </Card>
                    </div>

                    <div className="mt-6 flex justify-end">
                        <Button type="submit" disabled={loading}>
                            <Save className="mr-2 h-4 w-4" />
                            {loading ? 'Updating...' : 'Update Product'}
                        </Button>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
