<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Limit to API endpoints (better security)

    'allowed_methods' => ['*'], // Allow all HTTP methods (GET, POST, etc.)

    'allowed_origins' => [
        'https://frontend.bhccare.com.au', // Next.js frontend
        'https://bhccare.com.au',      // Core PHP via XAMPP or Apache
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Allow all headers

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false, // Set to true only if you're using cookies/auth with frontend

];
