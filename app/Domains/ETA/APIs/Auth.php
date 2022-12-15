<?php

namespace App\Domains\ETA\APIs;

use App\Domains\ETA\DTO;
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
     * @return DTO\Auth
     *
     * @throws BadRequestException
     */
    public function login(): DTO\Auth
    {
        $response = $this->asForm()
            ->post('/connect/token', [
                'grant_type' => 'client_credentials',
                'client_id' => config('eta.client_id'),
                'client_secret' => config('eta.client_secret'),
            ]);

        return new DTO\Auth(
            $response['access_token'],
            $response['token_type'],
            $response['expires_in'],
        );
    }
}
