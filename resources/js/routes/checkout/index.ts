import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../wayfinder'
/**
* @see \App\Http\Controllers\CheckoutController::complete
 * @see app/Http/Controllers/CheckoutController.php:222
 * @route '/api/checkout/complete'
 */
export const complete = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: complete.url(options),
    method: 'get',
})

complete.definition = {
    methods: ["get","post","head"],
    url: '/api/checkout/complete',
} satisfies RouteDefinition<["get","post","head"]>

/**
* @see \App\Http\Controllers\CheckoutController::complete
 * @see app/Http/Controllers/CheckoutController.php:222
 * @route '/api/checkout/complete'
 */
complete.url = (options?: RouteQueryOptions) => {
    return complete.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CheckoutController::complete
 * @see app/Http/Controllers/CheckoutController.php:222
 * @route '/api/checkout/complete'
 */
complete.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: complete.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\CheckoutController::complete
 * @see app/Http/Controllers/CheckoutController.php:222
 * @route '/api/checkout/complete'
 */
complete.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: complete.url(options),
    method: 'post',
})
/**
* @see \App\Http\Controllers\CheckoutController::complete
 * @see app/Http/Controllers/CheckoutController.php:222
 * @route '/api/checkout/complete'
 */
complete.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: complete.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\CheckoutController::fail
 * @see app/Http/Controllers/CheckoutController.php:365
 * @route '/api/checkout/fail'
 */
export const fail = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: fail.url(options),
    method: 'get',
})

fail.definition = {
    methods: ["get","post","head"],
    url: '/api/checkout/fail',
} satisfies RouteDefinition<["get","post","head"]>

/**
* @see \App\Http\Controllers\CheckoutController::fail
 * @see app/Http/Controllers/CheckoutController.php:365
 * @route '/api/checkout/fail'
 */
fail.url = (options?: RouteQueryOptions) => {
    return fail.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CheckoutController::fail
 * @see app/Http/Controllers/CheckoutController.php:365
 * @route '/api/checkout/fail'
 */
fail.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: fail.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\CheckoutController::fail
 * @see app/Http/Controllers/CheckoutController.php:365
 * @route '/api/checkout/fail'
 */
fail.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: fail.url(options),
    method: 'post',
})
/**
* @see \App\Http\Controllers\CheckoutController::fail
 * @see app/Http/Controllers/CheckoutController.php:365
 * @route '/api/checkout/fail'
 */
fail.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: fail.url(options),
    method: 'head',
})
const checkout = {
    complete: Object.assign(complete, complete),
fail: Object.assign(fail, fail),
}

export default checkout