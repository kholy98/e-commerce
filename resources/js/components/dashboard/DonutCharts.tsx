import { Cell, Pie, PieChart, ResponsiveContainer } from 'recharts';

import { Card } from '@/components/ui/card';

interface DonutProps {
    title: string;
    total: string | number;
    data: any[];
}

function Donut({ title, total, data }: DonutProps) {
    return (
        <Card className="flex items-center justify-between rounded-[24px] p-6 shadow-lg shadow-black/5">
            <div className="relative h-32 w-32">
                <ResponsiveContainer width="100%" height="100%">
                    <PieChart>
                        <Pie
                            data={data}
                            innerRadius={40}
                            outerRadius={55}
                            paddingAngle={5}
                            dataKey="value"
                            stroke="none"
                        >
                            {data.map((entry, index) => (
                                <Cell
                                    key={`cell-${index}`}
                                    fill={entry.color}
                                />
                            ))}
                        </Pie>
                    </PieChart>
                </ResponsiveContainer>
            </div>
            <div className="flex flex-col gap-1 text-right">
                <p className="text-sm font-medium text-muted-foreground">
                    {title}
                </p>
                <h3 className="text-2xl font-bold">{total}</h3>
                <div className="mt-2 flex flex-col items-end gap-1">
                    {data.map((item) => (
                        <div
                            key={item.name}
                            className="flex items-center gap-2"
                        >
                            <span className="text-[10px] text-muted-foreground">
                                {item.percentage}% {item.name}
                            </span>
                            <div
                                className="h-2 w-4 rounded-full"
                                style={{ backgroundColor: item.color }}
                            />
                        </div>
                    ))}
                </div>
            </div>
        </Card>
    );
}

interface DonutChartsProps {
    customerStats: {
        new: number;
        active: number;
        total: number;
    };
    userStats: {
        admins: number;
        customers: number;
    };
    orderStats: {
        complete: number;
        canceled: number;
        pending: number;
        total: number;
    };
}

export function DonutCharts({
    customerStats,
    userStats,
    orderStats,
}: DonutChartsProps) {
    const calcPerc = (val: number, total: number) =>
        total > 0 ? Math.round((val / total) * 100) : 0;

    const customerData = [
        {
            name: 'New',
            value: customerStats.new,
            percentage: calcPerc(customerStats.new, customerStats.total),
            color: '#5D3E1D',
        },
        {
            name: 'Active',
            value: customerStats.active,
            percentage: calcPerc(customerStats.active, customerStats.total),
            color: '#8B5E3C',
        },
        {
            name: 'Inactive',
            value: customerStats.total - customerStats.active,
            percentage: calcPerc(
                customerStats.total - customerStats.active,
                customerStats.total,
            ),
            color: '#E5E5E5',
        },
    ];

    const userTypeData = [
        {
            name: 'Admins',
            value: userStats.admins,
            percentage: calcPerc(
                userStats.admins,
                userStats.admins + userStats.customers,
            ),
            color: '#5D3E1D',
        },
        {
            name: 'Customers',
            value: userStats.customers,
            percentage: calcPerc(
                userStats.customers,
                userStats.admins + userStats.customers,
            ),
            color: '#8B5E3C',
        },
    ];

    const orderData = [
        {
            name: 'Complete',
            value: orderStats.complete,
            percentage: calcPerc(orderStats.complete, orderStats.total),
            color: '#5D3E1D',
        },
        {
            name: 'Canceled',
            value: orderStats.canceled,
            percentage: calcPerc(orderStats.canceled, orderStats.total),
            color: '#8B5E3C',
        },
        {
            name: 'In progress',
            value: orderStats.pending,
            percentage: calcPerc(orderStats.pending, orderStats.total),
            color: '#E5E5E5',
        },
    ];

    return (
        <div className="flex flex-col gap-4">
            <Donut
                title="Customers"
                total={customerStats.total.toLocaleString()}
                data={customerData}
            />
            <Donut
                title="Users by Type"
                total={(
                    userStats.admins + userStats.customers
                ).toLocaleString()}
                data={userTypeData}
            />
            <Donut
                title="Orders"
                total={orderStats.total.toLocaleString()}
                data={orderData}
            />
        </div>
    );
}
