import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import { formatDate } from '@/lib/utils';

interface Product {
    id: number;
    name: string;
    price: number;
    stock: number;
    is_active: boolean;
    category: string | null;
    created_at: string;
}

interface ProductsModuleProps {
    products: Product[];
}

export function ProductsModule({ products }: ProductsModuleProps) {
    return (
        <Card>
            <CardHeader>
                <CardTitle>Recent Products</CardTitle>
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
                                            ? 'Active'
                                            : 'Inactive'}
                                    </Badge>
                                </TableCell>
                                <TableCell>
                                    {product.category || 'N/A'}
                                </TableCell>
                                <TableCell>
                                    {formatDate(product.created_at)}
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
            </CardContent>
        </Card>
    );
}
