import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\ProductController::index
 * @see app/Http/Controllers/ProductController.php:18
 * @route '/api/products'
 */
const index6ab24975c76dbf11a1bc082b81a80bc0 = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index6ab24975c76dbf11a1bc082b81a80bc0.url(options),
    method: 'get',
})

index6ab24975c76dbf11a1bc082b81a80bc0.definition = {
    methods: ["get","head"],
    url: '/api/products',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\ProductController::index
 * @see app/Http/Controllers/ProductController.php:18
 * @route '/api/products'
 */
index6ab24975c76dbf11a1bc082b81a80bc0.url = (options?: RouteQueryOptions) => {
    return index6ab24975c76dbf11a1bc082b81a80bc0.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ProductController::index
 * @see app/Http/Controllers/ProductController.php:18
 * @route '/api/products'
 */
index6ab24975c76dbf11a1bc082b81a80bc0.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index6ab24975c76dbf11a1bc082b81a80bc0.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\ProductController::index
 * @see app/Http/Controllers/ProductController.php:18
 * @route '/api/products'
 */
index6ab24975c76dbf11a1bc082b81a80bc0.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index6ab24975c76dbf11a1bc082b81a80bc0.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\ProductController::index
 * @see app/Http/Controllers/ProductController.php:18
 * @route '/api/admin/products'
 */
const index13f7c3a9a0716a5e847b6b329b9ba456 = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index13f7c3a9a0716a5e847b6b329b9ba456.url(options),
    method: 'get',
})

index13f7c3a9a0716a5e847b6b329b9ba456.definition = {
    methods: ["get","head"],
    url: '/api/admin/products',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\ProductController::index
 * @see app/Http/Controllers/ProductController.php:18
 * @route '/api/admin/products'
 */
index13f7c3a9a0716a5e847b6b329b9ba456.url = (options?: RouteQueryOptions) => {
    return index13f7c3a9a0716a5e847b6b329b9ba456.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ProductController::index
 * @see app/Http/Controllers/ProductController.php:18
 * @route '/api/admin/products'
 */
index13f7c3a9a0716a5e847b6b329b9ba456.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index13f7c3a9a0716a5e847b6b329b9ba456.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\ProductController::index
 * @see app/Http/Controllers/ProductController.php:18
 * @route '/api/admin/products'
 */
index13f7c3a9a0716a5e847b6b329b9ba456.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index13f7c3a9a0716a5e847b6b329b9ba456.url(options),
    method: 'head',
})

export const index = {
    '/api/products': index6ab24975c76dbf11a1bc082b81a80bc0,
    '/api/admin/products': index13f7c3a9a0716a5e847b6b329b9ba456,
}

/**
* @see \App\Http\Controllers\ProductController::show
 * @see app/Http/Controllers/ProductController.php:147
 * @route '/api/products/{product}'
 */
export const show = (args: { product: string | number | { id: string | number } } | [product: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/api/products/{product}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\ProductController::show
 * @see app/Http/Controllers/ProductController.php:147
 * @route '/api/products/{product}'
 */
show.url = (args: { product: string | number | { id: string | number } } | [product: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { product: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { product: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    product: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        product: typeof args.product === 'object'
                ? args.product.id
                : args.product,
                }

    return show.definition.url
            .replace('{product}', parsedArgs.product.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\ProductController::show
 * @see app/Http/Controllers/ProductController.php:147
 * @route '/api/products/{product}'
 */
show.get = (args: { product: string | number | { id: string | number } } | [product: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\ProductController::show
 * @see app/Http/Controllers/ProductController.php:147
 * @route '/api/products/{product}'
 */
show.head = (args: { product: string | number | { id: string | number } } | [product: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\ProductController::store
 * @see app/Http/Controllers/ProductController.php:236
 * @route '/api/admin/products'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/api/admin/products',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\ProductController::store
 * @see app/Http/Controllers/ProductController.php:236
 * @route '/api/admin/products'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ProductController::store
 * @see app/Http/Controllers/ProductController.php:236
 * @route '/api/admin/products'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\ProductController::update
 * @see app/Http/Controllers/ProductController.php:279
 * @route '/api/admin/products/{product}'
 */
export const update = (args: { product: string | number | { id: string | number } } | [product: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/api/admin/products/{product}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\ProductController::update
 * @see app/Http/Controllers/ProductController.php:279
 * @route '/api/admin/products/{product}'
 */
update.url = (args: { product: string | number | { id: string | number } } | [product: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { product: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { product: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    product: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        product: typeof args.product === 'object'
                ? args.product.id
                : args.product,
                }

    return update.definition.url
            .replace('{product}', parsedArgs.product.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\ProductController::update
 * @see app/Http/Controllers/ProductController.php:279
 * @route '/api/admin/products/{product}'
 */
update.put = (args: { product: string | number | { id: string | number } } | [product: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\ProductController::destroy
 * @see app/Http/Controllers/ProductController.php:371
 * @route '/api/admin/products/{product}'
 */
export const destroy = (args: { product: string | number | { id: string | number } } | [product: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/api/admin/products/{product}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\ProductController::destroy
 * @see app/Http/Controllers/ProductController.php:371
 * @route '/api/admin/products/{product}'
 */
destroy.url = (args: { product: string | number | { id: string | number } } | [product: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { product: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { product: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    product: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        product: typeof args.product === 'object'
                ? args.product.id
                : args.product,
                }

    return destroy.definition.url
            .replace('{product}', parsedArgs.product.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\ProductController::destroy
 * @see app/Http/Controllers/ProductController.php:371
 * @route '/api/admin/products/{product}'
 */
destroy.delete = (args: { product: string | number | { id: string | number } } | [product: string | number | { id: string | number } ] | string | number | { id: string | number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\ProductController::lowStock
 * @see app/Http/Controllers/ProductController.php:384
 * @route '/api/admin/products/low-stock'
 */
export const lowStock = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: lowStock.url(options),
    method: 'get',
})

lowStock.definition = {
    methods: ["get","head"],
    url: '/api/admin/products/low-stock',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\ProductController::lowStock
 * @see app/Http/Controllers/ProductController.php:384
 * @route '/api/admin/products/low-stock'
 */
lowStock.url = (options?: RouteQueryOptions) => {
    return lowStock.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ProductController::lowStock
 * @see app/Http/Controllers/ProductController.php:384
 * @route '/api/admin/products/low-stock'
 */
lowStock.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: lowStock.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\ProductController::lowStock
 * @see app/Http/Controllers/ProductController.php:384
 * @route '/api/admin/products/low-stock'
 */
lowStock.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: lowStock.url(options),
    method: 'head',
})
const ProductController = { index, show, store, update, destroy, lowStock }

export default ProductController