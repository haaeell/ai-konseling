<?php

return [
    'api_key' => env('OPENROUTER_API_KEY'),
    'model' => env('OPENROUTER_MODEL', 'openrouter/free'),
    'site_url' => env('OPENROUTER_SITE_URL', 'http://127.0.0.1:8000'),
    'app_name' => env('OPENROUTER_APP_NAME', 'AI Konseling'),
];
