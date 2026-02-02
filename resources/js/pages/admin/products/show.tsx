import { Head, Link, usePage } from '@inertiajs/react';
import { ArrowLeft, Edit, ImageIcon, Package } from 'lucide-react';

import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/app-layout';
import { formatDate } from '@/lib/utils';
import { edit, index } from '@/routes/admin/products';
import { type BreadcrumbItem, type SharedData } from '@/types';

interface Category {
    id: number;
    name: string;
    name_ar: string;
}

interface MediaItem {
    id: number;
    name: string;
    file_name: string;
    mime_type: string;
    size: number;
    original_url: string;
}

interface ProductDetail {
    title_en: string;
    title_ar: string;
    value_en: string;
    value_ar: string;
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
    slug: string;
    category_id: number;
    is_active: boolean;
    grind_type: string | null;
    weight: number | null;
    product_details: ProductDetail[] | null;
    category: Category | null;
    media: MediaItem[];
    created_at: string;
    updated_at: string;
}

interface PageProps extends SharedData {
    product: Product;
}

export default function ProductShow() {
    const { auth, product } = usePage<PageProps>().props;

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Products',
            href: index().url,
        },
        {
            title: product.name,
            href: '',
        },
    ];

    const getGrindTypeLabel = (grindType: string | null): string => {
        if (!grindType) {
            return 'N/A';
        }

        const labels: Record<string, string> = {
            whole_bean: 'Whole Bean',
            coarse: 'Coarse',
            medium: 'Medium',
            fine: 'Fine',
            extra_fine: 'Extra Fine',
        };

        return labels[grindType] || grindType;
    };

    const getWeightLabel = (weight: number | null): string => {
        if (!weight) {
            return 'N/A';
        }

        return `${weight} kg`;
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Product: ${product.name}`} />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-4">
                        <Button variant="outline" size="sm" asChild>
                            <Link href={index().url}>
                                <ArrowLeft className="mr-2 h-4 w-4" />
                                Back to Products
                            </Link>
                        </Button>
                        <div>
                            <h1 className="text-2xl font-bold">
                                {product.name}
                            </h1>
                            <p className="text-muted-foreground">
                                Product details and information
                            </p>
                        </div>
                    </div>
                    <Button asChild>
                        <Link href={edit(product.id).url}>
                            <Edit className="mr-2 h-4 w-4" />
                            Edit Product
                        </Link>
                    </Button>
                </div>

                <div className="grid gap-6 lg:grid-cols-3">
                    {/* Product Images */}
                    <div className="lg:col-span-1">
                        <Card>
                            <CardHeader>
                                <CardTitle className="flex items-center gap-2">
                                    <ImageIcon className="h-5 w-5" />
                                    Product Images
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                {product.media && product.media.length > 0 ? (
                                    <div className="grid grid-cols-2 gap-2">
                                        {product.media.map((media) => (
                                            <div
                                                key={media.id}
                                                className="relative aspect-square overflow-hidden rounded-lg border"
                                            >
                                                <img
                                                    src={media.original_url}
                                                    alt={media.name}
                                                    className="h-full w-full object-cover"
                                                />
                                            </div>
                                        ))}
                                    </div>
                                ) : (
                                    <div className="flex flex-col items-center justify-center rounded-lg border border-dashed py-8">
                                        <ImageIcon className="h-12 w-12 text-muted-foreground" />
                                        <p className="mt-2 text-sm text-muted-foreground">
                                            No images uploaded
                                        </p>
                                    </div>
                                )}
                            </CardContent>
                        </Card>
                    </div>

                    {/* Product Information */}
                    <div className="lg:col-span-2">
                        <Card>
                            <CardHeader>
                                <CardTitle className="flex items-center gap-2">
                                    <Package className="h-5 w-5" />
                                    Product Information
                                </CardTitle>
                            </CardHeader>
                            <CardContent className="space-y-6">
                                {/* Status and Category */}
                                <div className="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <Label>Status</Label>
                                        <div className="mt-1">
                                            <Badge
                                                variant={
                                                    product.is_active
                                                        ? 'default'
                                                        : 'secondary'
                                                }
                                            >
                                                {product.is_active
                                                    ? 'Published'
                                                    : 'Draft'}
                                            </Badge>
                                        </div>
                                    </div>

                                    <div>
                                        <Label>Category</Label>
                                        <p className="mt-1 font-medium">
                                            {product.category?.name || 'N/A'}
                                        </p>
                                    </div>
                                </div>

                                {/* Names */}
                                <div className="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <Label>Name (English)</Label>
                                        <p className="mt-1 font-medium">
                                            {product.name}
                                        </p>
                                    </div>

                                    {product.name_ar && (
                                        <div>
                                            <Label>Name (Arabic)</Label>
                                            <p
                                                className="mt-1 font-medium"
                                                dir="rtl"
                                            >
                                                {product.name_ar}
                                            </p>
                                        </div>
                                    )}
                                </div>

                                {/* Pricing */}
                                <div className="grid gap-4 sm:grid-cols-3">
                                    <div>
                                        <Label>Price</Label>
                                        <p className="mt-1 text-lg font-semibold">
                                            EGP
                                            {Number(product.price)?.toFixed(2)}
                                        </p>
                                    </div>

                                    <div>
                                        <Label>Cost</Label>
                                        <p className="mt-1 font-medium">
                                            EGP
                                            {Number(product.cost)?.toFixed(2) ||
                                                '0.00'}
                                        </p>
                                    </div>

                                    <div>
                                        <Label>Stock</Label>
                                        <p className="mt-1 font-medium">
                                            {product.stock} units
                                        </p>
                                    </div>
                                </div>

                                {/* SKU and Slug */}
                                <div className="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <Label>SKU</Label>
                                        <p className="mt-1 font-mono text-sm">
                                            {product.sku}
                                        </p>
                                    </div>

                                    <div>
                                        <Label>Slug</Label>
                                        <p className="mt-1 font-mono text-sm">
                                            {product.slug}
                                        </p>
                                    </div>
                                </div>

                                {/* Grind Type and Weight */}
                                <div className="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <Label>Grind Type</Label>
                                        <p className="mt-1 font-medium">
                                            {getGrindTypeLabel(
                                                product.grind_type,
                                            )}
                                        </p>
                                    </div>

                                    <div>
                                        <Label>Weight</Label>
                                        <p className="mt-1 font-medium">
                                            {getWeightLabel(product.weight)}
                                        </p>
                                    </div>
                                </div>

                                {/* Descriptions */}
                                {product.description && (
                                    <div>
                                        <Label>Description (English)</Label>
                                        <p className="mt-1 text-sm whitespace-pre-wrap text-muted-foreground">
                                            {product.description}
                                        </p>
                                    </div>
                                )}

                                {product.description_ar && (
                                    <div>
                                        <Label>Description (Arabic)</Label>
                                        <p
                                            className="mt-1 text-sm whitespace-pre-wrap text-muted-foreground"
                                            dir="rtl"
                                        >
                                            {product.description_ar}
                                        </p>
                                    </div>
                                )}

                                {/* Product Details */}
                                {product.product_details &&
                                    product.product_details.length > 0 && (
                                        <div>
                                            <Label>Product Details</Label>
                                            <div className="mt-2 rounded-lg border">
                                                <table className="w-full">
                                                    <thead className="bg-muted/50">
                                                        <tr>
                                                            <th className="px-4 py-2 text-left text-sm font-medium">
                                                                Title
                                                            </th>
                                                            <th className="px-4 py-2 text-left text-sm font-medium">
                                                                Value
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {product.product_details.map(
                                                            (detail) => (
                                                                <tr
                                                                    key={`${detail.title_en}-${detail.value_en}`}
                                                                    className="border-t"
                                                                >
                                                                    <td className="px-4 py-2 text-sm">
                                                                        {
                                                                            detail.title_en
                                                                        }
                                                                    </td>
                                                                    <td className="px-4 py-2 text-sm text-muted-foreground">
                                                                        {
                                                                            detail.value_en
                                                                        }
                                                                    </td>
                                                                </tr>
                                                            ),
                                                        )}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    )}

                                {/* Dates */}
                                <div className="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <Label>Created</Label>
                                        <p className="mt-1 text-sm">
                                            {formatDate(product.created_at)}
                                        </p>
                                    </div>

                                    <div>
                                        <Label>Last Updated</Label>
                                        <p className="mt-1 text-sm">
                                            {formatDate(product.updated_at)}
                                        </p>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}

// Label component for consistency
function Label({
    children,
    className,
    ...props
}: React.HTMLAttributes<HTMLSpanElement>) {
    return (
        <span
            className={`text-sm font-medium text-muted-foreground ${className || ''}`}
            {...props}
        >
            {children}
        </span>
    );
}
