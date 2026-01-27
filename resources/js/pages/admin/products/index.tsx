import { Head, Link, usePage } from '@inertiajs/react';
import { Edit, Eye, Plus, Search, Trash2 } from 'lucide-react';
import { useEffect, useState } from 'react';

import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
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
    adminProducts,
    adminProductsApi,
    adminProductsCreate,
    adminProductsEdit,
    adminProductsShow,
} from '@/routes';
import { type BreadcrumbItem, type SharedData } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Products',
        href: adminProducts(),
    },
];

interface Product {
    id: number;
    name: string;
    price: number;
    stock: number;
    is_active: boolean;
    category: string | null;
    created_at: string;
}

interface ProductsResponse {
    data: {
        success: boolean;
        en: Product[];
        ar: Product[];
        pagination: {
            current_page: number;
            last_page: number;
            per_page: number;
            total: number;
        };
    };
}

export default function ProductsIndex() {
    const { auth } = usePage<SharedData>().props;
    const [products, setProducts] = useState<Product[]>([]);
    const [loading, setLoading] = useState(true);
    const [search, setSearch] = useState('');
    const [currentPage, setCurrentPage] = useState(1);
    const [totalPages, setTotalPages] = useState(1);

    const fetchProducts = async (page = 1, searchTerm = '') => {
        try {
            const params = new URLSearchParams({
                page: page.toString(),
                per_page: '15',
            });

            if (searchTerm) {
                params.append('search', searchTerm);
            }

            const response = await fetch(
                `${adminProductsApi().url}?${params}`,
                {
                    headers: {
                        Accept: 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    credentials: 'same-origin',
                },
            );

            const data: ProductsResponse = await response.json();
            setProducts(data.data.en);
            setTotalPages(data.data.pagination.last_page);
            setCurrentPage(data.data.pagination.current_page);
        } catch (error) {
            console.error('Failed to fetch products:', error);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchProducts();
    }, []);

    const handleSearch = (e: React.FormEvent) => {
        e.preventDefault();
        fetchProducts(1, search);
    };

    const handleDelete = async (productId: number) => {
        if (!confirm('Are you sure you want to delete this product?')) {
            return;
        }

        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute('content');

        fetch(`/admin/products/${productId}`, {
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
                    fetchProducts(currentPage, search);
                } else {
                    alert(data.message || 'Failed to delete product');
                }
            })
            .catch((error) => {
                console.error('Failed to delete product:', error);
            });
    };

    if (loading) {
        return (
            <AppLayout breadcrumbs={breadcrumbs}>
                <Head title="Products" />
                <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                    <div className="grid auto-rows-min gap-4 md:grid-cols-3">
                        {[...Array(8)].map((_, i) => (
                            <div
                                key={i}
                                className="relative aspect-video animate-pulse overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
                            >
                                <div className="absolute inset-0 bg-muted" />
                            </div>
                        ))}
                    </div>
                </div>
            </AppLayout>
        );
    }

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Products" />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold">Products</h1>
                        <p className="text-muted-foreground">
                            Manage your product inventory
                        </p>
                    </div>
                    <Button asChild>
                        <Link href={adminProductsCreate()}>
                            <Plus className="mr-2 h-4 w-4" />
                            Add Product
                        </Link>
                    </Button>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle>All Products</CardTitle>
                        <form onSubmit={handleSearch} className="flex gap-2">
                            <div className="relative flex-1">
                                <Search className="absolute top-1/2 left-3 h-4 w-4 -translate-y-1/2 text-muted-foreground" />
                                <Input
                                    placeholder="Search products..."
                                    value={search}
                                    onChange={(e) => setSearch(e.target.value)}
                                    className="pl-9"
                                />
                            </div>
                            <Button type="submit" variant="outline">
                                Search
                            </Button>
                        </form>
                    </CardHeader>
                    <CardContent>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Name</TableHead>
                                    <TableHead>Price</TableHead>
                                    <TableHead>Stock</TableHead>
                                    <TableHead>Status</TableHead>
                                    <TableHead>Category</TableHead>
                                    <TableHead>Created</TableHead>
                                    <TableHead className="w-[100px]">
                                        Actions
                                    </TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {products.map((product) => (
                                    <TableRow key={product.id}>
                                        <TableCell className="font-medium">
                                            {product.name}
                                        </TableCell>
                                        <TableCell>
                                            ${product.price.toFixed(2)}
                                        </TableCell>
                                        <TableCell>{product.stock}</TableCell>
                                        <TableCell>
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
                                        </TableCell>
                                        <TableCell>
                                            {product.category || 'N/A'}
                                        </TableCell>
                                        <TableCell>
                                            {formatDate(product.created_at)}
                                        </TableCell>
                                        <TableCell>
                                            <div className="flex items-center gap-2">
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
                                                        <Eye className="h-4 w-4" />
                                                    </Link>
                                                </Button>
                                                <Button
                                                    variant="ghost"
                                                    size="sm"
                                                    asChild
                                                >
                                                    <Link
                                                        href={adminProductsEdit(
                                                            product.id,
                                                        )}
                                                    >
                                                        <Edit className="h-4 w-4" />
                                                    </Link>
                                                </Button>
                                                <Button
                                                    variant="ghost"
                                                    size="sm"
                                                    onClick={() =>
                                                        handleDelete(product.id)
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
                        {products.length === 0 && (
                            <p className="py-4 text-center text-muted-foreground">
                                No products found
                            </p>
                        )}

                        {/* Pagination */}
                        {totalPages > 1 && (
                            <div className="mt-4 flex justify-center gap-2">
                                <Button
                                    variant="outline"
                                    disabled={currentPage === 1}
                                    onClick={() =>
                                        fetchProducts(currentPage - 1, search)
                                    }
                                >
                                    Previous
                                </Button>
                                <span className="flex items-center px-3">
                                    Page {currentPage} of {totalPages}
                                </span>
                                <Button
                                    variant="outline"
                                    disabled={currentPage === totalPages}
                                    onClick={() =>
                                        fetchProducts(currentPage + 1, search)
                                    }
                                >
                                    Next
                                </Button>
                            </div>
                        )}
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
