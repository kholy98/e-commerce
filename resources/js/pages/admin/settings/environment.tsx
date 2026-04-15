import { Head } from '@inertiajs/react';
import { AlertCircle, Eye, EyeOff, Loader2 } from 'lucide-react';
import { FormEvent, useEffect, useState } from 'react';

import { Alert, AlertDescription } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { environment } from '@/routes/admin/settings';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin',
        href: '#',
    },
    {
        title: 'Environment Settings',
        href: environment().url,
    },
];

interface EnvStatus {
    status: {
        file_path: string;
        is_writable: boolean;
        config_cached: boolean;
    };
    laravel_active_values: {
        PAYMOB_BASE_URL: string;
        PAYMOB_API_KEY: string;
        PAYMOB_INTEGRATION_ID: string;
        PAYMOB_IFRAME_ID: string;
        BOSTA_API_KEY: string;
        BOSTA_BASE_URL: string;
        MAIL_MAILER: string;
        MAIL_SCHEME: string;
        MAIL_HOST: string;
        MAIL_PORT: string;
        MAIL_USERNAME: string;
        MAIL_PASSWORD: string;
        MAIL_FROM_ADDRESS: string;
        MAIL_FROM_NAME: string;
        FRONTEND_URL: string;
    };
}

export default function EnvironmentSettings() {
    const [envStatus, setEnvStatus] = useState<EnvStatus | null>(null);
    const [loading, setLoading] = useState(true);
    const [saving, setSaving] = useState(false);
    const [message, setMessage] = useState<{
        type: 'success' | 'error';
        text: string;
    } | null>(null);

    const [formData, setFormData] = useState({
        PAYMOB_BASE_URL: '',
        PAYMOB_API_KEY: '',
        PAYMOB_INTEGRATION_ID: '',
        PAYMOB_IFRAME_ID: '',
        BOSTA_API_KEY: '',
        BOSTA_BASE_URL: '',
        MAIL_MAILER: '',
        MAIL_SCHEME: '',
        MAIL_HOST: '',
        MAIL_PORT: '',
        MAIL_USERNAME: '',
        MAIL_PASSWORD: '',
        MAIL_FROM_ADDRESS: '',
        MAIL_FROM_NAME: '',
        FRONTEND_URL: '',
    });

    const [visiblePasswords, setVisiblePasswords] = useState<
        Record<string, boolean>
    >({});

    useEffect(() => {
        fetchEnvStatus();
    }, []);

    const fetchEnvStatus = async () => {
        try {
            setLoading(true);
            const response = await fetch('/api/settings/env/debug', {
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                credentials: 'same-origin',
            });

            const data: EnvStatus = await response.json();
            setEnvStatus(data);

            // Populate form with current values
            setFormData((prev) => ({
                ...prev,
                PAYMOB_BASE_URL:
                    data.laravel_active_values.PAYMOB_BASE_URL || '',
                PAYMOB_API_KEY: data.laravel_active_values.PAYMOB_API_KEY || '',
                PAYMOB_INTEGRATION_ID:
                    data.laravel_active_values.PAYMOB_INTEGRATION_ID || '',
                PAYMOB_IFRAME_ID:
                    data.laravel_active_values.PAYMOB_IFRAME_ID || '',
                BOSTA_API_KEY: data.laravel_active_values.BOSTA_API_KEY || '',
                BOSTA_BASE_URL: data.laravel_active_values.BOSTA_BASE_URL || '',
                MAIL_MAILER: data.laravel_active_values.MAIL_MAILER || '',
                MAIL_SCHEME: data.laravel_active_values.MAIL_SCHEME || '',
                MAIL_HOST: data.laravel_active_values.MAIL_HOST || '',
                MAIL_PORT: data.laravel_active_values.MAIL_PORT || '',
                MAIL_USERNAME: data.laravel_active_values.MAIL_USERNAME || '',
                MAIL_PASSWORD: data.laravel_active_values.MAIL_PASSWORD || '',
                MAIL_FROM_ADDRESS:
                    data.laravel_active_values.MAIL_FROM_ADDRESS || '',
                MAIL_FROM_NAME: data.laravel_active_values.MAIL_FROM_NAME || '',
                FRONTEND_URL: data.laravel_active_values.FRONTEND_URL || '',
            }));
        } catch (error) {
            console.error('Failed to fetch environment status:', error);
            setMessage({
                type: 'error',
                text: 'Failed to load environment settings',
            });
        } finally {
            setLoading(false);
        }
    };

    const handleInputChange = (
        e: React.ChangeEvent<HTMLInputElement>,
        field: keyof typeof formData,
    ) => {
        setFormData((prev) => ({
            ...prev,
            [field]: e.target.value,
        }));
    };

    const togglePasswordVisibility = (field: string) => {
        setVisiblePasswords((prev) => ({
            ...prev,
            [field]: !prev[field],
        }));
    };

    const handleSubmit = async (e: FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        setSaving(true);
        setMessage(null);

        try {
            const response = await fetch('/api/settings/env', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                credentials: 'same-origin',
                body: JSON.stringify(formData),
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.error || 'Failed to update environment');
            }

            setMessage({
                type: 'success',
                text:
                    data.message || 'Environment settings updated successfully',
            });

            // Refresh status after successful save
            setTimeout(() => {
                fetchEnvStatus();
            }, 500);
        } catch (error) {
            setMessage({
                type: 'error',
                text:
                    error instanceof Error
                        ? error.message
                        : 'Failed to update environment settings',
            });
        } finally {
            setSaving(false);
        }
    };

    const handleFieldSave = async (
        e: React.MouseEvent<HTMLButtonElement>,
        fieldName: keyof typeof formData,
    ) => {
        e.preventDefault();
        setSaving(true);
        setMessage(null);

        const fieldData = {
            [fieldName]: formData[fieldName],
        };

        try {
            const response = await fetch('/api/settings/env', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                credentials: 'same-origin',
                body: JSON.stringify(fieldData),
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.error || 'Failed to update environment');
            }

            setMessage({
                type: 'success',
                text: data.message || `${fieldName} updated successfully`,
            });

            // Refresh status after successful save
            setTimeout(() => {
                fetchEnvStatus();
            }, 500);
        } catch (error) {
            setMessage({
                type: 'error',
                text:
                    error instanceof Error
                        ? error.message
                        : `Failed to update ${fieldName}`,
            });
        } finally {
            setSaving(false);
        }
    };

    if (loading) {
        return (
            <AppLayout breadcrumbs={breadcrumbs}>
                <Head title="Environment Settings" />
                <div className="flex items-center justify-center py-12">
                    <Loader2 className="h-8 w-8 animate-spin text-muted-foreground" />
                </div>
            </AppLayout>
        );
    }

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Environment Settings" />

            <div className="space-y-6 p-6">
                {/* Status Card */}
                {envStatus && (
                    <Card>
                        <CardHeader>
                            <CardTitle>Environment Status</CardTitle>
                            <CardDescription>
                                Current state of your environment configuration
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-2 text-sm">
                                <div className="flex justify-between">
                                    <span className="text-muted-foreground">
                                        File Path:
                                    </span>
                                    <span className="font-mono">
                                        {envStatus.status.file_path}
                                    </span>
                                </div>
                                <div className="flex justify-between">
                                    <span className="text-muted-foreground">
                                        Writable:
                                    </span>
                                    <span
                                        className={
                                            envStatus.status.is_writable
                                                ? 'text-green-600'
                                                : 'text-red-600'
                                        }
                                    >
                                        {envStatus.status.is_writable
                                            ? '✓ Yes'
                                            : '✗ No'}
                                    </span>
                                </div>
                                <div className="flex justify-between">
                                    <span className="text-muted-foreground">
                                        Config Cached:
                                    </span>
                                    <span
                                        className={
                                            envStatus.status.config_cached
                                                ? 'text-orange-600'
                                                : 'text-green-600'
                                        }
                                    >
                                        {envStatus.status.config_cached
                                            ? '⚠ Yes (clear cache if changes not reflected)'
                                            : '✓ No'}
                                    </span>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                )}

                {/* Messages */}
                {message && (
                    <Alert
                        variant={
                            message.type === 'error' ? 'destructive' : 'default'
                        }
                    >
                        <AlertCircle className="h-4 w-4" />
                        <AlertDescription>{message.text}</AlertDescription>
                    </Alert>
                )}

                {/* Settings Form */}
                <Card>
                    <CardHeader>
                        <CardTitle>Edit Environment Variables</CardTitle>
                        <CardDescription>
                            Update your Paymob, Bosta, and Mail configuration
                            settings
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div className="space-y-6">
                            <div className="grid gap-6 md:grid-cols-2">
                                {/* Paymob Settings */}
                                <div className="space-y-6 md:col-span-2">
                                    <div className="border-b pb-4">
                                        <h3 className="font-semibold text-foreground">
                                            Paymob Settings
                                        </h3>
                                    </div>

                                    <div className="grid gap-4 md:grid-cols-2">
                                        <div className="space-y-2">
                                            <Label htmlFor="PAYMOB_BASE_URL">
                                                Paymob Base URL
                                            </Label>
                                            <div className="flex gap-2">
                                                <Input
                                                    id="PAYMOB_BASE_URL"
                                                    type="url"
                                                    placeholder="https://api.paymob.com"
                                                    value={
                                                        formData.PAYMOB_BASE_URL
                                                    }
                                                    onChange={(e) =>
                                                        handleInputChange(
                                                            e,
                                                            'PAYMOB_BASE_URL',
                                                        )
                                                    }
                                                    className="flex-1"
                                                />
                                                <Button
                                                    type="button"
                                                    onClick={(e) =>
                                                        handleFieldSave(
                                                            e,
                                                            'PAYMOB_BASE_URL',
                                                        )
                                                    }
                                                    disabled={saving}
                                                    size="sm"
                                                    variant="outline"
                                                >
                                                    {saving ? (
                                                        <Loader2 className="h-4 w-4 animate-spin" />
                                                    ) : (
                                                        'Save'
                                                    )}
                                                </Button>
                                            </div>
                                        </div>

                                        <div className="space-y-2">
                                            <Label htmlFor="PAYMOB_API_KEY">
                                                Paymob API Key
                                            </Label>
                                            <div className="flex gap-2">
                                                <div className="relative flex-1">
                                                    <Input
                                                        id="PAYMOB_API_KEY"
                                                        type={
                                                            visiblePasswords.PAYMOB_API_KEY
                                                                ? 'text'
                                                                : 'password'
                                                        }
                                                        placeholder="Your Paymob API Key"
                                                        value={
                                                            formData.PAYMOB_API_KEY
                                                        }
                                                        onChange={(e) =>
                                                            handleInputChange(
                                                                e,
                                                                'PAYMOB_API_KEY',
                                                            )
                                                        }
                                                        className="pe-10"
                                                    />
                                                    <button
                                                        type="button"
                                                        onClick={() =>
                                                            togglePasswordVisibility(
                                                                'PAYMOB_API_KEY',
                                                            )
                                                        }
                                                        className="absolute top-1/2 right-3 -translate-y-1/2 text-muted-foreground transition-colors hover:text-foreground"
                                                    >
                                                        {visiblePasswords.PAYMOB_API_KEY ? (
                                                            <EyeOff className="h-4 w-4" />
                                                        ) : (
                                                            <Eye className="h-4 w-4" />
                                                        )}
                                                    </button>
                                                </div>
                                                <Button
                                                    type="button"
                                                    onClick={(e) =>
                                                        handleFieldSave(
                                                            e,
                                                            'PAYMOB_API_KEY',
                                                        )
                                                    }
                                                    disabled={saving}
                                                    size="sm"
                                                    variant="outline"
                                                >
                                                    {saving ? (
                                                        <Loader2 className="h-4 w-4 animate-spin" />
                                                    ) : (
                                                        'Save'
                                                    )}
                                                </Button>
                                            </div>
                                        </div>

                                        <div className="space-y-2">
                                            <Label htmlFor="PAYMOB_INTEGRATION_ID">
                                                Paymob Integration ID
                                            </Label>
                                            <div className="flex gap-2">
                                                <Input
                                                    id="PAYMOB_INTEGRATION_ID"
                                                    type="number"
                                                    placeholder="Your Integration ID"
                                                    value={
                                                        formData.PAYMOB_INTEGRATION_ID
                                                    }
                                                    onChange={(e) =>
                                                        handleInputChange(
                                                            e,
                                                            'PAYMOB_INTEGRATION_ID',
                                                        )
                                                    }
                                                    className="flex-1"
                                                />
                                                <Button
                                                    type="button"
                                                    onClick={(e) =>
                                                        handleFieldSave(
                                                            e,
                                                            'PAYMOB_INTEGRATION_ID',
                                                        )
                                                    }
                                                    disabled={saving}
                                                    size="sm"
                                                    variant="outline"
                                                >
                                                    {saving ? (
                                                        <Loader2 className="h-4 w-4 animate-spin" />
                                                    ) : (
                                                        'Save'
                                                    )}
                                                </Button>
                                            </div>
                                        </div>

                                        <div className="space-y-2">
                                            <Label htmlFor="PAYMOB_IFRAME_ID">
                                                Paymob Iframe ID
                                            </Label>
                                            <div className="flex gap-2">
                                                <Input
                                                    id="PAYMOB_IFRAME_ID"
                                                    type="number"
                                                    placeholder="Your Iframe ID"
                                                    value={
                                                        formData.PAYMOB_IFRAME_ID
                                                    }
                                                    onChange={(e) =>
                                                        handleInputChange(
                                                            e,
                                                            'PAYMOB_IFRAME_ID',
                                                        )
                                                    }
                                                    className="flex-1"
                                                />
                                                <Button
                                                    type="button"
                                                    onClick={(e) =>
                                                        handleFieldSave(
                                                            e,
                                                            'PAYMOB_IFRAME_ID',
                                                        )
                                                    }
                                                    disabled={saving}
                                                    size="sm"
                                                    variant="outline"
                                                >
                                                    {saving ? (
                                                        <Loader2 className="h-4 w-4 animate-spin" />
                                                    ) : (
                                                        'Save'
                                                    )}
                                                </Button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div className="space-y-6 md:col-span-2">
                                    <div className="flex items-center justify-between border-b pb-4">
                                        <h3 className="font-semibold text-foreground">
                                            Bosta Settings
                                        </h3>
                                    </div>

                                    <div className="grid gap-4 md:grid-cols-2">
                                        <div className="space-y-2">
                                            <Label htmlFor="BOSTA_BASE_URL">
                                                Bosta Base URL
                                            </Label>
                                            <div className="flex gap-2">
                                                <Input
                                                    id="BOSTA_BASE_URL"
                                                    type="url"
                                                    placeholder="https://api.bosta.co"
                                                    value={
                                                        formData.BOSTA_BASE_URL
                                                    }
                                                    onChange={(e) =>
                                                        handleInputChange(
                                                            e,
                                                            'BOSTA_BASE_URL',
                                                        )
                                                    }
                                                    className="flex-1"
                                                />
                                                <Button
                                                    type="button"
                                                    onClick={(e) =>
                                                        handleFieldSave(
                                                            e,
                                                            'BOSTA_BASE_URL',
                                                        )
                                                    }
                                                    disabled={saving}
                                                    size="sm"
                                                    variant="outline"
                                                >
                                                    {saving ? (
                                                        <Loader2 className="h-4 w-4 animate-spin" />
                                                    ) : (
                                                        'Save'
                                                    )}
                                                </Button>
                                            </div>
                                        </div>

                                        <div className="space-y-2">
                                            <Label htmlFor="BOSTA_API_KEY">
                                                Bosta API Key
                                            </Label>
                                            <div className="flex gap-2">
                                                <div className="relative flex-1">
                                                    <Input
                                                        id="BOSTA_API_KEY"
                                                        type={
                                                            visiblePasswords.BOSTA_API_KEY
                                                                ? 'text'
                                                                : 'password'
                                                        }
                                                        placeholder="Your Bosta API Key"
                                                        value={
                                                            formData.BOSTA_API_KEY
                                                        }
                                                        onChange={(e) =>
                                                            handleInputChange(
                                                                e,
                                                                'BOSTA_API_KEY',
                                                            )
                                                        }
                                                        className="pe-10"
                                                    />
                                                    <button
                                                        type="button"
                                                        onClick={() =>
                                                            togglePasswordVisibility(
                                                                'BOSTA_API_KEY',
                                                            )
                                                        }
                                                        className="absolute top-1/2 right-3 -translate-y-1/2 text-muted-foreground transition-colors hover:text-foreground"
                                                    >
                                                        {visiblePasswords.BOSTA_API_KEY ? (
                                                            <EyeOff className="h-4 w-4" />
                                                        ) : (
                                                            <Eye className="h-4 w-4" />
                                                        )}
                                                    </button>
                                                </div>
                                                <Button
                                                    type="button"
                                                    onClick={(e) =>
                                                        handleFieldSave(
                                                            e,
                                                            'BOSTA_API_KEY',
                                                        )
                                                    }
                                                    disabled={saving}
                                                    size="sm"
                                                    variant="outline"
                                                >
                                                    {saving ? (
                                                        <Loader2 className="h-4 w-4 animate-spin" />
                                                    ) : (
                                                        'Save'
                                                    )}
                                                </Button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {/* Mail Settings */}
                                <div className="space-y-6 md:col-span-2">
                                    <div className="border-b pb-4">
                                        <h3 className="font-semibold text-foreground">
                                            Mail Configuration
                                        </h3>
                                    </div>

                                    <div className="grid gap-4 md:grid-cols-2">
                                        <div className="space-y-2">
                                            <Label htmlFor="MAIL_MAILER">
                                                Mail Mailer
                                            </Label>
                                            <div className="flex gap-2">
                                                <Input
                                                    id="MAIL_MAILER"
                                                    type="text"
                                                    placeholder="smtp"
                                                    value={formData.MAIL_MAILER}
                                                    onChange={(e) =>
                                                        handleInputChange(
                                                            e,
                                                            'MAIL_MAILER',
                                                        )
                                                    }
                                                    className="flex-1"
                                                />
                                                <Button
                                                    type="button"
                                                    onClick={(e) =>
                                                        handleFieldSave(
                                                            e,
                                                            'MAIL_MAILER',
                                                        )
                                                    }
                                                    disabled={saving}
                                                    size="sm"
                                                    variant="outline"
                                                >
                                                    {saving ? (
                                                        <Loader2 className="h-4 w-4 animate-spin" />
                                                    ) : (
                                                        'Save'
                                                    )}
                                                </Button>
                                            </div>
                                        </div>

                                        <div className="space-y-2">
                                            <Label htmlFor="MAIL_SCHEME">
                                                Mail Scheme
                                            </Label>
                                            <div className="flex gap-2">
                                                <Input
                                                    id="MAIL_SCHEME"
                                                    type="text"
                                                    placeholder="tls or ssl"
                                                    value={formData.MAIL_SCHEME}
                                                    onChange={(e) =>
                                                        handleInputChange(
                                                            e,
                                                            'MAIL_SCHEME',
                                                        )
                                                    }
                                                    className="flex-1"
                                                />
                                                <Button
                                                    type="button"
                                                    onClick={(e) =>
                                                        handleFieldSave(
                                                            e,
                                                            'MAIL_SCHEME',
                                                        )
                                                    }
                                                    disabled={saving}
                                                    size="sm"
                                                    variant="outline"
                                                >
                                                    {saving ? (
                                                        <Loader2 className="h-4 w-4 animate-spin" />
                                                    ) : (
                                                        'Save'
                                                    )}
                                                </Button>
                                            </div>
                                        </div>

                                        <div className="space-y-2">
                                            <Label htmlFor="MAIL_HOST">
                                                Mail Host
                                            </Label>
                                            <div className="flex gap-2">
                                                <Input
                                                    id="MAIL_HOST"
                                                    type="text"
                                                    placeholder="smtp.gmail.com"
                                                    value={formData.MAIL_HOST}
                                                    onChange={(e) =>
                                                        handleInputChange(
                                                            e,
                                                            'MAIL_HOST',
                                                        )
                                                    }
                                                    className="flex-1"
                                                />
                                                <Button
                                                    type="button"
                                                    onClick={(e) =>
                                                        handleFieldSave(
                                                            e,
                                                            'MAIL_HOST',
                                                        )
                                                    }
                                                    disabled={saving}
                                                    size="sm"
                                                    variant="outline"
                                                >
                                                    {saving ? (
                                                        <Loader2 className="h-4 w-4 animate-spin" />
                                                    ) : (
                                                        'Save'
                                                    )}
                                                </Button>
                                            </div>
                                        </div>

                                        <div className="space-y-2">
                                            <Label htmlFor="MAIL_PORT">
                                                Mail Port
                                            </Label>
                                            <div className="flex gap-2">
                                                <Input
                                                    id="MAIL_PORT"
                                                    type="number"
                                                    placeholder="465"
                                                    value={formData.MAIL_PORT}
                                                    onChange={(e) =>
                                                        handleInputChange(
                                                            e,
                                                            'MAIL_PORT',
                                                        )
                                                    }
                                                    className="flex-1"
                                                />
                                                <Button
                                                    type="button"
                                                    onClick={(e) =>
                                                        handleFieldSave(
                                                            e,
                                                            'MAIL_PORT',
                                                        )
                                                    }
                                                    disabled={saving}
                                                    size="sm"
                                                    variant="outline"
                                                >
                                                    {saving ? (
                                                        <Loader2 className="h-4 w-4 animate-spin" />
                                                    ) : (
                                                        'Save'
                                                    )}
                                                </Button>
                                            </div>
                                        </div>

                                        <div className="space-y-2">
                                            <Label htmlFor="MAIL_USERNAME">
                                                Mail Username
                                            </Label>
                                            <div className="flex gap-2">
                                                <Input
                                                    id="MAIL_USERNAME"
                                                    type="email"
                                                    placeholder="your-email@gmail.com"
                                                    value={
                                                        formData.MAIL_USERNAME
                                                    }
                                                    onChange={(e) =>
                                                        handleInputChange(
                                                            e,
                                                            'MAIL_USERNAME',
                                                        )
                                                    }
                                                    className="flex-1"
                                                />
                                                <Button
                                                    type="button"
                                                    onClick={(e) =>
                                                        handleFieldSave(
                                                            e,
                                                            'MAIL_USERNAME',
                                                        )
                                                    }
                                                    disabled={saving}
                                                    size="sm"
                                                    variant="outline"
                                                >
                                                    {saving ? (
                                                        <Loader2 className="h-4 w-4 animate-spin" />
                                                    ) : (
                                                        'Save'
                                                    )}
                                                </Button>
                                            </div>
                                        </div>

                                        <div className="space-y-2">
                                            <Label htmlFor="MAIL_PASSWORD">
                                                Mail Password
                                            </Label>
                                            <div className="flex gap-2">
                                                <div className="relative flex-1">
                                                    <Input
                                                        id="MAIL_PASSWORD"
                                                        type={
                                                            visiblePasswords.MAIL_PASSWORD
                                                                ? 'text'
                                                                : 'password'
                                                        }
                                                        placeholder="Your app password"
                                                        value={
                                                            formData.MAIL_PASSWORD
                                                        }
                                                        onChange={(e) =>
                                                            handleInputChange(
                                                                e,
                                                                'MAIL_PASSWORD',
                                                            )
                                                        }
                                                        className="pe-10"
                                                    />
                                                    <button
                                                        type="button"
                                                        onClick={() =>
                                                            togglePasswordVisibility(
                                                                'MAIL_PASSWORD',
                                                            )
                                                        }
                                                        className="absolute top-1/2 right-3 -translate-y-1/2 text-muted-foreground transition-colors hover:text-foreground"
                                                    >
                                                        {visiblePasswords.MAIL_PASSWORD ? (
                                                            <EyeOff className="h-4 w-4" />
                                                        ) : (
                                                            <Eye className="h-4 w-4" />
                                                        )}
                                                    </button>
                                                </div>
                                                <Button
                                                    type="button"
                                                    onClick={(e) =>
                                                        handleFieldSave(
                                                            e,
                                                            'MAIL_PASSWORD',
                                                        )
                                                    }
                                                    disabled={saving}
                                                    size="sm"
                                                    variant="outline"
                                                >
                                                    {saving ? (
                                                        <Loader2 className="h-4 w-4 animate-spin" />
                                                    ) : (
                                                        'Save'
                                                    )}
                                                </Button>
                                            </div>
                                        </div>

                                        <div className="space-y-2">
                                            <Label htmlFor="MAIL_FROM_ADDRESS">
                                                Mail From Address
                                            </Label>
                                            <div className="flex gap-2">
                                                <Input
                                                    id="MAIL_FROM_ADDRESS"
                                                    type="email"
                                                    placeholder="noreply@example.com"
                                                    value={
                                                        formData.MAIL_FROM_ADDRESS
                                                    }
                                                    onChange={(e) =>
                                                        handleInputChange(
                                                            e,
                                                            'MAIL_FROM_ADDRESS',
                                                        )
                                                    }
                                                    className="flex-1"
                                                />
                                                <Button
                                                    type="button"
                                                    onClick={(e) =>
                                                        handleFieldSave(
                                                            e,
                                                            'MAIL_FROM_ADDRESS',
                                                        )
                                                    }
                                                    disabled={saving}
                                                    size="sm"
                                                    variant="outline"
                                                >
                                                    {saving ? (
                                                        <Loader2 className="h-4 w-4 animate-spin" />
                                                    ) : (
                                                        'Save'
                                                    )}
                                                </Button>
                                            </div>
                                        </div>

                                        <div className="space-y-2">
                                            <Label htmlFor="MAIL_FROM_NAME">
                                                Mail From Name
                                            </Label>
                                            <div className="flex gap-2">
                                                <Input
                                                    id="MAIL_FROM_NAME"
                                                    type="text"
                                                    placeholder="Your App Name"
                                                    value={
                                                        formData.MAIL_FROM_NAME
                                                    }
                                                    onChange={(e) =>
                                                        handleInputChange(
                                                            e,
                                                            'MAIL_FROM_NAME',
                                                        )
                                                    }
                                                    className="flex-1"
                                                />
                                                <Button
                                                    type="button"
                                                    onClick={(e) =>
                                                        handleFieldSave(
                                                            e,
                                                            'MAIL_FROM_NAME',
                                                        )
                                                    }
                                                    disabled={saving}
                                                    size="sm"
                                                    variant="outline"
                                                >
                                                    {saving ? (
                                                        <Loader2 className="h-4 w-4 animate-spin" />
                                                    ) : (
                                                        'Save'
                                                    )}
                                                </Button>
                                            </div>
                                        </div>

                                        <div className="grid grid-cols-1 gap-4">
                                            <div className="grid grid-cols-12 gap-4">
                                                <div className="col-span-12">
                                                    <Label htmlFor="FRONTEND_URL">
                                                        Frontend URL
                                                    </Label>
                                                    <div className="flex gap-2">
                                                        <Input
                                                            id="FRONTEND_URL"
                                                            type="text"
                                                            value={
                                                                formData.FRONTEND_URL
                                                            }
                                                            onChange={(e) =>
                                                                handleInputChange(
                                                                    e,
                                                                    'FRONTEND_URL',
                                                                )
                                                            }
                                                            disabled={saving}
                                                        />
                                                        <Button
                                                            onClick={(e) => {
                                                                handleFieldSave(
                                                                    e,
                                                                    'FRONTEND_URL',
                                                                );
                                                            }}
                                                        >
                                                            Save
                                                        </Button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </CardContent>
                </Card>

                {/* Info Alert */}
                <Alert>
                    <AlertCircle className="h-4 w-4" />
                    <AlertDescription>
                        Changes to environment variables are automatically
                        reflected in your application. If changes don't take
                        effect immediately, try clearing your cache with{' '}
                        <code className="font-mono text-xs">
                            php artisan config:clear
                        </code>
                        .
                    </AlertDescription>
                </Alert>
            </div>
        </AppLayout>
    );
}
