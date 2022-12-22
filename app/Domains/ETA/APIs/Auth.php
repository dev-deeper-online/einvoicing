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
        $response = $this->http->post('connect/token', [
            'clientId' => config('eta.client_id'),
            'clientSecret' => config('eta.client_secret'),
            'posSerial' => '13NQ9Z1',
        ])->json();

        logger('Login', $response);

        return $response;
    }
}
