<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'twilio' => [
        'mode' => env('TWILIO_MODE', 'test'),
        'test_auth_token' => env('TWILIO_TEST_AUTH_TOKEN'),
        'test_account_sid' => env('TWILIO_TEST_ACCOUNT_SID'),
        'test_from' => env('TWILIO_TEST_FROM'),
        'live_auth_token' => env('TWILIO_LIVE_AUTH_TOKEN'),
        'live_account_sid' => env('TWILIO_LIVE_ACCOUNT_SID'),
        'live_from' => env('TWILIO_LIVE_FROM'),
    ],

    'stripe' => [
        'model' => App\Models\HealthInstitution::class,
        'mode' => env('STRIPE_MODE'),
        'test_key' => env('STRIPE_TEST_KEY'),
        'test_secret' => env('STRIPE_TEST_SECRET'),
        'live_key' => env('STRIPE_LIVE_KEY'),
        'live_secret' => env('STRIPE_LIVE_SECRET'),
        // 'webhook' => [
        //     'secret' => env('STRIPE_WEBHOOK_SECRET'),
        //     'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        // ],
    ],

];
