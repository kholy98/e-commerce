import { Head, router, usePage } from '@inertiajs/react';
import { Save } from 'lucide-react';
import { useState } from 'react';

import ImageUpload from '@/components/image-upload';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
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
import { cn } from '@/lib/utils';
import { index } from '@/routes/admin/products';
import { type BreadcrumbItem, type SharedData } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Products',
        href: index(),
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
    grind_type?: string;
    weight?: number;
    product_details?: Array<{
        title_en: string;
        title_ar: string;
        value_en: string;
        value_ar: string;
    }>;
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
    const [grindType, setGrindType] = useState(product.grind_type || '');
    const [weight, setWeight] = useState(product.weight?.toString() || '');
    const [productDetails, setProductDetails] = useState<
        Array<{
            title_en: string;
            title_ar: string;
            value_en: string;
            value_ar: string;
        }>
    >(product.product_details || []);
    const [images, setImages] = useState<File[]>([]);
    const [existingImages, setExistingImages] = useState(product.media || []);
    const [imagesToDelete, setImagesToDelete] = useState<number[]>([]);

    const handleSubmit = async (status: 'draft' | 'published') => {
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
            formData.append('is_active', status === 'published' ? '1' : '0');
            if (grindType) formData.append('grind_type', grindType);
            if (weight) formData.append('weight', weight);
            productDetails.forEach((detail, index) => {
                formData.append(
                    `product_details[${index}][title_en]`,
                    detail.title_en,
                );
                formData.append(
                    `product_details[${index}][title_ar]`,
                    detail.title_ar,
                );
                formData.append(
                    `product_details[${index}][value_en]`,
                    detail.value_en,
                );
                formData.append(
                    `product_details[${index}][value_ar]`,
                    detail.value_ar,
                );
            });

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
                    router.visit(index());
                },
                onError: (errors) => {
                    console.error('Failed to update product:', errors);
                    alert(
                        'Failed to update product. Please check the form data.',
                    );
                },
                onFinish: () => setLoading(false),
            });
        } catch (error) {
            console.error('Failed to update product:', error);
            alert('Failed to update product. Please try again.');
            setLoading(false);
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit Product" />

            <div className="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-4 md:p-8">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold tracking-tight text-[#4A3426]">
                            Edit Product
                        </h1>
                    </div>
                </div>

                <div className="grid grid-cols-1 gap-8 lg:grid-cols-3">
                    {/* Left Column - Main Content */}
                    <div className="space-y-8 lg:col-span-2">
                        {/* Basic Details */}
                        <div className="space-y-4">
                            <h2 className="text-xl font-bold text-[#4A3426]">
                                Basic Details
                            </h2>
                            <Card className="border-none shadow-sm">
                                <CardContent className="space-y-6 pt-6">
                                    <div className="grid gap-6 md:grid-cols-2">
                                        <div className="space-y-2">
                                            <Label
                                                htmlFor="name"
                                                className="text-base font-medium"
                                            >
                                                Product Name (English)*
                                            </Label>
                                            <Input
                                                id="name"
                                                value={name}
                                                onChange={(e) =>
                                                    setName(e.target.value)
                                                }
                                                required
                                                className="bg-muted/30"
                                            />
                                        </div>
                                        <div className="space-y-2">
                                            <Label
                                                htmlFor="name_ar"
                                                className="text-base font-medium"
                                            >
                                                Product Name (Arabic)*
                                            </Label>
                                            <Input
                                                id="name_ar"
                                                value={nameAr}
                                                onChange={(e) =>
                                                    setNameAr(e.target.value)
                                                }
                                                className="bg-muted/30"
                                            />
                                        </div>
                                    </div>

                                    <div className="space-y-2">
                                        <Label
                                            htmlFor="description"
                                            className="text-base font-medium"
                                        >
                                            Product Description (English)*
                                        </Label>
                                        <Textarea
                                            id="description"
                                            value={description}
                                            onChange={(e) =>
                                                setDescription(e.target.value)
                                            }
                                            rows={4}
                                            required
                                            className="resize-none bg-muted/30"
                                        />
                                    </div>

                                    <div className="space-y-2">
                                        <Label
                                            htmlFor="description_ar"
                                            className="text-base font-medium"
                                        >
                                            Product Description (Arabic)*
                                        </Label>
                                        <Textarea
                                            id="description_ar"
                                            value={descriptionAr}
                                            onChange={(e) =>
                                                setDescriptionAr(e.target.value)
                                            }
                                            rows={4}
                                            className="resize-none bg-muted/30"
                                        />
                                    </div>
                                </CardContent>
                            </Card>
                        </div>

                        {/* Product Details (Specifications) */}
                        <div className="space-y-4">
                            <h2 className="text-xl font-bold text-[#4A3426]">
                                Product Details (English)*
                            </h2>
                            <Card className="border-none shadow-sm">
                                <CardHeader>
                                    <CardTitle>Specifications</CardTitle>
                                </CardHeader>
                                <CardContent className="space-y-4">
                                    {productDetails.map((detail, index) => (
                                        <div
                                            key={index}
                                            className="rounded-lg border bg-muted/20 p-4"
                                        >
                                            <div className="mb-2 flex items-center justify-between">
                                                <h4 className="text-sm font-medium">
                                                    Detail #{index + 1}
                                                </h4>
                                                <Button
                                                    type="button"
                                                    variant="ghost"
                                                    size="sm"
                                                    className="h-8 w-8 p-0 text-destructive hover:text-destructive/90"
                                                    onClick={() => {
                                                        setProductDetails(
                                                            productDetails.filter(
                                                                (_, i) =>
                                                                    i !== index,
                                                            ),
                                                        );
                                                    }}
                                                >
                                                    <span className="sr-only">
                                                        Remove
                                                    </span>
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        strokeWidth="2"
                                                        strokeLinecap="round"
                                                        strokeLinejoin="round"
                                                        className="h-4 w-4"
                                                    >
                                                        <path d="M3 6h18" />
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                    </svg>
                                                </Button>
                                            </div>
                                            <div className="grid gap-4 md:grid-cols-2">
                                                <div className="space-y-2">
                                                    <Input
                                                        placeholder="Title (e.g. Origin)"
                                                        value={detail.title_en}
                                                        onChange={(e) => {
                                                            const newDetails = [
                                                                ...productDetails,
                                                            ];
                                                            newDetails[
                                                                index
                                                            ].title_en =
                                                                e.target.value;
                                                            setProductDetails(
                                                                newDetails,
                                                            );
                                                        }}
                                                        className="bg-white"
                                                    />
                                                    <Input
                                                        placeholder="Value (e.g. Ethiopia)"
                                                        value={detail.value_en}
                                                        onChange={(e) => {
                                                            const newDetails = [
                                                                ...productDetails,
                                                            ];
                                                            newDetails[
                                                                index
                                                            ].value_en =
                                                                e.target.value;
                                                            setProductDetails(
                                                                newDetails,
                                                            );
                                                        }}
                                                        className="bg-white"
                                                    />
                                                </div>
                                                <div className="space-y-2">
                                                    <Input
                                                        placeholder="Title (Arabic)"
                                                        value={detail.title_ar}
                                                        onChange={(e) => {
                                                            const newDetails = [
                                                                ...productDetails,
                                                            ];
                                                            newDetails[
                                                                index
                                                            ].title_ar =
                                                                e.target.value;
                                                            setProductDetails(
                                                                newDetails,
                                                            );
                                                        }}
                                                        className="bg-white text-right"
                                                        dir="rtl"
                                                    />
                                                    <Input
                                                        placeholder="Value (Arabic)"
                                                        value={detail.value_ar}
                                                        onChange={(e) => {
                                                            const newDetails = [
                                                                ...productDetails,
                                                            ];
                                                            newDetails[
                                                                index
                                                            ].value_ar =
                                                                e.target.value;
                                                            setProductDetails(
                                                                newDetails,
                                                            );
                                                        }}
                                                        className="bg-white text-right"
                                                        dir="rtl"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    ))}
                                    <Button
                                        type="button"
                                        variant="outline"
                                        className="w-full border-dashed"
                                        onClick={() => {
                                            setProductDetails([
                                                ...productDetails,
                                                {
                                                    title_en: '',
                                                    title_ar: '',
                                                    value_en: '',
                                                    value_ar: '',
                                                },
                                            ]);
                                        }}
                                    >
                                        + Add Specification
                                    </Button>
                                </CardContent>
                            </Card>
                        </div>

                        {/* Pricing */}
                        <div className="space-y-4">
                            <h2 className="text-xl font-bold text-[#4A3426]">
                                Pricing
                            </h2>
                            <Card className="border-none shadow-sm">
                                <CardContent className="space-y-4 pt-6">
                                    <div className="space-y-2">
                                        <Label
                                            htmlFor="price"
                                            className="text-base font-medium"
                                        >
                                            Product Price
                                        </Label>
                                        <div className="relative">
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
                                                className="bg-muted/30 pl-8"
                                            />
                                            <span className="absolute top-2.5 left-3 text-muted-foreground">
                                                EGP
                                            </span>
                                        </div>
                                    </div>
                                    <div className="space-y-2">
                                        <Label
                                            htmlFor="cost"
                                            className="text-base font-medium"
                                        >
                                            Cost Price (Internal)
                                        </Label>
                                        <div className="relative">
                                            <Input
                                                id="cost"
                                                type="number"
                                                step="0.01"
                                                min="0"
                                                value={cost}
                                                onChange={(e) =>
                                                    setCost(e.target.value)
                                                }
                                                className="bg-muted/30 pl-8"
                                            />
                                            <span className="absolute top-2.5 left-3 text-muted-foreground">
                                                $
                                            </span>
                                        </div>
                                    </div>
                                </CardContent>
                            </Card>
                        </div>

                        {/* Inventory */}
                        <div className="space-y-4">
                            <h2 className="text-xl font-bold text-[#4A3426]">
                                Inventory
                            </h2>
                            <Card className="border-none shadow-sm">
                                <CardContent className="space-y-4 pt-6">
                                    <div className="space-y-2">
                                        <Label
                                            htmlFor="stock"
                                            className="text-base font-medium"
                                        >
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
                                            className="bg-muted/30"
                                            placeholder="Unlimited or number"
                                        />
                                    </div>
                                    <div className="space-y-2">
                                        <Label
                                            htmlFor="sku"
                                            className="text-base font-medium"
                                        >
                                            SKU
                                        </Label>
                                        <Input
                                            id="sku"
                                            value={sku}
                                            onChange={(e) =>
                                                setSku(e.target.value)
                                            }
                                            required
                                            className="bg-muted/30"
                                        />
                                    </div>
                                </CardContent>
                            </Card>
                        </div>
                    </div>

                    {/* Right Column - Sidebar */}
                    <div className="space-y-8">
                        {/* Image Upload */}
                        <div className="space-y-4">
                            <h2 className="text-xl font-bold text-[#4A3426]">
                                Upload Product Image
                            </h2>
                            <Card className="border-none shadow-sm">
                                <CardContent className="h-max pt-6">
                                    <Label className="mb-3 block text-base font-medium">
                                        Product Image
                                    </Label>
                                    <ImageUpload
                                        files={images}
                                        existingImages={existingImages}
                                        imagesToDelete={imagesToDelete}
                                        onFilesChange={setImages}
                                        onRemoveExisting={(imageId) => {
                                            setImagesToDelete((prev) =>
                                                prev.includes(imageId)
                                                    ? prev.filter(
                                                          (id) =>
                                                              id !== imageId,
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

                        {/* Categories */}
                        <div className="space-y-4">
                            <h2 className="text-xl font-bold text-[#4A3426]">
                                Categories
                            </h2>
                            <Card className="border-none shadow-sm">
                                <CardContent className="space-y-6 pt-6">
                                    <div className="space-y-2">
                                        <Label
                                            htmlFor="category"
                                            className="text-base font-medium"
                                        >
                                            Product Categories
                                        </Label>
                                        <Select
                                            value={categoryId}
                                            onValueChange={setCategoryId}
                                        >
                                            <SelectTrigger className="h-11 bg-muted/30">
                                                <SelectValue placeholder="Select your product" />
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

                                    <div className="space-y-2">
                                        <Label
                                            htmlFor="grind_type"
                                            className="text-base font-medium"
                                        >
                                            Grind Type
                                        </Label>
                                        <div className="flex flex-wrap gap-2">
                                            {[
                                                {
                                                    label: 'Light',
                                                    value: 'light',
                                                },
                                                {
                                                    label: 'Medium',
                                                    value: 'medium',
                                                },
                                                {
                                                    label: 'Dark',
                                                    value: 'dark',
                                                },
                                            ].map((type) => (
                                                <Button
                                                    key={type.value}
                                                    type="button"
                                                    variant={
                                                        grindType === type.value
                                                            ? 'default'
                                                            : 'outline'
                                                    }
                                                    onClick={() =>
                                                        setGrindType(type.value)
                                                    }
                                                    className={cn(
                                                        'flex-1',
                                                        grindType === type.value
                                                            ? 'bg-[#4A3426] text-white hover:bg-[#4A3426]/90'
                                                            : '',
                                                    )}
                                                >
                                                    {type.label}
                                                </Button>
                                            ))}
                                        </div>
                                    </div>

                                    <div className="space-y-2">
                                        <Label
                                            htmlFor="weight"
                                            className="text-base font-medium"
                                        >
                                            Product size
                                        </Label>
                                        <div className="flex flex-wrap gap-2">
                                            {[
                                                {
                                                    label: '125g',
                                                    value: '0.125',
                                                },
                                                {
                                                    label: '250g',
                                                    value: '0.250',
                                                },
                                                {
                                                    label: '500g',
                                                    value: '0.500',
                                                },
                                                {
                                                    label: '1kg',
                                                    value: '1.000',
                                                },
                                            ].map((w) => (
                                                <Button
                                                    key={w.value}
                                                    type="button"
                                                    variant={
                                                        weight === w.value
                                                            ? 'default'
                                                            : 'outline'
                                                    }
                                                    onClick={() =>
                                                        setWeight(w.value)
                                                    }
                                                    className={cn(
                                                        'flex-1',
                                                        Number(weight) ==
                                                            Number(w.value)
                                                            ? 'bg-[#4A3426] text-white hover:bg-[#4A3426]/90'
                                                            : '',
                                                    )}
                                                >
                                                    {w.label}
                                                </Button>
                                            ))}
                                        </div>
                                    </div>
                                </CardContent>
                            </Card>
                        </div>
                    </div>
                    {/* Action Buttons */}
                    <div className="flex w-full gap-4 pt-4 lg:col-span-3">
                        <Button
                            type="button"
                            variant="outline"
                            className="h-12 flex-1 border-[#4A3426] text-base font-medium text-[#4A3426] hover:bg-[#4A3426]/10"
                            onClick={() => handleSubmit('draft')}
                            disabled={loading}
                        >
                            <Save className="mr-2 h-4 w-4" />
                            Save to draft
                        </Button>
                        <Button
                            type="button"
                            className="h-12 flex-1 bg-[#4A3426] text-base font-medium text-white hover:bg-[#4A3426]/90"
                            onClick={() => handleSubmit('published')}
                            disabled={loading}
                        >
                            {loading ? 'Updating...' : 'Update & Publish'}
                        </Button>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
