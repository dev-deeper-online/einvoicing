<?php

namespace App\Domains\ETA\APIs;

use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class API
{
    protected PendingRequest $http;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->http = Http::baseUrl($this->getBaseURL())->withHeaders([
            'posserial' => 'Test_SerialNo1',
            'pososversion' => 'IOS',
            'presharedkey' => config('eta.client_id'),
        ]);
    }

    public function initialize(): static
    {
        $response = $this->put('initialize', [
            'saveCredential' => true,
            'resumeWithInvalidCache' => true,
            'cachLookupDurationInHours' => 24,
            'maximumSubmissionDocumentCount' => 500,
        ])->json();

        if (isset($response['initialized']) && $response['initialized']) {
            $auth = (new Auth($this))->handle();

            $this->http = $this->http->withToken($auth['token']);

            $this->put('refreshcache');
        }

        return $this;
    }

    /**
     * @return string
     */
    protected function getBaseURL(): string
    {
        return sprintf('%s/api/v1/toolkit', config('eta.base_url'));
    }

    /**
     * Issue a POST request to the given URL.
     *
     * @param  string  $url
     * @param  array  $data
     * @return Response
     */
    public function post(string $url, array $data = []): Response
    {
        return $this->http->post($url, $data);
    }

    /**
     * Issue a PUT request to the given URL.
     *
     * @param  string  $url
     * @param  array  $data
     * @return Response
     */
    public function put(string $url, array $data = []): Response
    {
        return $this->http->put($url, $data);
    }
}
