<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ConfigController extends Controller
{
    public function updateEnv(Request $request)
    {
        // 1. Validate input
        $data = $request->validate([
            'PAYMOB_BASE_URL' => 'sometimes|url',
            'PAYMOB_API_KEY' => 'sometimes|string',
            'PAYMOB_INTEGRATION_ID' => 'sometimes|numeric',
            'PAYMOB_IFRAME_ID' => 'sometimes|numeric',
            'BOSTA_API_KEY' => 'sometimes|string',
            'BOSTA_BASE_URL' => 'sometimes|url',
            'MAIL_MAILER' => 'sometimes|string',
            'MAIL_SCHEME' => 'sometimes|string|nullable',
            'MAIL_HOST' => 'sometimes|string',
            'MAIL_PORT' => 'sometimes|numeric',
            'MAIL_USERNAME' => 'sometimes|string',
            'MAIL_PASSWORD' => 'sometimes|string',
            'MAIL_FROM_ADDRESS' => 'sometimes|email',
            'MAIL_FROM_NAME' => 'sometimes|string',
            'FRONTEND_URL' => 'sometimes|string',
            'WHATSAPP_PROVIDER' => 'sometimes|string',
            'WHATSAPP_ACCOUNT_SID' => 'sometimes|string',
            'WHATSAPP_AUTH_TOKEN' => 'sometimes|string',
            'WHATSAPP_PHONE_NUMBER' => 'sometimes|string',
        ]);

        // $path = base_path('.env');

        // if (!File::exists($path)) {
        //     return response()->json(['error' => '.env file not found'], 404);
        // }

        try {
            // $content = File::get($path);

            foreach ($data as $key => $value) {
                \App\Models\Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }

            $updatedSettings = \App\Models\Setting::whereIn('key', array_keys($data))->pluck('value', 'key');

            Artisan::call('config:clear');

            return response()->json([
                'message' => 'Settings updated successfully.',
                'updated' => $updatedSettings,
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showEnvStatus()
    {
        try {
            // 1. Fetch all settings currently stored in the database
            // This shows what the user has saved via your dashboard
            $dbSettings = \App\Models\Setting::all()->pluck('value', 'key');

            // 2. Prepare the active configuration values
            // Note: We use config() here, NOT env(), because config()
            // includes the overrides we set in AppServiceProvider.
            $activeConfig = [
                'PAYMOB_BASE_URL' => config('paymob.base_url'),
                'PAYMOB_API_KEY' => config('paymob.api_key'),
                'PAYMOB_INTEGRATION_ID' => config('paymob.integration_id'),
                'PAYMOB_IFRAME_ID' => config('paymob.iframe_id'),
                'BOSTA_API_KEY' => config('services.bosta.api_key'),
                'BOSTA_BASE_URL' => config('services.bosta.base_url'),
                'MAIL_MAILER' => config('mail.default'),
                'MAIL_HOST' => config('mail.mailers.smtp.host'),
                'MAIL_PORT' => config('mail.mailers.smtp.port'),
                'MAIL_USERNAME' => config('mail.mailers.smtp.username'),
                'MAIL_PASSWORD' => config('mail.mailers.smtp.password'),
                'MAIL_FROM_ADDRESS' => config('mail.from.address'),
                'MAIL_FROM_NAME' => config('mail.from.name'),
                'FRONTEND_URL' => config('app.frontend_url'),
                'WHATSAPP_PROVIDER' => \App\Models\Setting::get('WHATSAPP_PROVIDER', 'auto'),
                'WHATSAPP_ACCOUNT_SID' => config('services.whatsapp.account_sid'),
                'WHATSAPP_AUTH_TOKEN' => config('services.whatsapp.auth_token'),
                'WHATSAPP_PHONE_NUMBER' => config('services.whatsapp.phone_number'),
            ];

            return response()->json([
                'status' => 'success',
                'meta' => [
                    'config_cached' => app()->configurationIsCached(),
                    'timezone' => config('app.timezone'),
                    'environment' => app()->environment(),
                ],
                'database_settings' => $dbSettings,
                'laravel_active_values' => $dbSettings,
                'info' => 'If active values do not match database settings, ensure AppServiceProvider is mapping them and run artisan config:clear.',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
