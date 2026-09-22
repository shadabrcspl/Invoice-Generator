<?php

use Illuminate\Support\Str;

return [
    'driver'          => env('SESSION_DRIVER', 'file'),
    'lifetime'        => env('SESSION_LIFETIME', 120),
    'expire_on_close' => false,
    // SEC-05: Encrypt session data at rest using the app key
    'encrypt'         => true,
    'files'           => storage_path('framework/sessions'),
    'connection'      => env('SESSION_CONNECTION'),
    'table'           => 'sessions',
    'store'           => env('SESSION_STORE'),
    'lottery'         => [2, 100],
    'cookie'          => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_').'_session'
    ),
    'path'            => '/',
    'domain'          => env('SESSION_DOMAIN'),
    // SEC-04: Force HTTPS-only cookie (never sent over HTTP)
    'secure'          => env('SESSION_SECURE_COOKIE', true),
    'http_only'       => true,
    // SEC-13: Use 'strict' to prevent cookie from being sent on cross-site navigation
    'same_site'       => 'strict',
];
