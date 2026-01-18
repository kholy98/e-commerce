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
        title: 'Create Product',
        href: '/admin/products/create',
    },
];

interface Category {
    id: number;
    name: string;
    name_ar: string;
}

interface Props {
    categories: Category[];
}

export default function ProductCreate({ categories }: Props) {
    const { auth } = usePage<SharedData>().props;
    const [loading, setLoading] = useState(false);

    // Form state
    const [name, setName] = useState('');
    const [nameAr, setNameAr] = useState('');
    const [description, setDescription] = useState('');
    const [descriptionAr, setDescriptionAr] = useState('');
    const [price, setPrice] = useState('');
    const [cost, setCost] = useState('');
    const [stock, setStock] = useState('');
    const [sku, setSku] = useState('');
    const [categoryId, setCategoryId] = useState('');
    const [isActive, setIsActive] = useState(true);
    const [grindType, setGrindType] = useState('');
    const [weight, setWeight] = useState('');
    const [productDetails, setProductDetails] = useState<
        Array<{
            title_en: string;
            title_ar: string;
            value_en: string;
            value_ar: string;
        }>
    >([]);
    const [images, setImages] = useState<File[]>([]);

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

            // Add images
            images.forEach((image, index) => {
                formData.append(`images[${index}]`, image);
            });

            router.post('/admin/products', formData, {
                onSuccess: () => {
                    router.visit(adminProducts());
                },
                onError: (errors) => {
                    console.error('Failed to create product:', errors);
                    alert(
                        'Failed to create product. Please check the form data.',
                    );
                },
            });
        } catch (error) {
            console.error('Failed to create product:', error);
            alert('Failed to create product. Please try again.');
        } finally {
            setLoading(false);
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Product" />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold">Create Product</h1>
                        <p className="text-muted-foreground">
                            Add a new product to your inventory
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

                                <div className="space-y-2">
                                    <Label htmlFor="grind_type">
                                        Grind Type
                                    </Label>
                                    <Select
                                        value={grindType}
                                        onValueChange={setGrindType}
                                    >
                                        <SelectTrigger>
                                            <SelectValue placeholder="Select grind type" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectItem value="whole_bean">
                                                Whole Bean
                                            </SelectItem>
                                            <SelectItem value="coarse">
                                                Coarse
                                            </SelectItem>
                                            <SelectItem value="medium">
                                                Medium
                                            </SelectItem>
                                            <SelectItem value="fine">
                                                Fine
                                            </SelectItem>
                                            <SelectItem value="extra_fine">
                                                Extra Fine
                                            </SelectItem>
                                        </SelectContent>
                                    </Select>
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="weight">Weight</Label>
                                    <Select
                                        value={weight}
                                        onValueChange={setWeight}
                                    >
                                        <SelectTrigger>
                                            <SelectValue placeholder="Select weight" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectItem value="0.125">
                                                125g
                                            </SelectItem>
                                            <SelectItem value="0.250">
                                                250g
                                            </SelectItem>
                                            <SelectItem value="0.500">
                                                500g
                                            </SelectItem>
                                            <SelectItem value="1.000">
                                                1kg
                                            </SelectItem>
                                        </SelectContent>
                                    </Select>
                                </div>

                                <div className="space-y-2">
                                    <Label>Product Details</Label>
                                    {productDetails.map((detail, index) => (
                                        <div
                                            key={index}
                                            className="space-y-2 rounded border p-4"
                                        >
                                            <div className="grid grid-cols-2 gap-2">
                                                <Input
                                                    placeholder="Title (EN)"
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
                                                />
                                                <Input
                                                    placeholder="Title (AR)"
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
                                                />
                                            </div>
                                            <div className="grid grid-cols-2 gap-2">
                                                <Input
                                                    placeholder="Value (EN)"
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
                                                />
                                                <Input
                                                    placeholder="Value (AR)"
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
                                                />
                                            </div>
                                            <Button
                                                type="button"
                                                variant="outline"
                                                onClick={() => {
                                                    setProductDetails(
                                                        productDetails.filter(
                                                            (_, i) =>
                                                                i !== index,
                                                        ),
                                                    );
                                                }}
                                            >
                                                Remove
                                            </Button>
                                        </div>
                                    ))}
                                    <Button
                                        type="button"
                                        variant="outline"
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
                                        Add Detail
                                    </Button>
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
                                    existingImages={[]}
                                    imagesToDelete={[]}
                                    onFilesChange={setImages}
                                    onRemoveExisting={() => {}}
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
                            {loading ? 'Creating...' : 'Create Product'}
                        </Button>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
