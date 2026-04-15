<?php

namespace App\Providers;

use App\Models\Setting;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
        $this->loadSettingsFromDatabase();
    }

    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null
        );
    }

    protected function loadSettingsFromDatabase(): void
    {
        // 1. Safety Check:
        // Do not run during build (console) or if the table doesn't exist yet
        try {
            if (app()->runningInConsole() || !\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                return;
            }

            $settings = Setting::all()->pluck('value', 'key');

            if ($settings->isEmpty()) {
                return;
            }

            config([
                'paymob.base_url' => $settings['PAYMOB_BASE_URL'] ?? config('paymob.base_url'),
                'paymob.api_key' => $settings['PAYMOB_API_KEY'] ?? config('paymob.api_key'),
                'paymob.integration_id' => $settings['PAYMOB_INTEGRATION_ID'] ?? config('paymob.integration_id'),
                'paymob.iframe_id' => $settings['PAYMOB_IFRAME_ID'] ?? config('paymob.iframe_id'),
                'services.bosta.api_key' => $settings['BOSTA_API_KEY'] ?? config('services.bosta.api_key'),
                'services.bosta.base_url' => $settings['BOSTA_BASE_URL'] ?? config('services.bosta.base_url'),
                'mail.default' => $settings['MAIL_MAILER'] ?? config('mail.default'),
                'mail.mailers.smtp.host' => $settings['MAIL_HOST'] ?? config('mail.mailers.smtp.host'),
                'mail.mailers.smtp.port' => $settings['MAIL_PORT'] ?? config('mail.mailers.smtp.port'),
                'mail.mailers.smtp.username' => $settings['MAIL_USERNAME'] ?? config('mail.mailers.smtp.username'),
                'mail.mailers.smtp.password' => $settings['MAIL_PASSWORD'] ?? config('mail.mailers.smtp.password'),
                'mail.from.address' => $settings['MAIL_FROM_ADDRESS'] ?? config('mail.from.address'),
                'mail.from.name' => $settings['MAIL_FROM_NAME'] ?? config('mail.from.name'),
                'app.frontend_url' => $settings['FRONTEND_URL'] ?? config('app.frontend_url'),
                'services.whatsapp.account_sid' => $settings['WHATSAPP_ACCOUNT_SID'] ?? config('services.whatsapp.account_sid'),
                'services.whatsapp.auth_token' => $settings['WHATSAPP_AUTH_TOKEN'] ?? config('services.whatsapp.auth_token'),
                'services.whatsapp.phone_number' => $settings['WHATSAPP_PHONE_NUMBER'] ?? config('services.whatsapp.phone_number'),
                'services.whatsapp.api_key' => $settings['WHATSAPP_API_KEY'] ?? config('services.whatsapp.api_key'),
                'services.whatsapp.phone_number_id' => $settings['WHATSAPP_PHONE_NUMBER_ID'] ?? config('services.whatsapp.phone_number_id'),
                'services.whatsapp.base_url' => $settings['WHATSAPP_BASE_URL'] ?? config('services.whatsapp.base_url'),
            ]);
        } catch (\Exception $e) {
            // Silently fail during build/boot if DB is unreachable
            return;
        }
    }
}
