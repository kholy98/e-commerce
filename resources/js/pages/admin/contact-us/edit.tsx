import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Plus, Trash2 } from 'lucide-react';
import { useEffect, useState } from 'react';

interface ContactUsData {
    phones: string[];
    emails: string[];
    addresses_en: string[];
    addresses_ar: string[];
    working_hours_en: string[];
    working_hours_ar: string[];
}

export default function Edit() {
    const [data, setData] = useState<ContactUsData>({
        phones: [],
        emails: [],
        addresses_en: [],
        addresses_ar: [],
        working_hours_en: [],
        working_hours_ar: [],
    });
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        fetch('/admin/api/contact-us', {
            headers: {
                Accept: 'application/json',
            },
        })
            .then((res) => res.json())
            .then((response) => {
                if (response.success) {
                    setData(response.data);
                }
            });
    }, []);

    const updateData = (field: keyof ContactUsData, value: string[]) => {
        setData((prev) => ({ ...prev, [field]: value }));
    };

    const addItem = (field: keyof ContactUsData) => {
        updateData(field, [...data[field], '']);
    };

    const updateItem = (
        field: keyof ContactUsData,
        index: number,
        value: string,
    ) => {
        const newArray = [...data[field]];
        newArray[index] = value;
        updateData(field, newArray);
    };

    const removeItem = (field: keyof ContactUsData, index: number) => {
        updateData(
            field,
            data[field].filter((_, i) => i !== index),
        );
    };

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        setLoading(true);

        try {
            const response = await fetch('/admin/api/contact-us', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-CSRF-TOKEN':
                        document
                            .querySelector('meta[name="csrf-token"]')
                            ?.getAttribute('content') || '',
                },
                body: JSON.stringify(data),
            });

            const result = await response.json();
            if (result.success) {
                alert('Contact us updated successfully');
            } else {
                alert('Error updating contact us');
            }
        } catch (error) {
            alert('Error updating contact us');
        } finally {
            setLoading(false);
        }
    };

    const renderField = (field: keyof ContactUsData, label: string) => (
        <div className="space-y-2">
            <Label>{label}</Label>
            {data[field].map((item, index) => (
                <div key={index} className="flex gap-2">
                    <Input
                        value={item}
                        onChange={(e) =>
                            updateItem(field, index, e.target.value)
                        }
                        placeholder={`Enter ${label.toLowerCase()}`}
                    />
                    <Button
                        type="button"
                        variant="outline"
                        size="sm"
                        onClick={() => removeItem(field, index)}
                    >
                        <Trash2 className="h-4 w-4" />
                    </Button>
                </div>
            ))}
            <Button
                type="button"
                variant="outline"
                size="sm"
                onClick={() => addItem(field)}
            >
                <Plus className="mr-2 h-4 w-4" />
                Add {label.toLowerCase()}
            </Button>
        </div>
    );

    return (
        <div className="container mx-auto p-6">
            <Card>
                <CardHeader>
                    <CardTitle>Edit Contact Us</CardTitle>
                </CardHeader>
                <CardContent>
                    <form onSubmit={handleSubmit} className="space-y-6">
                        <div className="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Common Information</CardTitle>
                                </CardHeader>
                                <CardContent className="space-y-4">
                                    {renderField('phones', 'Phones')}
                                    {renderField('emails', 'Emails')}
                                </CardContent>
                            </Card>

                            <Card>
                                <CardHeader>
                                    <CardTitle>Addresses (English)</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    {renderField('addresses_en', 'Addresses')}
                                </CardContent>
                            </Card>

                            <Card>
                                <CardHeader>
                                    <CardTitle>Addresses (Arabic)</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    {renderField('addresses_ar', 'Addresses')}
                                </CardContent>
                            </Card>

                            <Card>
                                <CardHeader>
                                    <CardTitle>
                                        Working Hours (English)
                                    </CardTitle>
                                </CardHeader>
                                <CardContent>
                                    {renderField(
                                        'working_hours_en',
                                        'Working Hours',
                                    )}
                                </CardContent>
                            </Card>

                            <Card>
                                <CardHeader>
                                    <CardTitle>
                                        Working Hours (Arabic)
                                    </CardTitle>
                                </CardHeader>
                                <CardContent>
                                    {renderField(
                                        'working_hours_ar',
                                        'Working Hours',
                                    )}
                                </CardContent>
                            </Card>
                        </div>

                        <Button type="submit" disabled={loading}>
                            {loading ? 'Saving...' : 'Save Changes'}
                        </Button>
                    </form>
                </CardContent>
            </Card>
        </div>
    );
}
