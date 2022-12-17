<?php

return [
    'driver' => env('ETA_DRIVER', 'receipt'),

    'environment' => env('ETA_ENVIRONMENT', 'preprod'),

    'client_id' => env('ETA_CLIENT_ID'),

    'client_secret' => env('ETA_CLIENT_SECRET'),
];
