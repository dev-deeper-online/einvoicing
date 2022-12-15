<?php

namespace App\Domains\ETA\APIs;

use App\Domains\ETA\Exceptions\BadRequestException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

abstract class API
{
    /**
     * Get the Http client.
     *
     * @var PendingRequest
     */
    protected PendingRequest $http;

    /**
     * The base url of the ETA system apis.
     *
     * @var string
     */
    protected string $baseUrl = 'https://api.invoicing.eta.gov.eg/api/v1';

    /**
     * API construct.
     */
    public function __construct()
    {
        $this->http = Http::baseUrl($this->getBaseUrl());
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        $env = config('eta.environment', 'preprod');

        return match ($env) {
            'preprod' => str_replace([
                'https://api.',
                'https://id.',
            ], [
                'https://api.preprod.',
                'https://id.preprod.',
            ], $this->baseUrl),
            default => $this->baseUrl
        };
    }

    /**
     * Indicate the request contains form parameters.
     *
     * @return $this
     */
    protected function asForm(): static
    {
        $this->http = $this->http->asForm();

        return $this;
    }

    /**
     * Indicate the request contains JSON.
     *
     * @return $this
     */
    public function asJson(): static
    {
        $this->http = $this->http->asJson();

        return $this;
    }

    /**
     * Specify an authorization token for the request.
     *
     * @param  string  $token
     * @param  string  $type
     * @return $this
     */
    public function withToken(string $token, string $type = 'Bearer'): static
    {
        $this->http = $this->http->withToken($token, $type);

        return $this;
    }

    /**
     * Issue a POST request to the given URL.
     *
     * @param  string  $url
     * @param  array  $data
     * @return array|null
     *
     * @throws BadRequestException
     */
    protected function post(string $url, array $data = []): ?array
    {
        $response = $this->http
            ->post($url, $data)
            ->json();

        $this->handleError($response);

        return $response;
    }

    /**
     * Handle upcoming exceptions from ETA.
     *
     * @param  array|null  $response
     * @return void
     *
     * @throws BadRequestException
     */
    protected function handleError(?array $response): void
    {
        if (blank($response) || isset($response['error'])) {
            throw new BadRequestException($response['error_description'] ?? $response['error'] ?? 'Fatal error occurred');
        }
    }
}
