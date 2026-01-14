<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class ConfigController extends Controller
{

    public function updateEnv(Request $request)
    {
        // 1. Validate input
        $data = $request->validate([
            'PAYMOB_BASE_URL'       => 'sometimes|url',
            'PAYMOB_API_KEY'        => 'sometimes|string',
            'PAYMOB_INTEGRATION_ID' => 'sometimes|numeric',
            'PAYMOB_IFRAME_ID'      => 'sometimes|numeric',
            'BOSTA_API_KEY'         => 'sometimes|string',
            'BOSTA_BASE_URL'        => 'sometimes|url',
        ]);

        $path = base_path('.env');

        if (!File::exists($path)) {
            return response()->json(['error' => '.env file not found'], 404);
        }

        try {
            $content = File::get($path);

            foreach ($data as $key => $value) {
                // Find line starting with KEY=
                if (preg_match("/^{$key}=.*/m", $content)) {
                    // Replace with KEY=VALUE (No quotes)
                    $content = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $content);
                } else {
                    // Append if not found
                    $content .= "\n{$key}={$value}";
                }
            }

            // Write the "Raw" content back to the file
            File::put($path, $content);

            // Clear cache so Laravel uses the new physical file values
            Artisan::call('config:clear');

            return response()->json([
                'message' => 'File updated successfully without quotes.',
                'preview' => "Check your .env file for: " . array_key_first($data)
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showEnvStatus()
    {
        $path = base_path('.env');

        // 1. Check physical file status
        $fileExists = File::exists($path);
        $isWritable = is_writable($path);

        // 2. Read raw content from the file
        $rawContent = $fileExists ? File::get($path) : 'File not found';

        return response()->json([
            'status' => [
                'file_path' => $path,
                'is_writable' => $isWritable,
                'config_cached' => app()->configurationIsCached(),
            ],
            //'env_file_raw' => $rawContent,
            'laravel_active_values' => [
                'PAYMOB_BASE_URL' => env('PAYMOB_BASE_URL'),
                'PAYMOB_API_KEY' => env('PAYMOB_API_KEY'),
                'BOSTA_API_KEY' => env('BOSTA_API_KEY'),
            ]
        ]);
    }
}
