import { useForm } from '@inertiajs/react';
import Layout from '../Layout';

export default function Create() {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        name_ar: '',
        description: '',
        description_ar: '',
        sort_order: '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('categories.store'));
    };

    return (
        <Layout>
            <h1 className="text-2xl font-medium text-gray-900">Create Category</h1>

            <div className="mt-8 bg-white overflow-hidden shadow rounded-lg">
                <form onSubmit={handleSubmit} className="p-6">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label htmlFor="name" className="block text-sm font-medium text-gray-700">
                                Name
                            </label>
                            <input
                                type="text"
                                id="name"
                                value={data.name}
                                onChange={(e) => setData('name', e.target.value)}
                                className="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            />
                            {errors.name && <p className="mt-2 text-sm text-red-600">{errors.name}</p>}
                        </div>

                        <div>
                            <label htmlFor="name_ar" className="block text-sm font-medium text-gray-700">
                                Name (Arabic)
                            </label>
                            <input
                                type="text"
                                id="name_ar"
                                value={data.name_ar}
                                onChange={(e) => setData('name_ar', e.target.value)}
                                className="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            />
                            {errors.name_ar && <p className="mt-2 text-sm text-red-600">{errors.name_ar}</p>}
                        </div>

                        <div className="md:col-span-2">
                            <label htmlFor="description" className="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <textarea
                                id="description"
                                rows={3}
                                value={data.description}
                                onChange={(e) => setData('description', e.target.value)}
                                className="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            />
                            {errors.description && <p className="mt-2 text-sm text-red-600">{errors.description}</p>}
                        </div>

                        <div className="md:col-span-2">
                            <label htmlFor="description_ar" className="block text-sm font-medium text-gray-700">
                                Description (Arabic)
                            </label>
                            <textarea
                                id="description_ar"
                                rows={3}
                                value={data.description_ar}
                                onChange={(e) => setData('description_ar', e.target.value)}
                                className="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            />
                            {errors.description_ar && <p className="mt-2 text-sm text-red-600">{errors.description_ar}</p>}
                        </div>



                        <div>
                            <label htmlFor="sort_order" className="block text-sm font-medium text-gray-700">
                                Sort Order
                            </label>
                            <input
                                type="number"
                                id="sort_order"
                                value={data.sort_order}
                                onChange={(e) => setData('sort_order', e.target.value)}
                                className="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            />
                            {errors.sort_order && <p className="mt-2 text-sm text-red-600">{errors.sort_order}</p>}
                        </div>
                    </div>

                    <div className="mt-6 flex justify-end">
                        <button
                            type="submit"
                            disabled={processing}
                            className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded disabled:opacity-50"
                        >
                            {processing ? 'Creating...' : 'Create Category'}
                        </button>
                    </div>
                </form>
            </div>
        </Layout>
    );
}