import {
    queryParams,
    type RouteDefinition,
    type RouteQueryOptions,
} from './../../wayfinder';
import confirm from './confirm';
/**
 * @see \Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController::confirmation
 * @see vendor/laravel/fortify/src/Http/Controllers/ConfirmedPasswordStatusController.php:17
 * @route '/user/confirmed-password-status'
 */
export const confirmation = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: confirmation.url(options),
    method: 'get',
});

confirmation.definition = {
    methods: ['get', 'head'],
    url: '/user/confirmed-password-status',
} satisfies RouteDefinition<['get', 'head']>;

/**
 * @see \Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController::confirmation
 * @see vendor/laravel/fortify/src/Http/Controllers/ConfirmedPasswordStatusController.php:17
 * @route '/user/confirmed-password-status'
 */
confirmation.url = (options?: RouteQueryOptions) => {
    return confirmation.definition.url + queryParams(options);
};

/**
 * @see \Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController::confirmation
 * @see vendor/laravel/fortify/src/Http/Controllers/ConfirmedPasswordStatusController.php:17
 * @route '/user/confirmed-password-status'
 */
confirmation.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: confirmation.url(options),
    method: 'get',
});
/**
 * @see \Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController::confirmation
 * @see vendor/laravel/fortify/src/Http/Controllers/ConfirmedPasswordStatusController.php:17
 * @route '/user/confirmed-password-status'
 */
confirmation.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: confirmation.url(options),
    method: 'head',
});

/**
 * @see \Laravel\Fortify\Http\Controllers\PasswordResetLinkController::create
 * @see vendor/laravel/fortify/src/Http/Controllers/PasswordResetLinkController.php:29
 * @route '/forgot-password'
 */
export const request = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: request.url(options),
    method: 'get',
});

request.definition = {
    methods: ['get', 'head'],
    url: '/forgot-password',
} satisfies RouteDefinition<['get', 'head']>;

/**
 * @see \Laravel\Fortify\Http\Controllers\PasswordResetLinkController::create
 * @see vendor/laravel/fortify/src/Http/Controllers/PasswordResetLinkController.php:29
 * @route '/forgot-password'
 */
request.url = (options?: RouteQueryOptions) => {
    return request.definition.url + queryParams(options);
};

/**
 * @see \Laravel\Fortify\Http\Controllers\PasswordResetLinkController::create
 * @see vendor/laravel/fortify/src/Http/Controllers/PasswordResetLinkController.php:29
 * @route '/forgot-password'
 */
request.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: request.url(options),
    method: 'get',
});
/**
 * @see \Laravel\Fortify\Http\Controllers\PasswordResetLinkController::create
 * @see vendor/laravel/fortify/src/Http/Controllers/PasswordResetLinkController.php:29
 * @route '/forgot-password'
 */
request.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: request.url(options),
    method: 'head',
});

/**
 * @see \Laravel\Fortify\Http\Controllers\PasswordResetLinkController::store
 * @see vendor/laravel/fortify/src/Http/Controllers/PasswordResetLinkController.php:49
 * @route '/forgot-password'
 */
export const email = (
    options?: RouteQueryOptions,
): RouteDefinition<'post'> => ({
    url: email.url(options),
    method: 'post',
});

email.definition = {
    methods: ['post'],
    url: '/forgot-password',
} satisfies RouteDefinition<['post']>;

/**
 * @see \Laravel\Fortify\Http\Controllers\PasswordResetLinkController::store
 * @see vendor/laravel/fortify/src/Http/Controllers/PasswordResetLinkController.php:49
 * @route '/forgot-password'
 */
email.url = (options?: RouteQueryOptions) => {
    return email.definition.url + queryParams(options);
};

/**
 * @see \Laravel\Fortify\Http\Controllers\PasswordResetLinkController::store
 * @see vendor/laravel/fortify/src/Http/Controllers/PasswordResetLinkController.php:49
 * @route '/forgot-password'
 */
email.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: email.url(options),
    method: 'post',
});

email.form = (options?: RouteQueryOptions) => ({
    action: email.url(options),
    method: 'post',
});

/**
 * @see \Laravel\Fortify\Http\Controllers\NewPasswordController::store
 * @see vendor/laravel/fortify/src/Http/Controllers/NewPasswordController.php:29
 * @route '/reset-password'
 */
export const update = (
    options?: RouteQueryOptions,
): RouteDefinition<'post'> => ({
    url: update.url(options),
    method: 'post',
});

update.definition = {
    methods: ['post'],
    url: '/reset-password',
} satisfies RouteDefinition<['post']>;

/**
 * @see \Laravel\Fortify\Http\Controllers\NewPasswordController::store
 * @see vendor/laravel/fortify/src/Http/Controllers/NewPasswordController.php:29
 * @route '/reset-password'
 */
update.url = (options?: RouteQueryOptions) => {
    return update.definition.url + queryParams(options);
};

/**
 * @see \Laravel\Fortify\Http\Controllers\NewPasswordController::store
 * @see vendor/laravel/fortify/src/Http/Controllers/NewPasswordController.php:29
 * @route '/reset-password'
 */
update.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: update.url(options),
    method: 'post',
});

update.form = (options?: RouteQueryOptions) => ({
    action: update.url(options),
    method: 'post',
});

const password = {
    confirmation: Object.assign(confirmation, confirmation),
    confirm: Object.assign(confirm, confirm),
    request: Object.assign(request, request),
    email: Object.assign(email, email),
    update: Object.assign(update, update),
};

export default password;
