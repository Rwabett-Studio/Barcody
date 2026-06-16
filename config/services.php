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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'stripe' => [
        'key'      => env('STRIPE_KEY'),
        'secret'   => env('STRIPE_SECRET'),
        'webhook'  => env('STRIPE_WEBHOOK_SECRET'),
        'currency' => env('STRIPE_CURRENCY', 'usd'),
    ],

    'chatberry' => [
        'token'      => env('WHATSAPP_API_TOKEN'),
        'base_url'   => env('CHATBERRY_BASE_URL', 'https://app.chatberry.net/api/wpbox'),
        'otp_template'       => env('CHATBERRY_OTP_TEMPLATE'),          // optional approved OTP template
        'invite_template'    => env('CHATBERRY_INVITE_TEMPLATE', 'waled_text'),
        'invite_image'       => env('CHATBERRY_INVITE_IMAGE', 'https://onsyntax.com/front-end/img/hero_mob.png'),
        'template_language'  => env('CHATBERRY_TEMPLATE_LANG', 'ar'),
        'timeout'    => (int) env('CHATBERRY_TIMEOUT', 30),
        'verify_ssl' => filter_var(env('CHATBERRY_VERIFY_SSL', false), FILTER_VALIDATE_BOOLEAN),
    ],

];
