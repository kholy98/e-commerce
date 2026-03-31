<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'bosta' => [
        'api_key' => env('BOSTA_API_KEY'),
        'base_url' => env('BOSTA_BASE_URL', 'https://stg-app.bosta.co'),
    ],

    'whatsapp' => [
        // Provider preference: 'twilio' or 'meta' (auto-detects if not set)
        'provider' => env('WHATSAPP_PROVIDER', 'auto'),
        // Twilio Configuration
        'account_sid' => env('WHATSAPP_ACCOUNT_SID'),
        'auth_token' => env('WHATSAPP_AUTH_TOKEN'),
        'phone_number' => env('WHATSAPP_PHONE_NUMBER'),
        // Meta/WhatsApp Business API Configuration
        'api_key' => env('WHATSAPP_API_KEY'),
        'phone_number_id' => env('WHATSAPP_PHONE_NUMBER_ID'),
        'base_url' => env('WHATSAPP_BASE_URL', 'https://graph.facebook.com/v18.0'),
    ],

];
