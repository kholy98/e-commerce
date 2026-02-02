<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\ConfirmedTwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController;
use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
use Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController;

/**
 * These routes expose Fortify controllers to Wayfinder for TypeScript generation.
 * They mirror the actual Fortify routes registered in the service provider.
 */

// Home route for Wayfinder generation
Route::get('/', function () {
    return Inertia::render('welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Two-Factor Authentication
    Route::post('user/two-factor-authentication', [TwoFactorAuthenticationController::class, 'store'])
        ->name('two-factor.enable');

    Route::delete('user/two-factor-authentication', [TwoFactorAuthenticationController::class, 'destroy'])
        ->name('two-factor.disable');

    Route::post('user/confirmed-two-factor-authentication', [ConfirmedTwoFactorAuthenticationController::class, 'store'])
        ->name('two-factor.confirm');

    Route::get('user/two-factor-qr-code', [TwoFactorQrCodeController::class, 'show'])
        ->name('two-factor.qr-code');

    Route::get('user/two-factor-recovery-codes', [RecoveryCodeController::class, 'index'])
        ->name('two-factor.recovery-codes');

    Route::post('user/two-factor-recovery-codes', [RecoveryCodeController::class, 'store'])
        ->name('two-factor.regenerate-recovery-codes');

    Route::get('user/two-factor-secret-key', [TwoFactorSecretKeyController::class, 'show'])
        ->name('two-factor.secret-key');
});
