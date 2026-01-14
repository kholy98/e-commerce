<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class EnvService
{
    public function updateKeys(array $data)
    {
        $path = base_path('.env');

        if (!File::exists($path)) {
            return false;
        }

        $content = File::get($path);

        foreach ($data as $key => $value) {
            // Check if the key exists
            if (preg_match("/^{$key}=/m", $content)) {
                // Update existing key
                $content = preg_replace("/^{$key}=.*/m", "{$key}=\"{$value}\"", $content);
            } else {
                // Append new key if it doesn't exist
                $content .= "\n{$key}=\"{$value}\"";
            }
        }

        File::put($path, $content);
        return true;
    }
}
