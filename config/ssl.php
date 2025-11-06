<?php

return [
    /*
    |--------------------------------------------------------------------------
    | SSL/TLS Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains configuration options for SSL/TLS encryption.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Force HTTPS
    |--------------------------------------------------------------------------
    |
    | When enabled, the application will force all requests to use HTTPS.
    | This is recommended for production environments.
    |
    */

    'force_https' => env('FORCE_HTTPS', true),

    /*
    |--------------------------------------------------------------------------
    | Secure Cookies
    |--------------------------------------------------------------------------
    |
    | When enabled, cookies will only be sent over HTTPS connections.
    | This is required for secure session handling.
    |
    */

    'secure_cookies' => env('SECURE_COOKIES', true),

    /*
    |--------------------------------------------------------------------------
    | HSTS (HTTP Strict Transport Security)
    |--------------------------------------------------------------------------
    |
    | HSTS header max age in seconds. Set to 0 to disable.
    | Recommended: 31536000 (1 year)
    |
    */

    'hsts_max_age' => env('HSTS_MAX_AGE', 31536000),

    /*
    |--------------------------------------------------------------------------
    | Certificate Path
    |--------------------------------------------------------------------------
    |
    | Path to SSL certificate files (for custom certificates).
    | Leave null to use system default.
    |
    */

    'cert_path' => env('SSL_CERT_PATH', null),
    'key_path' => env('SSL_KEY_PATH', null),
];

