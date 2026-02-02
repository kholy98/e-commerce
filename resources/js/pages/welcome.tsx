import { Head, Link } from '@inertiajs/react';

import { Button } from '@/components/ui/button';
import { login } from '@/routes';

export default function Welcome() {
    return (
        <>
            <Head title="Welcome" />
            <div className="relative flex min-h-screen flex-col items-center justify-center overflow-hidden bg-linear-to-br from-background via-background to-muted/20 p-6">
                {/* Decorative background elements */}
                <div className="absolute inset-0 overflow-hidden">
                    <div className="absolute -top-[10%] -left-[10%] h-[40%] w-[40%] rounded-full bg-primary/5 blur-[120px]" />
                    <div className="absolute -right-[10%] -bottom-[10%] h-[40%] w-[40%] rounded-full bg-primary/5 blur-[120px]" />
                </div>

                {/* Content */}
                <div className="relative z-10 flex flex-col items-center gap-8 text-center">
                    {/* Logo */}
                    <div className="animate-fade-in-up">
                        <img
                            src="/atheer-logo-black.svg"
                            alt="Al-Ather"
                            className="h-20 w-auto transition-opacity hover:opacity-90 dark:hidden"
                        />
                        <img
                            src="/atheer-logo-sandbeach.svg"
                            alt="Al-Ather"
                            className="hidden h-20 w-auto transition-opacity hover:opacity-90 dark:block"
                        />
                    </div>

                    {/* Welcome message */}
                    <div
                        className="animate-fade-in-up space-y-3 opacity-0"
                        style={{ animationDelay: '0.1s' }}
                    >
                        <h1 className="text-4xl font-bold tracking-tight text-foreground sm:text-5xl">
                            Welcome to Al-Ather
                        </h1>
                        <p className="max-w-md text-lg text-muted-foreground sm:text-xl">
                            Your gateway to a premium e-commerce experience
                        </p>
                    </div>

                    {/* Login button with enhanced styling */}
                    <div
                        className="animate-fade-in-up opacity-0"
                        style={{ animationDelay: '0.2s' }}
                    >
                        <Link href={login()}>
                            <Button
                                size="lg"
                                tabIndex={-1}
                                className="h-14 px-8 text-lg font-semibold shadow-lg transition-all duration-300 hover:shadow-xl"
                            >
                                Get Started
                            </Button>
                        </Link>
                    </div>

                    {/* Trust indicators */}
                    <div
                        className="animate-fade-in-up flex items-center gap-6 text-sm text-muted-foreground opacity-0"
                        style={{ animationDelay: '0.3s' }}
                    >
                        <div className="flex items-center gap-2">
                            <svg
                                className="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth={2}
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                            <span>Secure</span>
                        </div>
                        <div className="flex items-center gap-2">
                            <svg
                                className="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth={2}
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                            <span>Fast</span>
                        </div>
                        <div className="flex items-center gap-2">
                            <svg
                                className="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth={2}
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                            <span>Reliable</span>
                        </div>
                    </div>
                </div>

                {/* Footer */}
                <div
                    className="animate-fade-in-up absolute bottom-8 text-sm text-muted-foreground opacity-0"
                    style={{ animationDelay: '0.4s' }}
                >
                    © {new Date().getFullYear()} Al-Ather. All rights reserved.
                </div>
            </div>
        </>
    );
}
