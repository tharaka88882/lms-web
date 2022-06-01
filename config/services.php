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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'linkedin' => [
        'client_id' => '86wt5v09qa65ca',
        'client_secret' => 'Ldkc0Xn1pcJsusiY',
        'redirect' => 'https://login.you2mentor.com/auth/linkedin/callback',
    ],

    'facebook' => [
        'client_id' => '588100112737658',
        'client_secret' => 'f470d7e1243c730989ba07113706fc75',
        'redirect' => 'https://login.you2mentor.com/callback/facebook',
    ],

    'google' => [
        'client_id' => '713979367128-8r561eavrok9t0fm0t9kn13mjldi5kl1.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://login.you2mentor.com/callback/google',
    ],

];
