<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

// Authentication routes
Route::get('/login', function () {
    return Inertia::render('auth/login', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('login')->middleware('guest');

Route::get('/register', function () {
    return Inertia::render('auth/register');
})->name('register')->middleware('guest');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        // Products
        Route::get('products', function () {
            return Inertia::render('admin/products/index');
        })->name('products.index');

        Route::get('products/create', function () {
            return Inertia::render('admin/products/create', [
                'categories' => \App\Models\Category::where('is_active', true)->get(),
            ]);
        })->name('products.create');

        Route::get('products/{product}/edit', function (\App\Models\Product $product) {
            return Inertia::render('admin/products/edit', [
                'product' => $product->load(['category', 'media']),
                'categories' => \App\Models\Category::where('is_active', true)->get(),
            ]);
        })->name('products.edit');

        Route::get('products/{product}', function (\App\Models\Product $product) {
            return Inertia::render('admin/products/show', [
                'product' => $product->load(['category', 'media']),
            ]);
        })->name('products.show');

        // Product form handling
        Route::post('products', [\App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
        Route::put('products/{product}', [\App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
        Route::delete('products/{product}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');

        // Categories
        Route::get('categories', function () {
            return Inertia::render('admin/categories/index');
        })->name('categories.index');

        Route::get('categories/create', function () {
            return Inertia::render('admin/categories/create', [
                'categories' => \App\Models\Category::where('is_active', true)->get(),
            ]);
        })->name('categories.create');

        Route::get('categories/{category}/edit', function (\App\Models\Category $category) {
            return Inertia::render('admin/categories/edit', [
                'category' => $category,
                'categories' => \App\Models\Category::where('is_active', true)->get(),
            ]);
        })->name('categories.edit');

        Route::get('categories/{category}', function (\App\Models\Category $category) {
            return Inertia::render('admin/categories/show', ['category' => $category]);
        })->name('categories.show');
    });
});

require __DIR__.'/settings.php';
