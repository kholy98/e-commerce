import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\CheckoutController::initiate
 * @see app/Http/Controllers/CheckoutController.php:42
 * @route '/api/checkout/initiate'
 */
export const initiate = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: initiate.url(options),
    method: 'post',
})

initiate.definition = {
    methods: ["post"],
    url: '/api/checkout/initiate',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\CheckoutController::initiate
 * @see app/Http/Controllers/CheckoutController.php:42
 * @route '/api/checkout/initiate'
 */
initiate.url = (options?: RouteQueryOptions) => {
    return initiate.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CheckoutController::initiate
 * @see app/Http/Controllers/CheckoutController.php:42
 * @route '/api/checkout/initiate'
 */
initiate.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: initiate.url(options),
    method: 'post',
})

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

/**
* @see \App\Http\Controllers\CheckoutController::status
 * @see app/Http/Controllers/CheckoutController.php:389
 * @route '/api/checkout/status'
 */
export const status = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: status.url(options),
    method: 'get',
})

status.definition = {
    methods: ["get","head"],
    url: '/api/checkout/status',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\CheckoutController::status
 * @see app/Http/Controllers/CheckoutController.php:389
 * @route '/api/checkout/status'
 */
status.url = (options?: RouteQueryOptions) => {
    return status.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CheckoutController::status
 * @see app/Http/Controllers/CheckoutController.php:389
 * @route '/api/checkout/status'
 */
status.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: status.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\CheckoutController::status
 * @see app/Http/Controllers/CheckoutController.php:389
 * @route '/api/checkout/status'
 */
status.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: status.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\CheckoutController::testComplete
 * @see app/Http/Controllers/CheckoutController.php:414
 * @route '/api/checkout/test-complete'
 */
export const testComplete = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: testComplete.url(options),
    method: 'post',
})

testComplete.definition = {
    methods: ["post"],
    url: '/api/checkout/test-complete',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\CheckoutController::testComplete
 * @see app/Http/Controllers/CheckoutController.php:414
 * @route '/api/checkout/test-complete'
 */
testComplete.url = (options?: RouteQueryOptions) => {
    return testComplete.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CheckoutController::testComplete
 * @see app/Http/Controllers/CheckoutController.php:414
 * @route '/api/checkout/test-complete'
 */
testComplete.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: testComplete.url(options),
    method: 'post',
})
const CheckoutController = { initiate, complete, fail, status, testComplete }

export default CheckoutController