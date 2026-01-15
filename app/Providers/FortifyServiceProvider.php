<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Laravel\Fortify\Contracts\ConfirmPasswordViewResponse;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\RegisterViewResponse;
use Laravel\Fortify\Contracts\RequestPasswordResetLinkViewResponse;
use Laravel\Fortify\Contracts\ResetPasswordViewResponse;
use Laravel\Fortify\Contracts\TwoFactorChallengeViewResponse;
use Laravel\Fortify\Contracts\VerifyEmailViewResponse;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Route;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LoginViewResponse::class, function () {
            return new class implements LoginViewResponse {
                public function toResponse($request)
                {
                    return Inertia::render('auth/login', [
                        'canResetPassword' => Features::enabled(Features::resetPasswords()),
                        'canRegister' => Features::enabled(Features::registration()),
                        'status' => $request->session()->get('status'),
                    ]);
                }
            };
        });

        $this->app->singleton(RegisterViewResponse::class, function () {
            return new class implements RegisterViewResponse {
                public function toResponse($request)
                {
                    return Inertia::render('auth/register');
                }
            };
        });

        $this->app->singleton(RequestPasswordResetLinkViewResponse::class, function () {
            return new class implements RequestPasswordResetLinkViewResponse {
                public function toResponse($request)
                {
                    return Inertia::render('auth/forgot-password', [
                        'status' => $request->session()->get('status'),
                    ]);
                }
            };
        });

        $this->app->singleton(ResetPasswordViewResponse::class, function () {
            return new class implements ResetPasswordViewResponse {
                public function toResponse($request)
                {
                    return Inertia::render('auth/reset-password', [
                        'email' => $request->input('email'),
                        'token' => $request->route('token'),
                    ]);
                }
            };
        });

        $this->app->singleton(VerifyEmailViewResponse::class, function () {
            return new class implements VerifyEmailViewResponse {
                public function toResponse($request)
                {
                    return Inertia::render('auth/verify-email', [
                        'status' => $request->session()->get('status'),
                    ]);
                }
            };
        });

        $this->app->singleton(TwoFactorChallengeViewResponse::class, function () {
            return new class implements TwoFactorChallengeViewResponse {
                public function toResponse($request)
                {
                    return Inertia::render('auth/two-factor-challenge');
                }
            };
        });

        $this->app->singleton(ConfirmPasswordViewResponse::class, function () {
            return new class implements ConfirmPasswordViewResponse {
                public function toResponse($request)
                {
                    return Inertia::render('auth/confirm-password');
                }
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureActions();
        $this->configureRateLimiting();
        $this->registerRoutes();
    }

    /**
     * Configure Fortify actions.
     */
    private function configureActions(): void
    {
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::createUsersUsing(CreateNewUser::class);
    }



    /**
     * Configure rate limiting.
     */
    private function configureRateLimiting(): void
    {
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });
    }

    /**
     * Register routes.
     */
    private function registerRoutes(): void
    {
        Route::middleware(['web', 'guest'])->group(function () {
            Route::get('login', function (Request $request) {
                return app(LoginViewResponse::class)->toResponse($request);
            })->name('login');

            if (Features::enabled(Features::registration())) {
                Route::get('register', function () {
                    return app(RegisterViewResponse::class)->toResponse(request());
                })->name('register');
            }

            if (Features::enabled(Features::resetPasswords())) {
                Route::get('forgot-password', function (Request $request) {
                    return app(RequestPasswordResetLinkViewResponse::class)->toResponse($request);
                })->name('password.request');

                Route::get('reset-password/{token}', function (Request $request) {
                    return app(ResetPasswordViewResponse::class)->toResponse($request);
                })->name('password.reset');
            }

            if (Features::enabled(Features::twoFactorAuthentication())) {
                Route::get('two-factor-challenge', function () {
                    return app(TwoFactorChallengeViewResponse::class)->toResponse(request());
                })->name('two-factor.login');
            }
        });

        Route::middleware(['web', 'auth'])->group(function () {
            Route::get('user/confirm-password', function () {
                return app(ConfirmPasswordViewResponse::class)->toResponse(request());
            })->name('password.confirm');
        });

        if (Features::enabled(Features::emailVerification())) {
            Route::middleware(['web', 'auth'])->group(function () {
                Route::get('email/verify', function (Request $request) {
                    return app(VerifyEmailViewResponse::class)->toResponse($request);
                })->name('verification.notice');
            });
        }
    }
}
