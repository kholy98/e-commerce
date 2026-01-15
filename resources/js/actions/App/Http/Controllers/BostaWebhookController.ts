import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\BostaWebhookController::handle
 * @see app/Http/Controllers/BostaWebhookController.php:37
 * @route '/api/webhook/bosta'
 */
export const handle = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: handle.url(options),
    method: 'post',
})

handle.definition = {
    methods: ["post"],
    url: '/api/webhook/bosta',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\BostaWebhookController::handle
 * @see app/Http/Controllers/BostaWebhookController.php:37
 * @route '/api/webhook/bosta'
 */
handle.url = (options?: RouteQueryOptions) => {
    return handle.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\BostaWebhookController::handle
 * @see app/Http/Controllers/BostaWebhookController.php:37
 * @route '/api/webhook/bosta'
 */
handle.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: handle.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\BostaWebhookController::testWebhook
 * @see app/Http/Controllers/BostaWebhookController.php:126
 * @route '/api/test/webhook/bosta'
 */
export const testWebhook = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: testWebhook.url(options),
    method: 'post',
})

testWebhook.definition = {
    methods: ["post"],
    url: '/api/test/webhook/bosta',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\BostaWebhookController::testWebhook
 * @see app/Http/Controllers/BostaWebhookController.php:126
 * @route '/api/test/webhook/bosta'
 */
testWebhook.url = (options?: RouteQueryOptions) => {
    return testWebhook.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\BostaWebhookController::testWebhook
 * @see app/Http/Controllers/BostaWebhookController.php:126
 * @route '/api/test/webhook/bosta'
 */
testWebhook.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: testWebhook.url(options),
    method: 'post',
})
const BostaWebhookController = { handle, testWebhook }

export default BostaWebhookController