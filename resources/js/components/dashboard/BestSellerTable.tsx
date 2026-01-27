import { Badge } from '@/components/ui/badge';
import { Card } from '@/components/ui/card';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';

interface Product {
    id: number;
    name: string;
    flavor: string;
    price: number;
    sales: number;
    condition: string;
    image: string;
}

interface BestSellerTableProps {
    products: Product[];
}

export function BestSellerTable({ products }: BestSellerTableProps) {
    return (
        <div className="mt-8 space-y-4">
            <h2 className="text-xl font-semibold lowercase">best seller</h2>
            <Card className="overflow-hidden rounded-[24px] shadow-lg shadow-black/5">
                <Table>
                    <TableHeader>
                        <TableRow className="border-none hover:bg-transparent">
                            <TableHead className="font-bold">Product</TableHead>
                            <TableHead className="font-bold">price</TableHead>
                            <TableHead className="text-center font-bold">
                                Sales
                            </TableHead>
                            <TableHead className="text-center font-bold">
                                condition
                            </TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        {products.length > 0 ? (
                            products.map((product) => (
                                <TableRow
                                    key={product.id}
                                    className="last:border-none hover:bg-muted/30"
                                >
                                    <TableCell className="py-4">
                                        <div className="flex items-center gap-3">
                                            <img
                                                src={product.image}
                                                alt={product.name}
                                                className="h-10 w-10 rounded-lg object-cover"
                                            />
                                            <div>
                                                <p className="font-semibold">
                                                    {product.name}
                                                </p>
                                                <p className="text-xs text-muted-foreground">
                                                    {product.flavor}
                                                </p>
                                            </div>
                                        </div>
                                    </TableCell>
                                    <TableCell className="py-4">
                                        <div className="flex items-baseline gap-0.5">
                                            <span className="font-bold">
                                                {product.price.toFixed(2)}
                                            </span>
                                            <span className="text-[10px] font-bold uppercase">
                                                EGP
                                            </span>
                                        </div>
                                    </TableCell>
                                    <TableCell className="py-4 text-center font-bold">
                                        {product.sales}
                                    </TableCell>
                                    <TableCell className="py-4 text-center">
                                        <Badge className="rounded-lg border-none bg-[#BFA78E] px-4 py-1 font-medium text-white hover:bg-[#BFA78E]/90">
                                            {product.condition}
                                        </Badge>
                                    </TableCell>
                                </TableRow>
                            ))
                        ) : (
                            <TableRow>
                                <TableCell
                                    colSpan={4}
                                    className="py-12 text-center text-muted-foreground"
                                >
                                    No sales data available yet.
                                </TableCell>
                            </TableRow>
                        )}
                    </TableBody>
                </Table>
            </Card>
        </div>
    );
}
