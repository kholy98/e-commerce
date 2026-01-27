import { Link } from '@inertiajs/react';
import {
    LayoutGrid,
    MessageSquare,
    Package,
    Phone,
    Settings,
    ShoppingBag,
    Tag,
    User2Icon,
    Users,
} from 'lucide-react';

import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import {
    adminCategories,
    adminContactUs,
    adminInquiries,
    adminOrders,
    adminProducts,
    adminSettingsEnvironment,
    adminTeamMembers,
    adminUsers,
    dashboard,
} from '@/routes';
import { type NavItem } from '@/types';

import AppLogo from './app-logo';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Orders',
        href: adminOrders(),
        icon: ShoppingBag,
    },
    {
        title: 'Products',
        href: adminProducts(),
        icon: Package,
    },
    {
        title: 'Categories',
        href: adminCategories(),
        icon: Tag,
    },
    {
        title: 'Customers',
        href: adminUsers(),
        icon: User2Icon,
    },
    {
        title: 'Team Members',
        href: adminTeamMembers(),
        icon: Users,
    },
    {
        title: 'Inquiries',
        href: adminInquiries(),
        icon: MessageSquare,
    },
    {
        title: 'Contact Us',
        href: adminContactUs(),
        icon: Phone,
    },
    {
        title: 'Environment Settings',
        href: adminSettingsEnvironment(),
        icon: Settings,
    },
];

export function AppSidebar() {
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
                            <Link href={dashboard()} prefetch>
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
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
