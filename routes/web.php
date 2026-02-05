<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

// Authentication routes are handled by FortifyServiceProvider

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
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
        Route::post('products', [\App\Http\Controllers\AdminProductController::class, 'store'])->name('products.store');
        Route::post('products/{product}', [\App\Http\Controllers\AdminProductController::class, 'update'])->name('products.update');
        Route::delete('products/{product}', [\App\Http\Controllers\AdminProductController::class, 'destroy'])->name('products.destroy');

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
                'category' => $category->load('media'),
                'categories' => \App\Models\Category::where('is_active', true)->get(),
            ]);
        })->name('categories.edit');

        Route::get('categories/{category}', function (\App\Models\Category $category) {
            return Inertia::render('admin/categories/show', ['category' => $category->load('media')]);
        })->name('categories.show');

        // Category form handling
        Route::post('categories', [\App\Http\Controllers\AdminCategoryController::class, 'store'])->name('categories.store');
        Route::post('categories/{category}', [\App\Http\Controllers\AdminCategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/{category}', [\App\Http\Controllers\AdminCategoryController::class, 'destroy'])->name('categories.destroy');

        // Team Members
        Route::get('team-members', [\App\Http\Controllers\TeamMemberController::class, 'index'])->name('team-members.index');
        Route::get('team-members/create', [\App\Http\Controllers\TeamMemberController::class, 'create'])->name('team-members.create');
        Route::get('team-members/{teamMember}/edit', [\App\Http\Controllers\TeamMemberController::class, 'edit'])->name('team-members.edit');
        Route::get('team-members/{teamMember}', [\App\Http\Controllers\TeamMemberController::class, 'show'])->name('team-members.show');
        Route::post('team-members', [\App\Http\Controllers\TeamMemberController::class, 'store'])->name('team-members.store');
        Route::post('team-members/{teamMember}', [\App\Http\Controllers\TeamMemberController::class, 'update'])->name('team-members.update');
        Route::delete('team-members/{teamMember}', [\App\Http\Controllers\TeamMemberController::class, 'destroy'])->name('team-members.destroy');

        // Contact Inquiries
        Route::get('inquiries', function () {
            return Inertia::render('admin/inquiries/index', [
                'inquiries' => \App\Models\ContactInquiry::paginate(15),
            ]);
        })->name('inquiries.index');

        Route::get('inquiries/{inquiry}', function (\App\Models\ContactInquiry $inquiry) {
            return Inertia::render('admin/inquiries/show', [
                'inquiry' => $inquiry,
            ]);
        })->name('inquiries.show');

        // Inquiry form handling
        Route::post('inquiries/{inquiry}/reply', [\App\Http\Controllers\ContactInquiryAdminController::class, 'reply'])->name('inquiries.reply');
        Route::post('inquiries/{inquiry}/status', [\App\Http\Controllers\ContactInquiryAdminController::class, 'updateStatus'])->name('inquiries.update-status');

        // Contact Us
        Route::get('contact-us', function () {
            return Inertia::render('admin/contact-us/edit');
        })->name('contact-us.edit');

        Route::get('api/contact-us', [\App\Http\Controllers\Admin\AdminContactUsController::class, 'show'])->name('contact-us.show');
        Route::post('api/contact-us', [\App\Http\Controllers\Admin\AdminContactUsController::class, 'update'])->name('contact-us.update');

        // Environment Settings
        Route::get('settings/environment', function () {
            return Inertia::render('admin/settings/environment');
        })->name('settings.environment');

        // Orders
        Route::get('orders', [\App\Http\Controllers\AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [\App\Http\Controllers\AdminOrderController::class, 'show'])->name('orders.show');

        // Users (Customers)
        Route::get('users', [\App\Http\Controllers\AdminUserController::class, 'index'])->name('users.index');
        Route::get('users/create', [\App\Http\Controllers\AdminUserController::class, 'create'])->name('users.create');
        Route::post('users', [\App\Http\Controllers\AdminUserController::class, 'store'])->name('users.store');
        Route::get('users/{user}', [\App\Http\Controllers\AdminUserController::class, 'show'])->name('users.show');
        Route::get('users/{user}/edit', [\App\Http\Controllers\AdminUserController::class, 'edit'])->name('users.edit');
        Route::post('users/{user}', [\App\Http\Controllers\AdminUserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [\App\Http\Controllers\AdminUserController::class, 'destroy'])->name('users.destroy');
    });
});

require __DIR__.'/settings.php';
