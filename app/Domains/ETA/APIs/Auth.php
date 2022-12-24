<?php

namespace App\Domains\ETA\APIs;

class Auth
{
    public function __construct(
        protected API $http
    ) {
        //
    }

    /**
     * Handle the request.
     *
     * @return array
     */
    public function handle(): array
    {
        return $this->http->post('connect/token', [
            'clientId' => config('eta.client_id'),
            'clientSecret' => config('eta.client_secret'),
        ])->json();
    }
}
