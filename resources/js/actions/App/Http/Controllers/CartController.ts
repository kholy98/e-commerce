import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\CartController::index
 * @see app/Http/Controllers/CartController.php:25
 * @route '/api/cart'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/api/cart',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\CartController::index
 * @see app/Http/Controllers/CartController.php:25
 * @route '/api/cart'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CartController::index
 * @see app/Http/Controllers/CartController.php:25
 * @route '/api/cart'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\CartController::index
 * @see app/Http/Controllers/CartController.php:25
 * @route '/api/cart'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\CartController::add
 * @see app/Http/Controllers/CartController.php:44
 * @route '/api/cart/add'
 */
export const add = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: add.url(options),
    method: 'post',
})

add.definition = {
    methods: ["post"],
    url: '/api/cart/add',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\CartController::add
 * @see app/Http/Controllers/CartController.php:44
 * @route '/api/cart/add'
 */
add.url = (options?: RouteQueryOptions) => {
    return add.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CartController::add
 * @see app/Http/Controllers/CartController.php:44
 * @route '/api/cart/add'
 */
add.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: add.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\CartController::update
 * @see app/Http/Controllers/CartController.php:73
 * @route '/api/cart/{productId}'
 */
export const update = (args: { productId: string | number } | [productId: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

update.definition = {
    methods: ["patch"],
    url: '/api/cart/{productId}',
} satisfies RouteDefinition<["patch"]>

/**
* @see \App\Http\Controllers\CartController::update
 * @see app/Http/Controllers/CartController.php:73
 * @route '/api/cart/{productId}'
 */
update.url = (args: { productId: string | number } | [productId: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { productId: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    productId: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        productId: args.productId,
                }

    return update.definition.url
            .replace('{productId}', parsedArgs.productId.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\CartController::update
 * @see app/Http/Controllers/CartController.php:73
 * @route '/api/cart/{productId}'
 */
update.patch = (args: { productId: string | number } | [productId: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

/**
* @see \App\Http\Controllers\CartController::remove
 * @see app/Http/Controllers/CartController.php:101
 * @route '/api/cart/{productId}'
 */
export const remove = (args: { productId: string | number } | [productId: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: remove.url(args, options),
    method: 'delete',
})

remove.definition = {
    methods: ["delete"],
    url: '/api/cart/{productId}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\CartController::remove
 * @see app/Http/Controllers/CartController.php:101
 * @route '/api/cart/{productId}'
 */
remove.url = (args: { productId: string | number } | [productId: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { productId: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    productId: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        productId: args.productId,
                }

    return remove.definition.url
            .replace('{productId}', parsedArgs.productId.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\CartController::remove
 * @see app/Http/Controllers/CartController.php:101
 * @route '/api/cart/{productId}'
 */
remove.delete = (args: { productId: string | number } | [productId: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: remove.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\CartController::clear
 * @see app/Http/Controllers/CartController.php:115
 * @route '/api/cart'
 */
export const clear = (options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: clear.url(options),
    method: 'delete',
})

clear.definition = {
    methods: ["delete"],
    url: '/api/cart',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\CartController::clear
 * @see app/Http/Controllers/CartController.php:115
 * @route '/api/cart'
 */
clear.url = (options?: RouteQueryOptions) => {
    return clear.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CartController::clear
 * @see app/Http/Controllers/CartController.php:115
 * @route '/api/cart'
 */
clear.delete = (options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: clear.url(options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\CartController::summary
 * @see app/Http/Controllers/CartController.php:128
 * @route '/api/cart/summary'
 */
export const summary = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: summary.url(options),
    method: 'get',
})

summary.definition = {
    methods: ["get","head"],
    url: '/api/cart/summary',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\CartController::summary
 * @see app/Http/Controllers/CartController.php:128
 * @route '/api/cart/summary'
 */
summary.url = (options?: RouteQueryOptions) => {
    return summary.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CartController::summary
 * @see app/Http/Controllers/CartController.php:128
 * @route '/api/cart/summary'
 */
summary.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: summary.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\CartController::summary
 * @see app/Http/Controllers/CartController.php:128
 * @route '/api/cart/summary'
 */
summary.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: summary.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\CartController::count
 * @see app/Http/Controllers/CartController.php:141
 * @route '/api/cart/count'
 */
export const count = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: count.url(options),
    method: 'get',
})

count.definition = {
    methods: ["get","head"],
    url: '/api/cart/count',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\CartController::count
 * @see app/Http/Controllers/CartController.php:141
 * @route '/api/cart/count'
 */
count.url = (options?: RouteQueryOptions) => {
    return count.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CartController::count
 * @see app/Http/Controllers/CartController.php:141
 * @route '/api/cart/count'
 */
count.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: count.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\CartController::count
 * @see app/Http/Controllers/CartController.php:141
 * @route '/api/cart/count'
 */
count.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: count.url(options),
    method: 'head',
})
const CartController = { index, add, update, remove, clear, summary, count }

export default CartController