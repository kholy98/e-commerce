import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\ShipmentController::create
 * @see app/Http/Controllers/ShipmentController.php:11
 * @route '/api/shipments'
 */
export const create = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: create.url(options),
    method: 'post',
})

create.definition = {
    methods: ["post"],
    url: '/api/shipments',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\ShipmentController::create
 * @see app/Http/Controllers/ShipmentController.php:11
 * @route '/api/shipments'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ShipmentController::create
 * @see app/Http/Controllers/ShipmentController.php:11
 * @route '/api/shipments'
 */
create.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: create.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\ShipmentController::track
 * @see app/Http/Controllers/ShipmentController.php:77
 * @route '/api/shipments/{tracking_number}'
 */
export const track = (args: { tracking_number: string | number } | [tracking_number: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: track.url(args, options),
    method: 'get',
})

track.definition = {
    methods: ["get","head"],
    url: '/api/shipments/{tracking_number}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\ShipmentController::track
 * @see app/Http/Controllers/ShipmentController.php:77
 * @route '/api/shipments/{tracking_number}'
 */
track.url = (args: { tracking_number: string | number } | [tracking_number: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { tracking_number: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    tracking_number: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        tracking_number: args.tracking_number,
                }

    return track.definition.url
            .replace('{tracking_number}', parsedArgs.tracking_number.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\ShipmentController::track
 * @see app/Http/Controllers/ShipmentController.php:77
 * @route '/api/shipments/{tracking_number}'
 */
track.get = (args: { tracking_number: string | number } | [tracking_number: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: track.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\ShipmentController::track
 * @see app/Http/Controllers/ShipmentController.php:77
 * @route '/api/shipments/{tracking_number}'
 */
track.head = (args: { tracking_number: string | number } | [tracking_number: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: track.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\ShipmentController::update
 * @see app/Http/Controllers/ShipmentController.php:115
 * @route '/api/shipments/{tracking_number}'
 */
export const update = (args: { tracking_number: string | number } | [tracking_number: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/api/shipments/{tracking_number}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\ShipmentController::update
 * @see app/Http/Controllers/ShipmentController.php:115
 * @route '/api/shipments/{tracking_number}'
 */
update.url = (args: { tracking_number: string | number } | [tracking_number: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { tracking_number: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    tracking_number: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        tracking_number: args.tracking_number,
                }

    return update.definition.url
            .replace('{tracking_number}', parsedArgs.tracking_number.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\ShipmentController::update
 * @see app/Http/Controllers/ShipmentController.php:115
 * @route '/api/shipments/{tracking_number}'
 */
update.put = (args: { tracking_number: string | number } | [tracking_number: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\ShipmentController::createPickup
 * @see app/Http/Controllers/ShipmentController.php:146
 * @route '/api/pickups'
 */
export const createPickup = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: createPickup.url(options),
    method: 'post',
})

createPickup.definition = {
    methods: ["post"],
    url: '/api/pickups',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\ShipmentController::createPickup
 * @see app/Http/Controllers/ShipmentController.php:146
 * @route '/api/pickups'
 */
createPickup.url = (options?: RouteQueryOptions) => {
    return createPickup.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ShipmentController::createPickup
 * @see app/Http/Controllers/ShipmentController.php:146
 * @route '/api/pickups'
 */
createPickup.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: createPickup.url(options),
    method: 'post',
})
const ShipmentController = { create, track, update, createPickup }

export default ShipmentController