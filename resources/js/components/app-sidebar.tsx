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
import { dashboard } from '@/routes';
import categories from '@/routes/admin/categories';
import contactUs from '@/routes/admin/contact-us';
import inquiries from '@/routes/admin/inquiries';
import orders from '@/routes/admin/orders';
import products from '@/routes/admin/products';
import { environment } from '@/routes/admin/settings';
import teamMembers from '@/routes/admin/team-members';
import users from '@/routes/admin/users';
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
        href: orders.index(),
        icon: ShoppingBag,
    },
    {
        title: 'Products',
        href: products.index(),
        icon: Package,
    },
    {
        title: 'Categories',
        href: categories.index(),
        icon: Tag,
    },
    {
        title: 'Customers',
        href: users.index(),
        icon: User2Icon,
    },
    {
        title: 'Team Members',
        href: teamMembers.index(),
        icon: Users,
    },
    {
        title: 'Inquiries',
        href: inquiries.index(),
        icon: MessageSquare,
    },
    {
        title: 'Contact Us',
        href: contactUs.edit(),
        icon: Phone,
    },
    {
        title: 'Environment Settings',
        href: environment(),
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
