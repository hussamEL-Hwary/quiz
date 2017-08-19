<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'github' => [
    'client_id' => 'dde5547077afcaf34ad5',
    'client_secret' => '043d6da4faeef879e7864fc8b7106c184268ee04',
    'redirect' => 'http://localhost:8000/login/github/check',
    ],

    'facebook' => [
    'client_id' => '113079409320606',
    'client_secret' => '8bfafdf553de96ca536070d1523a3742',
    'redirect' => 'http://localhost:8000/login/facebook/check',
    ],

    'instagram' => [
    'client_id' => '94697aee94c342b3a4d3382e8373364f',
    'client_secret' => '1385dd60711f43fdb789c8260ab5f1c3',
    'redirect' => 'http://localhost:8000/login/instagram/check',
    ],

    'google' => [
    'client_id' => '314240770116-e9mu89eej4easg136m2b9q1nmueiqv21.apps.googleusercontent.com',
    'client_secret' => '1RoYGoD-plsIu7bLVwmYrEbB',
    'redirect' => 'http://localhost:8000/login/google/check',
    ],

    'twitter' => [
    'client_id' => 'your-github-app-id',
    'client_secret' => 'your-github-app-secret',
    'redirect' => 'http://localhost:8000/login/instagram/check',
    ],
];
