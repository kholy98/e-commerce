import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\CheckoutController::initiate
 * @see app/Http/Controllers/CheckoutController.php:139
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
 * @see app/Http/Controllers/CheckoutController.php:139
 * @route '/api/checkout/initiate'
 */
initiate.url = (options?: RouteQueryOptions) => {
    return initiate.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CheckoutController::initiate
 * @see app/Http/Controllers/CheckoutController.php:139
 * @route '/api/checkout/initiate'
 */
initiate.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: initiate.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\CheckoutController::initiate
 * @see app/Http/Controllers/CheckoutController.php:139
 * @route '/api/checkout/initiate'
 */
    const initiateForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: initiate.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\CheckoutController::initiate
 * @see app/Http/Controllers/CheckoutController.php:139
 * @route '/api/checkout/initiate'
 */
        initiateForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: initiate.url(options),
            method: 'post',
        })
    
    initiate.form = initiateForm
/**
* @see \App\Http\Controllers\CheckoutController::completeGet
 * @see app/Http/Controllers/CheckoutController.php:485
 * @route '/api/checkout/complete'
 */
export const completeGet = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: completeGet.url(options),
    method: 'get',
})

completeGet.definition = {
    methods: ["get","head"],
    url: '/api/checkout/complete',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\CheckoutController::completeGet
 * @see app/Http/Controllers/CheckoutController.php:485
 * @route '/api/checkout/complete'
 */
completeGet.url = (options?: RouteQueryOptions) => {
    return completeGet.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CheckoutController::completeGet
 * @see app/Http/Controllers/CheckoutController.php:485
 * @route '/api/checkout/complete'
 */
completeGet.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: completeGet.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\CheckoutController::completeGet
 * @see app/Http/Controllers/CheckoutController.php:485
 * @route '/api/checkout/complete'
 */
completeGet.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: completeGet.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\CheckoutController::completeGet
 * @see app/Http/Controllers/CheckoutController.php:485
 * @route '/api/checkout/complete'
 */
    const completeGetForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: completeGet.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\CheckoutController::completeGet
 * @see app/Http/Controllers/CheckoutController.php:485
 * @route '/api/checkout/complete'
 */
        completeGetForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: completeGet.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\CheckoutController::completeGet
 * @see app/Http/Controllers/CheckoutController.php:485
 * @route '/api/checkout/complete'
 */
        completeGetForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: completeGet.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    completeGet.form = completeGetForm
/**
* @see \App\Http\Controllers\CheckoutController::completePost
 * @see app/Http/Controllers/CheckoutController.php:602
 * @route '/api/checkout/complete'
 */
export const completePost = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: completePost.url(options),
    method: 'post',
})

completePost.definition = {
    methods: ["post"],
    url: '/api/checkout/complete',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\CheckoutController::completePost
 * @see app/Http/Controllers/CheckoutController.php:602
 * @route '/api/checkout/complete'
 */
completePost.url = (options?: RouteQueryOptions) => {
    return completePost.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CheckoutController::completePost
 * @see app/Http/Controllers/CheckoutController.php:602
 * @route '/api/checkout/complete'
 */
completePost.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: completePost.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\CheckoutController::completePost
 * @see app/Http/Controllers/CheckoutController.php:602
 * @route '/api/checkout/complete'
 */
    const completePostForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: completePost.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\CheckoutController::completePost
 * @see app/Http/Controllers/CheckoutController.php:602
 * @route '/api/checkout/complete'
 */
        completePostForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: completePost.url(options),
            method: 'post',
        })
    
    completePost.form = completePostForm
/**
* @see \App\Http\Controllers\CheckoutController::failGet
 * @see app/Http/Controllers/CheckoutController.php:794
 * @route '/api/checkout/fail'
 */
export const failGet = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: failGet.url(options),
    method: 'get',
})

failGet.definition = {
    methods: ["get","head"],
    url: '/api/checkout/fail',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\CheckoutController::failGet
 * @see app/Http/Controllers/CheckoutController.php:794
 * @route '/api/checkout/fail'
 */
failGet.url = (options?: RouteQueryOptions) => {
    return failGet.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CheckoutController::failGet
 * @see app/Http/Controllers/CheckoutController.php:794
 * @route '/api/checkout/fail'
 */
failGet.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: failGet.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\CheckoutController::failGet
 * @see app/Http/Controllers/CheckoutController.php:794
 * @route '/api/checkout/fail'
 */
failGet.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: failGet.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\CheckoutController::failGet
 * @see app/Http/Controllers/CheckoutController.php:794
 * @route '/api/checkout/fail'
 */
    const failGetForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: failGet.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\CheckoutController::failGet
 * @see app/Http/Controllers/CheckoutController.php:794
 * @route '/api/checkout/fail'
 */
        failGetForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: failGet.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\CheckoutController::failGet
 * @see app/Http/Controllers/CheckoutController.php:794
 * @route '/api/checkout/fail'
 */
        failGetForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: failGet.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    failGet.form = failGetForm
/**
* @see \App\Http\Controllers\CheckoutController::failPost
 * @see app/Http/Controllers/CheckoutController.php:817
 * @route '/api/checkout/fail'
 */
export const failPost = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: failPost.url(options),
    method: 'post',
})

failPost.definition = {
    methods: ["post"],
    url: '/api/checkout/fail',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\CheckoutController::failPost
 * @see app/Http/Controllers/CheckoutController.php:817
 * @route '/api/checkout/fail'
 */
failPost.url = (options?: RouteQueryOptions) => {
    return failPost.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CheckoutController::failPost
 * @see app/Http/Controllers/CheckoutController.php:817
 * @route '/api/checkout/fail'
 */
failPost.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: failPost.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\CheckoutController::failPost
 * @see app/Http/Controllers/CheckoutController.php:817
 * @route '/api/checkout/fail'
 */
    const failPostForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: failPost.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\CheckoutController::failPost
 * @see app/Http/Controllers/CheckoutController.php:817
 * @route '/api/checkout/fail'
 */
        failPostForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: failPost.url(options),
            method: 'post',
        })
    
    failPost.form = failPostForm
/**
* @see \App\Http\Controllers\CheckoutController::status
 * @see app/Http/Controllers/CheckoutController.php:880
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
 * @see app/Http/Controllers/CheckoutController.php:880
 * @route '/api/checkout/status'
 */
status.url = (options?: RouteQueryOptions) => {
    return status.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CheckoutController::status
 * @see app/Http/Controllers/CheckoutController.php:880
 * @route '/api/checkout/status'
 */
status.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: status.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\CheckoutController::status
 * @see app/Http/Controllers/CheckoutController.php:880
 * @route '/api/checkout/status'
 */
status.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: status.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\CheckoutController::status
 * @see app/Http/Controllers/CheckoutController.php:880
 * @route '/api/checkout/status'
 */
    const statusForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: status.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\CheckoutController::status
 * @see app/Http/Controllers/CheckoutController.php:880
 * @route '/api/checkout/status'
 */
        statusForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: status.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\CheckoutController::status
 * @see app/Http/Controllers/CheckoutController.php:880
 * @route '/api/checkout/status'
 */
        statusForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: status.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    status.form = statusForm
/**
* @see \App\Http\Controllers\CheckoutController::testComplete
 * @see app/Http/Controllers/CheckoutController.php:922
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
 * @see app/Http/Controllers/CheckoutController.php:922
 * @route '/api/checkout/test-complete'
 */
testComplete.url = (options?: RouteQueryOptions) => {
    return testComplete.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CheckoutController::testComplete
 * @see app/Http/Controllers/CheckoutController.php:922
 * @route '/api/checkout/test-complete'
 */
testComplete.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: testComplete.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\CheckoutController::testComplete
 * @see app/Http/Controllers/CheckoutController.php:922
 * @route '/api/checkout/test-complete'
 */
    const testCompleteForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: testComplete.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\CheckoutController::testComplete
 * @see app/Http/Controllers/CheckoutController.php:922
 * @route '/api/checkout/test-complete'
 */
        testCompleteForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: testComplete.url(options),
            method: 'post',
        })
    
    testComplete.form = testCompleteForm
const CheckoutController = { initiate, completeGet, completePost, failGet, failPost, status, testComplete }

export default CheckoutController