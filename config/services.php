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
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
       'client_id' => '430459647843-3sddg0ppc0ks9a72oggd5gqgba4ck3du.apps.googleusercontent.com',
       'client_secret' => 'B8KP54ywlh23hoU8hY4M828-',
       'redirect' => 'https://ayojok.com/login/google/callback',
   ],

   'facebook' => [
       'client_id' => '1522119087932263',
       'client_secret' => 'dab5006761762d95f465818c2a94bdd4',
       'redirect' => 'https://ayojok.com/login/facebook/callback',
   ],

];
