<?php

return [
    'driver' => env('FEEDER_DRIVER', 'database'),

    'drivers' => [
        'database' => [
            'connection' => env('FEEDER_DATABASE_CONNECTION', env('DB_CONNECTION')),
        ],
    ],
];
