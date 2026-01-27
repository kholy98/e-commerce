import { Head, Link, usePage } from '@inertiajs/react';
import { ArrowLeft, Edit, Package } from 'lucide-react';

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
import { formatDate } from '@/lib/utils';
import {
    adminCategories,
    adminCategoriesEdit,
    adminProductsShow,
} from '@/routes';
import { type BreadcrumbItem, type SharedData } from '@/types';

interface Product {
    id: number;
    name: string;
    price: number;
    stock: number;
    is_active: boolean;
    slug: string;
    created_at: string;
}

interface Category {
    id: number;
    name: string;
    name_ar: string;
    description: string | null;
    description_ar: string | null;
    slug: string;
    is_active: boolean;
    product_count: number;
    products: Product[];
    created_at: string;
    updated_at: string;
}

interface PageProps extends SharedData {
    category: Category;
}

export default function CategoriesShow() {
    const { auth, category } = usePage<PageProps>().props;

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Categories',
            href: adminCategories(),
        },
        {
            title: category.name,
            href: adminCategories(),
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Category: ${category.name}`} />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-4">
                        <Button variant="outline" size="sm" asChild>
                            <Link href={adminCategories()}>
                                <ArrowLeft className="mr-2 h-4 w-4" />
                                Back to Categories
                            </Link>
                        </Button>
                        <div>
                            <h1 className="text-2xl font-bold">
                                {category.name}
                            </h1>
                            <p className="text-muted-foreground">
                                Category details and associated products
                            </p>
                        </div>
                    </div>
                    <Button asChild>
                        <Link href={adminCategoriesEdit(category.id)}>
                            <Edit className="mr-2 h-4 w-4" />
                            Edit Category
                        </Link>
                    </Button>
                </div>

                <div className="grid gap-6 md:grid-cols-3">
                    {/* Category Information */}
                    <div className="md:col-span-1">
                        <Card>
                            <CardHeader>
                                <CardTitle className="flex items-center gap-2">
                                    <Package className="h-5 w-5" />
                                    Category Information
                                </CardTitle>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                <div>
                                    <Label className="text-sm font-medium text-muted-foreground">
                                        Status
                                    </Label>
                                    <div className="mt-1">
                                        <Badge
                                            variant={
                                                category.is_active
                                                    ? 'default'
                                                    : 'secondary'
                                            }
                                        >
                                            {category.is_active
                                                ? 'Active'
                                                : 'Inactive'}
                                        </Badge>
                                    </div>
                                </div>

                                <div>
                                    <Label className="text-sm font-medium text-muted-foreground">
                                        Name (English)
                                    </Label>
                                    <p className="mt-1 font-medium">
                                        {category.name}
                                    </p>
                                </div>

                                {category.name_ar && (
                                    <div>
                                        <Label className="text-sm font-medium text-muted-foreground">
                                            Name (Arabic)
                                        </Label>
                                        <p
                                            className="mt-1 font-medium"
                                            dir="rtl"
                                        >
                                            {category.name_ar}
                                        </p>
                                    </div>
                                )}

                                {category.description && (
                                    <div>
                                        <Label className="text-sm font-medium text-muted-foreground">
                                            Description (English)
                                        </Label>
                                        <p className="mt-1 text-sm">
                                            {category.description}
                                        </p>
                                    </div>
                                )}

                                {category.description_ar && (
                                    <div>
                                        <Label className="text-sm font-medium text-muted-foreground">
                                            Description (Arabic)
                                        </Label>
                                        <p className="mt-1 text-sm" dir="rtl">
                                            {category.description_ar}
                                        </p>
                                    </div>
                                )}

                                <div>
                                    <Label className="text-sm font-medium text-muted-foreground">
                                        Slug
                                    </Label>
                                    <p className="mt-1 font-mono text-sm">
                                        {category.slug}
                                    </p>
                                </div>

                                <div>
                                    <Label className="text-sm font-medium text-muted-foreground">
                                        Total Products
                                    </Label>
                                    <p className="mt-1 text-lg font-semibold">
                                        {category.product_count}
                                    </p>
                                </div>

                                <div>
                                    <Label className="text-sm font-medium text-muted-foreground">
                                        Created
                                    </Label>
                                    <p className="mt-1 text-sm">
                                        {formatDate(category.created_at)}
                                    </p>
                                </div>

                                <div>
                                    <Label className="text-sm font-medium text-muted-foreground">
                                        Last Updated
                                    </Label>
                                    <p className="mt-1 text-sm">
                                        {formatDate(category.updated_at)}
                                    </p>
                                </div>
                            </CardContent>
                        </Card>
                    </div>

                    {/* Associated Products */}
                    <div className="md:col-span-2">
                        <Card>
                            <CardHeader>
                                <CardTitle>Associated Products</CardTitle>
                                <p className="text-sm text-muted-foreground">
                                    Products in this category
                                </p>
                            </CardHeader>
                            <CardContent>
                                {category.products &&
                                category.products.length > 0 ? (
                                    <Table>
                                        <TableHeader>
                                            <TableRow>
                                                <TableHead>Name</TableHead>
                                                <TableHead>Price</TableHead>
                                                <TableHead>Stock</TableHead>
                                                <TableHead>Status</TableHead>
                                                <TableHead>Created</TableHead>
                                                <TableHead className="w-[100px]">
                                                    Actions
                                                </TableHead>
                                            </TableRow>
                                        </TableHeader>
                                        <TableBody>
                                            {category.products.map(
                                                (product) => (
                                                    <TableRow key={product.id}>
                                                        <TableCell className="font-medium">
                                                            {product.name}
                                                        </TableCell>
                                                        <TableCell>
                                                            $
                                                            {product.price.toFixed(
                                                                2,
                                                            )}
                                                        </TableCell>
                                                        <TableCell>
                                                            {product.stock}
                                                        </TableCell>
                                                        <TableCell>
                                                            <Badge
                                                                variant={
                                                                    product.is_active
                                                                        ? 'default'
                                                                        : 'secondary'
                                                                }
                                                            >
                                                                {product.is_active
                                                                    ? 'Active'
                                                                    : 'Inactive'}
                                                            </Badge>
                                                        </TableCell>
                                                        <TableCell>
                                                            {formatDate(
                                                                product.created_at,
                                                            )}
                                                        </TableCell>
                                                        <TableCell>
                                                            <Button
                                                                variant="ghost"
                                                                size="sm"
                                                                asChild
                                                            >
                                                                <Link
                                                                    href={adminProductsShow(
                                                                        product.id,
                                                                    )}
                                                                >
                                                                    View
                                                                </Link>
                                                            </Button>
                                                        </TableCell>
                                                    </TableRow>
                                                ),
                                            )}
                                        </TableBody>
                                    </Table>
                                ) : (
                                    <div className="py-8 text-center">
                                        <Package className="mx-auto h-12 w-12 text-muted-foreground" />
                                        <h3 className="mt-4 text-lg font-medium">
                                            No products found
                                        </h3>
                                        <p className="mt-2 text-sm text-muted-foreground">
                                            This category doesn't have any
                                            products yet.
                                        </p>
                                    </div>
                                )}
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
}: React.LabelHTMLAttributes<HTMLLabelElement>) {
    return (
        <label
            className={`text-sm leading-none font-medium peer-disabled:cursor-not-allowed peer-disabled:opacity-70 ${className || ''}`}
            {...props}
        >
            {children}
        </label>
    );
}
