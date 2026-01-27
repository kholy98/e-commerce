import { Link } from '@inertiajs/react';

import {
    SidebarGroup,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { useActiveUrl } from '@/hooks/use-active-url';
import { cn } from '@/lib/utils';
import { type NavItem } from '@/types';

export function NavMain({ items = [] }: { items: NavItem[] }) {
    const { urlIsActive } = useActiveUrl();

    return (
        <SidebarGroup className="px-0 py-0">
            <SidebarMenu>
                {items.map((item) => (
                    <SidebarMenuItem key={item.title}>
                        <SidebarMenuButton
                            asChild
                            isActive={urlIsActive(item.href)}
                            tooltip={{ children: item.title }}
                            className={cn(
                                'h-12 rounded-none px-6 transition-all',
                                'data-[active=true]:border-l-4 data-[active=true]:border-sidebar-primary data-[active=true]:bg-sidebar-accent data-[active=true]:text-sidebar-primary',
                            )}
                        >
                            <Link
                                href={item.href}
                                prefetch
                                className="flex w-full items-center gap-4"
                            >
                                {item.icon && <item.icon className="size-5" />}
                                <span className="text-sm font-medium">
                                    {item.title}
                                </span>
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                ))}
            </SidebarMenu>
        </SidebarGroup>
    );
}
