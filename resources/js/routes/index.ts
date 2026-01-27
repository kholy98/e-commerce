import {
    queryParams,
    type RouteDefinition,
    type RouteQueryOptions,
} from './../wayfinder';
/**
 * @see \Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::logout
 * @see vendor/laravel/fortify/src/Http/Controllers/AuthenticatedSessionController.php:100
 * @route '/logout'
 */
export const logout = (
    options?: RouteQueryOptions,
): RouteDefinition<'post'> => ({
    url: logout.url(options),
    method: 'post',
});

logout.definition = {
    methods: ['post'],
    url: '/logout',
} satisfies RouteDefinition<['post']>;

/**
 * @see \Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::logout
 * @see vendor/laravel/fortify/src/Http/Controllers/AuthenticatedSessionController.php:100
 * @route '/logout'
 */
logout.url = (options?: RouteQueryOptions) => {
    return logout.definition.url + queryParams(options);
};

/**
 * @see \Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::logout
 * @see vendor/laravel/fortify/src/Http/Controllers/AuthenticatedSessionController.php:100
 * @route '/logout'
 */
logout.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: logout.url(options),
    method: 'post',
});

/**
 * @see routes/web.php:7
 * @route '/'
 */
export const home = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: home.url(options),
    method: 'get',
});

home.definition = {
    methods: ['get', 'head'],
    url: '/',
} satisfies RouteDefinition<['get', 'head']>;

/**
 * @see routes/web.php:7
 * @route '/'
 */
home.url = (options?: RouteQueryOptions) => {
    return home.definition.url + queryParams(options);
};

/**
 * @see routes/web.php:7
 * @route '/'
 */
home.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: home.url(options),
    method: 'get',
});
/**
 * @see routes/web.php:7
 * @route '/'
 */
home.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: home.url(options),
    method: 'head',
});

/**
 * @see routes/web.php:14
 * @route '/dashboard'
 */
export const dashboard = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: dashboard.url(options),
    method: 'get',
});

dashboard.definition = {
    methods: ['get', 'head'],
    url: '/dashboard',
} satisfies RouteDefinition<['get', 'head']>;

/**
 * @see routes/web.php:14
 * @route '/dashboard'
 */
dashboard.url = (options?: RouteQueryOptions) => {
    return dashboard.definition.url + queryParams(options);
};

/**
 * @see routes/web.php:14
 * @route '/dashboard'
 */
dashboard.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: dashboard.url(options),
    method: 'get',
});
/**
 * @see routes/web.php:14
 * @route '/dashboard'
 */
dashboard.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: dashboard.url(options),
    method: 'head',
});

/**
 * Fortify login route
 * @route '/login'
 */
export const login = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: login.url(options),
    method: 'get',
});

login.definition = {
    methods: ['get', 'head'],
    url: '/login',
} satisfies RouteDefinition<['get', 'head']>;

login.url = (options?: RouteQueryOptions) => {
    return login.definition.url + queryParams(options);
};

login.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: login.url(options),
    method: 'get',
});

login.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: login.url(options),
    method: 'head',
});

/**
 * Fortify register route
 * @route '/register'
 */
export const register = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: register.url(options),
    method: 'get',
});

register.definition = {
    methods: ['get', 'head'],
    url: '/register',
} satisfies RouteDefinition<['get', 'head']>;

register.url = (options?: RouteQueryOptions) => {
    return register.definition.url + queryParams(options);
};

register.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: register.url(options),
    method: 'get',
});

register.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: register.url(options),
    method: 'head',
});

/**
 * Dashboard stats API route
 * @route '/api/admin/dashboard/stats'
 */
export const dashboardStats = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: dashboardStats.url(options),
    method: 'get',
});

dashboardStats.definition = {
    methods: ['get'],
    url: '/api/admin/dashboard/stats',
} satisfies RouteDefinition<['get']>;

dashboardStats.url = (options?: RouteQueryOptions) => {
    return dashboardStats.definition.url + queryParams(options);
};

dashboardStats.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: dashboardStats.url(options),
    method: 'get',
});

/**
 * Dashboard products API route
 * @route '/api/admin/dashboard/products'
 */
export const dashboardProducts = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: dashboardProducts.url(options),
    method: 'get',
});

dashboardProducts.definition = {
    methods: ['get'],
    url: '/api/admin/dashboard/products',
} satisfies RouteDefinition<['get']>;

dashboardProducts.url = (options?: RouteQueryOptions) => {
    return dashboardProducts.definition.url + queryParams(options);
};

dashboardProducts.get = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: dashboardProducts.url(options),
    method: 'get',
});

/**
 * Dashboard categories API route
 * @route '/api/admin/dashboard/categories'
 */
export const dashboardCategories = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: dashboardCategories.url(options),
    method: 'get',
});

dashboardCategories.definition = {
    methods: ['get'],
    url: '/api/admin/dashboard/categories',
} satisfies RouteDefinition<['get']>;

dashboardCategories.url = (options?: RouteQueryOptions) => {
    return dashboardCategories.definition.url + queryParams(options);
};

dashboardCategories.get = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: dashboardCategories.url(options),
    method: 'get',
});

/**
 * Dashboard revenue API route
 * @route '/api/admin/dashboard/revenue'
 */
export const dashboardRevenue = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: dashboardRevenue.url(options),
    method: 'get',
});

dashboardRevenue.definition = {
    methods: ['get'],
    url: '/api/admin/dashboard/revenue',
} satisfies RouteDefinition<['get']>;

dashboardRevenue.url = (options?: RouteQueryOptions) => {
    return dashboardRevenue.definition.url + queryParams(options);
};

dashboardRevenue.get = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: dashboardRevenue.url(options),
    method: 'get',
});

/**
 * Dashboard best sellers API route
 * @route '/api/admin/dashboard/best-sellers'
 */
export const dashboardBestSellers = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: dashboardBestSellers.url(options),
    method: 'get',
});

dashboardBestSellers.definition = {
    methods: ['get'],
    url: '/api/admin/dashboard/best-sellers',
} satisfies RouteDefinition<['get']>;

dashboardBestSellers.url = (options?: RouteQueryOptions) => {
    return dashboardBestSellers.definition.url + queryParams(options);
};

dashboardBestSellers.get = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: dashboardBestSellers.url(options),
    method: 'get',
});

/**
 * Admin products index route
 * @route '/admin/products'
 */
export const adminProducts = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: '/admin/products' + queryParams(options),
    method: 'get',
});

/**
 * Admin products create route
 * @route '/admin/products/create'
 */
export const adminProductsCreate = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: '/admin/products/create' + queryParams(options),
    method: 'get',
});

/**
 * Admin products edit route
 * @route '/admin/products/{product}/edit'
 */
export const adminProductsEdit = (
    product: string | number,
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: `/admin/products/${product}/edit` + queryParams(options),
    method: 'get',
});

/**
 * Admin products show route
 * @route '/admin/products/{product}'
 */
export const adminProductsShow = (
    product: string | number,
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: `/admin/products/${product}` + queryParams(options),
    method: 'get',
});

/**
 * Admin categories index route
 * @route '/admin/categories'
 */
export const adminCategories = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: '/admin/categories' + queryParams(options),
    method: 'get',
});

/**
 * Admin categories create route
 * @route '/admin/categories/create'
 */
export const adminCategoriesCreate = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: '/admin/categories/create' + queryParams(options),
    method: 'get',
});

/**
 * Admin categories edit route
 * @route '/admin/categories/{category}/edit'
 */
export const adminCategoriesEdit = (
    category: string | number,
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: `/admin/categories/${category}/edit` + queryParams(options),
    method: 'get',
});

/**
 * Admin categories show route
 * @route '/admin/categories/{category}'
 */
export const adminCategoriesShow = (
    category: string | number,
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: `/admin/categories/${category}` + queryParams(options),
    method: 'get',
});

/**
 * Admin categories API route
 * @route '/api/admin/categories'
 */
export const adminCategoriesApi = (
    options?: RouteQueryOptions,
): RouteDefinition<'get' | 'post'> => ({
    url: '/api/admin/categories' + queryParams(options),
    method: 'get',
});

/**
 * Admin categories API route with ID
 * @route '/api/admin/categories/{category}'
 */
export const adminCategoriesApiId = (
    category: string | number,
    options?: RouteQueryOptions,
): RouteDefinition<'get' | 'put' | 'delete'> => ({
    url: adminCategoriesApiId.url(category, options),
    method: 'get',
});

adminCategoriesApiId.url = (
    category: string | number,
    options?: RouteQueryOptions,
) => `/api/admin/categories/${category}` + queryParams(options);

adminCategoriesApiId.put = (
    category: string | number,
    options?: RouteQueryOptions,
): RouteDefinition<'put'> => ({
    url: adminCategoriesApiId.url(category, options),
    method: 'put',
});

adminCategoriesApiId.delete = (
    category: string | number,
    options?: RouteQueryOptions,
): RouteDefinition<'delete'> => ({
    url: adminCategoriesApiId.url(category, options),
    method: 'delete',
});

/**
 * Admin products API route
 * @route '/api/admin/products'
 */
export const adminProductsApi = (
    options?: RouteQueryOptions,
): RouteDefinition<'get' | 'post'> => ({
    url: '/api/admin/products' + queryParams(options),
    method: 'get',
});

/**
 * Admin products API route with ID
 * @route '/api/admin/products/{product}'
 */
export const adminProductsApiId = (
    product: string | number,
    options?: RouteQueryOptions,
): RouteDefinition<'get' | 'put' | 'delete'> => ({
    url: adminProductsApiId.url(product, options),
    method: 'get',
});

adminProductsApiId.url = (
    product: string | number,
    options?: RouteQueryOptions,
) => `/api/admin/products/${product}` + queryParams(options);

adminProductsApiId.put = (
    product: string | number,
    options?: RouteQueryOptions,
): RouteDefinition<'put'> => ({
    url: adminProductsApiId.url(product, options),
    method: 'put',
});

adminProductsApiId.delete = (
    product: string | number,
    options?: RouteQueryOptions,
): RouteDefinition<'delete'> => ({
    url: adminProductsApiId.url(product, options),
    method: 'delete',
});

/**
 * Admin team members index route
 * @route '/admin/team-members'
 */
export const adminTeamMembers = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: '/admin/team-members' + queryParams(options),
    method: 'get',
});

/**
 * Admin team members create route
 * @route '/admin/team-members/create'
 */
export const adminTeamMembersCreate = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: '/admin/team-members/create' + queryParams(options),
    method: 'get',
});

/**
 * Admin team members edit route
 * @route '/admin/team-members/{teamMember}/edit'
 */
export const adminTeamMembersEdit = (
    teamMember: string | number,
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: `/admin/team-members/${teamMember}/edit` + queryParams(options),
    method: 'get',
});

/**
 * Admin team members show route
 * @route '/admin/team-members/{teamMember}'
 */
export const adminTeamMembersShow = (
    teamMember: string | number,
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: `/admin/team-members/${teamMember}` + queryParams(options),
    method: 'get',
});

/**
 * Admin inquiries index route
 * @route '/admin/inquiries'
 */
export const adminInquiries = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: '/admin/inquiries' + queryParams(options),
    method: 'get',
});

/**
 * Admin inquiries show route
 * @route '/admin/inquiries/{inquiry}'
 */
export const adminInquiriesShow = (
    inquiry: string | number,
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: `/admin/inquiries/${inquiry}` + queryParams(options),
    method: 'get',
});

/**
 * Admin contact us edit route
 * @route '/admin/contact-us'
 */
export const adminContactUs = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: '/admin/contact-us' + queryParams(options),
    method: 'get',
});

/**
 * Admin settings environment route
 * @route '/admin/settings/environment'
 */
export const adminSettingsEnvironment = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: '/admin/settings/environment' + queryParams(options),
    method: 'get',
});

/**
 * Admin orders index route
 * @route '/admin/orders'
 */
export const adminOrders = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: '/admin/orders' + queryParams(options),
    method: 'get',
});

/**
 * Admin orders show route
 * @route '/admin/orders/{order}'
 */
export const adminOrdersShow = (
    order: string | number,
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: `/admin/orders/${order}` + queryParams(options),
    method: 'get',
});

/**
 * Admin users index route
 * @route '/admin/users'
 */
export const adminUsers = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: '/admin/users' + queryParams(options),
    method: 'get',
});

/**
 * Admin users show route
 * @route '/admin/users/{user}'
 */
export const adminUsersShow = (
    user: string | number,
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: `/admin/users/${user}` + queryParams(options),
    method: 'get',
});

// export { default as admin } from './admin';
