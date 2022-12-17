<?php

namespace App\Domains\ETA\APIs;

use App\Domains\ETA\Exceptions\BadRequestException;

class Auth extends API
{
    /**
     * The base url of the ETA system apis.
     *
     * @var string
     */
    protected string $baseUrl = 'https://id.eta.gov.eg';

    /**
     * Login given client id and secret.
     *
     * @return array
     *
     * @throws BadRequestException
     */
    public function login(): array
    {
        $response = $this->asForm()
            ->post('/connect/token', [
                'grant_type' => 'client_credentials',
                'client_id' => config('eta.client_id'),
                'client_secret' => config('eta.client_secret'),
            ]);

        return [
            'access_token' => $response['access_token'],
            'token_type' => $response['token_type'],
            'expires_in' => $response['expires_in'],
        ];
    }
}
