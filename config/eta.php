<?php

return [
    'driver' => env('ETA_DRIVER', 'receipt'),

    'base_url' => env('ETA_BASE_URL', 'http://localhost:8020'),

    'environment' => env('ETA_ENVIRONMENT', 'preprod'),

    'client_id' => env('ETA_CLIENT_ID'),

    'client_secret' => env('ETA_CLIENT_SECRET'),
];
