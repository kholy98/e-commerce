import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../wayfinder'
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
* @see \App\Http\Controllers\PaymentController::paymentProcess
 * @see app/Http/Controllers/PaymentController.php:25
 * @route '/api/payment/process'
 */
    const paymentProcessForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: paymentProcess.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\PaymentController::paymentProcess
 * @see app/Http/Controllers/PaymentController.php:25
 * @route '/api/payment/process'
 */
        paymentProcessForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: paymentProcess.url(options),
            method: 'post',
        })
    
    paymentProcess.form = paymentProcessForm
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
* @see \App\Http\Controllers\PaymentController::callBack
 * @see app/Http/Controllers/PaymentController.php:49
 * @route '/api/payment/callback'
 */
    const callBackForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: callBack.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\PaymentController::callBack
 * @see app/Http/Controllers/PaymentController.php:49
 * @route '/api/payment/callback'
 */
        callBackForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: callBack.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\PaymentController::callBack
 * @see app/Http/Controllers/PaymentController.php:49
 * @route '/api/payment/callback'
 */
        callBackForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: callBack.url(options),
            method: 'post',
        })
            /**
* @see \App\Http\Controllers\PaymentController::callBack
 * @see app/Http/Controllers/PaymentController.php:49
 * @route '/api/payment/callback'
 */
        callBackForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: callBack.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    callBack.form = callBackForm
/**
* @see \App\Http\Controllers\PaymentController::webhook
 * @see app/Http/Controllers/PaymentController.php:119
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
 * @see app/Http/Controllers/PaymentController.php:119
 * @route '/api/payment/webhook'
 */
webhook.url = (options?: RouteQueryOptions) => {
    return webhook.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PaymentController::webhook
 * @see app/Http/Controllers/PaymentController.php:119
 * @route '/api/payment/webhook'
 */
webhook.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: webhook.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\PaymentController::webhook
 * @see app/Http/Controllers/PaymentController.php:119
 * @route '/api/payment/webhook'
 */
    const webhookForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: webhook.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\PaymentController::webhook
 * @see app/Http/Controllers/PaymentController.php:119
 * @route '/api/payment/webhook'
 */
        webhookForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: webhook.url(options),
            method: 'post',
        })
    
    webhook.form = webhookForm
const PaymentController = { paymentProcess, callBack, webhook }

export default PaymentController