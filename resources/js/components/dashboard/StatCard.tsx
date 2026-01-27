import { LucideIcon } from 'lucide-react';

import { Card } from '@/components/ui/card';

interface StatCardProps {
    title: string;
    value: string | number;
    icon: LucideIcon;
}

export function StatCard({ title, value, icon: Icon }: StatCardProps) {
    return (
        <Card className="rounded-lg p-6 shadow-lg shadow-black/5">
            <div className="flex flex-col gap-4">
                <div className="flex items-center justify-start">
                    <div className="flex h-12 w-12 items-center justify-center rounded-2xl bg-accent">
                        <Icon className="h-6 w-6" />
                    </div>
                </div>
                <div className="space-y-1">
                    <p className="text-sm font-medium text-muted-foreground">
                        {title}
                    </p>
                    <h3 className="text-2xl font-bold">{value}</h3>
                </div>
            </div>
        </Card>
    );
}
