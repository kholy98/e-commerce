import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
import complete460dbc from './complete'
import fail71ea6e from './fail'
/**
* @see \App\Http\Controllers\CheckoutController::complete
 * @see app/Http/Controllers/CheckoutController.php:485
 * @route '/api/checkout/complete'
 */
export const complete = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: complete.url(options),
    method: 'get',
})

complete.definition = {
    methods: ["get","head"],
    url: '/api/checkout/complete',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\CheckoutController::complete
 * @see app/Http/Controllers/CheckoutController.php:485
 * @route '/api/checkout/complete'
 */
complete.url = (options?: RouteQueryOptions) => {
    return complete.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CheckoutController::complete
 * @see app/Http/Controllers/CheckoutController.php:485
 * @route '/api/checkout/complete'
 */
complete.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: complete.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\CheckoutController::complete
 * @see app/Http/Controllers/CheckoutController.php:485
 * @route '/api/checkout/complete'
 */
complete.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: complete.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\CheckoutController::complete
 * @see app/Http/Controllers/CheckoutController.php:485
 * @route '/api/checkout/complete'
 */
    const completeForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: complete.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\CheckoutController::complete
 * @see app/Http/Controllers/CheckoutController.php:485
 * @route '/api/checkout/complete'
 */
        completeForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: complete.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\CheckoutController::complete
 * @see app/Http/Controllers/CheckoutController.php:485
 * @route '/api/checkout/complete'
 */
        completeForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: complete.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    complete.form = completeForm
/**
* @see \App\Http\Controllers\CheckoutController::fail
 * @see app/Http/Controllers/CheckoutController.php:794
 * @route '/api/checkout/fail'
 */
export const fail = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: fail.url(options),
    method: 'get',
})

fail.definition = {
    methods: ["get","head"],
    url: '/api/checkout/fail',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\CheckoutController::fail
 * @see app/Http/Controllers/CheckoutController.php:794
 * @route '/api/checkout/fail'
 */
fail.url = (options?: RouteQueryOptions) => {
    return fail.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CheckoutController::fail
 * @see app/Http/Controllers/CheckoutController.php:794
 * @route '/api/checkout/fail'
 */
fail.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: fail.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\CheckoutController::fail
 * @see app/Http/Controllers/CheckoutController.php:794
 * @route '/api/checkout/fail'
 */
fail.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: fail.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\CheckoutController::fail
 * @see app/Http/Controllers/CheckoutController.php:794
 * @route '/api/checkout/fail'
 */
    const failForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: fail.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\CheckoutController::fail
 * @see app/Http/Controllers/CheckoutController.php:794
 * @route '/api/checkout/fail'
 */
        failForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: fail.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\CheckoutController::fail
 * @see app/Http/Controllers/CheckoutController.php:794
 * @route '/api/checkout/fail'
 */
        failForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: fail.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    fail.form = failForm
const checkout = {
    complete: Object.assign(complete, complete460dbc),
fail: Object.assign(fail, fail71ea6e),
}

export default checkout