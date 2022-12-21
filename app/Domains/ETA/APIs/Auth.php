<?php

namespace App\Domains\ETA\APIs;

class Auth extends API
{
    public function handle(): array
    {
        return $this->post('connect/token', [
            'clientId' => config('eta.client_id'),
            'clientSecret' => config('eta.client_secret'),
        ])->json();
    }
}
