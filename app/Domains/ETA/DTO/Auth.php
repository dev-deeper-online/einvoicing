<?php

namespace App\Domains\ETA\DTO;

class Auth
{
    /**
     * @param  string  $access_token
     * @param  string  $token_type
     * @param  string  $expires_in
     */
    public function __construct(
        public string $access_token,
        public string $token_type,
        public string $expires_in
    ) {
        //
    }
}
