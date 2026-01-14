import { Link, usePage } from '@inertiajs/react';

export default function Layout({ children }) {
    const { auth } = usePage().props;

    return (
        <div className="min-h-screen bg-gray-100 flex">
            {/* Sidebar */}
            <div className="w-64 bg-white shadow-lg">
                <div className="flex flex-col h-full">
                    <div className="flex items-center justify-center h-16 bg-gray-800">
                        <Link href={route('dashboard')} className="text-xl font-bold text-white">
                            Ecommerce Admin
                        </Link>
                    </div>
                    <nav className="flex-1 px-4 py-6 space-y-2">
                        <Link
                            href={route('dashboard')}
                            className="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md"
                        >
                            <span className="ml-2">Dashboard</span>
                        </Link>
                        <Link
                            href={route('products.index')}
                            className="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md"
                        >
                            <span className="ml-2">Products</span>
                        </Link>
                        <Link
                            href={route('categories.index')}
                            className="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md"
                        >
                            <span className="ml-2">Categories</span>
                        </Link>
                    </nav>
                </div>
            </div>

            {/* Main content */}
            <div className="flex-1 flex flex-col">
                {/* Top bar */}
                <header className="bg-white shadow h-16 flex items-center justify-end px-6">
                    {auth.user ? (
                        <div className="flex items-center">
                            <span className="text-gray-700 mr-4">{auth.user.name}</span>
                            <Link
                                href={route('logout')}
                                method="post"
                                as="button"
                                className="text-gray-500 hover:text-gray-700"
                            >
                                Logout
                            </Link>
                        </div>
                    ) : (
                        <Link
                            href={route('login')}
                            className="text-gray-500 hover:text-gray-700"
                        >
                            Login
                        </Link>
                    )}
                </header>

                {/* Page content */}
                <main className="flex-1 p-6">
                    {children}
                </main>
            </div>
        </div>
    );
}