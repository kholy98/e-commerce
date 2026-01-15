import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\ConfigController::updateEnv
 * @see app/Http/Controllers/ConfigController.php:12
 * @route '/api/settings/env'
 */
export const updateEnv = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: updateEnv.url(options),
    method: 'post',
})

updateEnv.definition = {
    methods: ["post"],
    url: '/api/settings/env',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\ConfigController::updateEnv
 * @see app/Http/Controllers/ConfigController.php:12
 * @route '/api/settings/env'
 */
updateEnv.url = (options?: RouteQueryOptions) => {
    return updateEnv.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ConfigController::updateEnv
 * @see app/Http/Controllers/ConfigController.php:12
 * @route '/api/settings/env'
 */
updateEnv.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: updateEnv.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\ConfigController::showEnvStatus
 * @see app/Http/Controllers/ConfigController.php:60
 * @route '/api/settings/env/debug'
 */
export const showEnvStatus = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: showEnvStatus.url(options),
    method: 'get',
})

showEnvStatus.definition = {
    methods: ["get","head"],
    url: '/api/settings/env/debug',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\ConfigController::showEnvStatus
 * @see app/Http/Controllers/ConfigController.php:60
 * @route '/api/settings/env/debug'
 */
showEnvStatus.url = (options?: RouteQueryOptions) => {
    return showEnvStatus.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ConfigController::showEnvStatus
 * @see app/Http/Controllers/ConfigController.php:60
 * @route '/api/settings/env/debug'
 */
showEnvStatus.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: showEnvStatus.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\ConfigController::showEnvStatus
 * @see app/Http/Controllers/ConfigController.php:60
 * @route '/api/settings/env/debug'
 */
showEnvStatus.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: showEnvStatus.url(options),
    method: 'head',
})
const ConfigController = { updateEnv, showEnvStatus }

export default ConfigController