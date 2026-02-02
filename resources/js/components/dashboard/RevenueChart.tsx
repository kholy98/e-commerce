import { useEffect, useState } from 'react';
import {
    Area,
    AreaChart,
    CartesianGrid,
    ResponsiveContainer,
    Tooltip,
    XAxis,
    YAxis,
} from 'recharts';

import { Card } from '@/components/ui/card';
import { revenue } from '@/routes/dashboard';

interface RevenueChartProps {
    data: Array<{ name: string; value: number }>;
}

export function RevenueChart({ data: initialData }: RevenueChartProps) {
    const [filter, setFilter] = useState('Daily');
    const [chartData, setChartData] = useState(initialData);
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        // Skip fetch on first mount if initialData is provided and filter is Daily
        if (filter === 'Daily' && chartData === initialData) return;

        const fetchRevenue = async () => {
            setLoading(true);
            try {
                const res = await fetch(
                    revenue.url({ query: { period: filter.toLowerCase() } }),
                    {
                        headers: {
                            Accept: 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        credentials: 'same-origin',
                    },
                );
                const responseData = await res.json();
                console.log(responseData);
                if (responseData.success) {
                    setChartData(responseData.data);
                }
            } catch (error) {
                console.error('Failed to fetch revenue data:', error);
            } finally {
                setLoading(false);
            }
        };

        fetchRevenue();
    }, [filter]);

    // Format data for display (placeholder if empty)
    const displayData =
        chartData && chartData.length > 0
            ? chartData
            : [
                  { name: '10AM', value: 0 },
                  { name: '11AM', value: 0 },
                  { name: '12PM', value: 0 },
                  { name: '1PM', value: 0 },
                  { name: '2PM', value: 0 },
                  { name: '3PM', value: 0 },
                  { name: '4PM', value: 0 },
              ];

    return (
        <Card
            className={`rounded-lg p-6 shadow-lg shadow-black/5 transition-opacity ${loading ? 'opacity-50' : 'opacity-100'}`}
        >
            <div className="mb-6 flex items-center justify-between">
                <h2 className="text-2xl font-semibold">All Revenues</h2>
                <div className="flex rounded-xl bg-[#f5f5f5] p-1">
                    {['Daily', 'Monthly', 'Yearly'].map((item) => (
                        <button
                            key={item}
                            onClick={() => setFilter(item)}
                            disabled={loading}
                            className={`rounded-lg px-4 py-1.5 text-sm font-medium transition-all ${
                                filter === item
                                    ? 'bg-[#5D3E1D] text-white shadow-md'
                                    : 'text-muted-foreground hover:bg-gray-200'
                            } disabled:cursor-not-allowed`}
                        >
                            {item}
                        </button>
                    ))}
                </div>
            </div>
            <div className="h-[300px] w-full">
                <ResponsiveContainer width="100%" height="100%">
                    <AreaChart data={displayData}>
                        <defs>
                            <linearGradient
                                id="colorValue"
                                x1="0"
                                y1="0"
                                x2="0"
                                y2="1"
                            >
                                <stop
                                    offset="5%"
                                    stopColor="#5D3E1D"
                                    stopOpacity={0.1}
                                />
                                <stop
                                    offset="95%"
                                    stopColor="#5D3E1D"
                                    stopOpacity={0}
                                />
                            </linearGradient>
                        </defs>
                        <CartesianGrid
                            vertical={false}
                            strokeDasharray="3 3"
                            stroke="#f0f0f0"
                        />
                        <XAxis
                            dataKey="name"
                            axisLine={false}
                            tickLine={false}
                            tick={{ fill: '#9ca3af', fontSize: 12 }}
                            dy={10}
                        />
                        <YAxis hide />
                        <Tooltip
                            content={({ active, payload }) => {
                                if (active && payload && payload.length) {
                                    return (
                                        <div className="relative bottom-12 rounded-xl bg-[#5D3E1D] px-4 py-2 text-white shadow-lg">
                                            <p className="text-xl font-bold">
                                                {payload[0].value.toLocaleString()}
                                            </p>
                                        </div>
                                    );
                                }
                                return null;
                            }}
                            cursor={{
                                stroke: '#5D3E1D',
                                strokeWidth: 2,
                                strokeDasharray: '5 5',
                            }}
                        />
                        <Area
                            type="monotone"
                            dataKey="value"
                            stroke="#5D3E1D"
                            strokeWidth={3}
                            fillOpacity={1}
                            fill="url(#colorValue)"
                            dot={{
                                r: 6,
                                fill: '#fff',
                                stroke: '#5D3E1D',
                                strokeWidth: 2,
                            }}
                            activeDot={{
                                r: 8,
                                fill: '#5D3E1D',
                                stroke: '#fff',
                                strokeWidth: 2,
                            }}
                        />
                    </AreaChart>
                </ResponsiveContainer>
            </div>
        </Card>
    );
}
