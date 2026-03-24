import { Link } from '@inertiajs/react';
import { LayoutGrid, LogOut } from 'lucide-react';

import { NavMain } from '@/components/nav-main';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { type NavItem } from '@/types';

import AppLogo from './app-logo';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/supplier/dashboard',
        icon: LayoutGrid,
    },
];

export function SupplierSidebar() {
    return (
        <Sidebar collapsible="icon" variant="sidebar">
            <SidebarHeader className="">
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton
                            size="lg"
                            asChild
                            className="h-auto p-0 hover:bg-transparent active:bg-transparent"
                        >
                            <Link href="/supplier/dashboard" prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={mainNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <form action="/supplier/logout" method="post">
                    <input
                        type="hidden"
                        name="_token"
                        value={document
                            .querySelector('meta[name="csrf-token"]')
                            ?.getAttribute('content')}
                    />
                    <SidebarMenu>
                        <SidebarMenuItem>
                            <SidebarMenuButton asChild>
                                <button
                                    type="submit"
                                    className="flex w-full items-center gap-2"
                                >
                                    <LogOut className="size-4" />
                                    <span>Logout</span>
                                </button>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    </SidebarMenu>
                </form>
            </SidebarFooter>
        </Sidebar>
    );
}
