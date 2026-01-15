import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\PaymentController::paymentProcess
 * @see app/Http/Controllers/PaymentController.php:25
 * @route '/api/payment/process'
 */
export const paymentProcess = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: paymentProcess.url(options),
    method: 'post',
})

paymentProcess.definition = {
    methods: ["post"],
    url: '/api/payment/process',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\PaymentController::paymentProcess
 * @see app/Http/Controllers/PaymentController.php:25
 * @route '/api/payment/process'
 */
paymentProcess.url = (options?: RouteQueryOptions) => {
    return paymentProcess.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PaymentController::paymentProcess
 * @see app/Http/Controllers/PaymentController.php:25
 * @route '/api/payment/process'
 */
paymentProcess.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: paymentProcess.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\PaymentController::callBack
 * @see app/Http/Controllers/PaymentController.php:49
 * @route '/api/payment/callback'
 */
export const callBack = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: callBack.url(options),
    method: 'get',
})

callBack.definition = {
    methods: ["get","post","head"],
    url: '/api/payment/callback',
} satisfies RouteDefinition<["get","post","head"]>

/**
* @see \App\Http\Controllers\PaymentController::callBack
 * @see app/Http/Controllers/PaymentController.php:49
 * @route '/api/payment/callback'
 */
callBack.url = (options?: RouteQueryOptions) => {
    return callBack.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PaymentController::callBack
 * @see app/Http/Controllers/PaymentController.php:49
 * @route '/api/payment/callback'
 */
callBack.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: callBack.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\PaymentController::callBack
 * @see app/Http/Controllers/PaymentController.php:49
 * @route '/api/payment/callback'
 */
callBack.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: callBack.url(options),
    method: 'post',
})
/**
* @see \App\Http\Controllers\PaymentController::callBack
 * @see app/Http/Controllers/PaymentController.php:49
 * @route '/api/payment/callback'
 */
callBack.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: callBack.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PaymentController::webhook
 * @see app/Http/Controllers/PaymentController.php:108
 * @route '/api/payment/webhook'
 */
export const webhook = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: webhook.url(options),
    method: 'post',
})

webhook.definition = {
    methods: ["post"],
    url: '/api/payment/webhook',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\PaymentController::webhook
 * @see app/Http/Controllers/PaymentController.php:108
 * @route '/api/payment/webhook'
 */
webhook.url = (options?: RouteQueryOptions) => {
    return webhook.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PaymentController::webhook
 * @see app/Http/Controllers/PaymentController.php:108
 * @route '/api/payment/webhook'
 */
webhook.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: webhook.url(options),
    method: 'post',
})
const PaymentController = { paymentProcess, callBack, webhook }

export default PaymentController