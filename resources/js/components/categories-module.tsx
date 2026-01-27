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

interface Category {
    id: number;
    name: string;
    slug: string;
    product_count: number;
    created_at: string;
}

interface CategoriesModuleProps {
    categories: Category[];
}

export function CategoriesModule({ categories }: CategoriesModuleProps) {
    return (
        <Card>
            <CardHeader>
                <CardTitle>Categories</CardTitle>
            </CardHeader>
            <CardContent>
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>Name</TableHead>
                            <TableHead>Slug</TableHead>
                            <TableHead>Products</TableHead>
                            <TableHead>Created</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        {categories.map((category) => (
                            <TableRow key={category.id}>
                                <TableCell className="font-medium">
                                    {category.name}
                                </TableCell>
                                <TableCell className="text-muted-foreground">
                                    {category.slug}
                                </TableCell>
                                <TableCell>
                                    <Badge variant="secondary">
                                        {category.product_count} products
                                    </Badge>
                                </TableCell>
                                <TableCell>
                                    {formatDate(category.created_at)}
                                </TableCell>
                            </TableRow>
                        ))}
                    </TableBody>
                </Table>
                {categories.length === 0 && (
                    <p className="py-4 text-center text-muted-foreground">
                        No categories found
                    </p>
                )}
            </CardContent>
        </Card>
    );
}
