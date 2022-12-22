<?php

namespace App\Domains\ETA\APIs;

use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class API
{
    protected PendingRequest $http;

    protected bool $initialized = false;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->http = Http::baseUrl($this->getBaseURL());

        $this->initialize();
    }

    /**
     * @return string
     */
    protected function getBaseURL(): string
    {
        return sprintf('%s/api/v1/toolkit', config('eta.base_url'));
    }

    /**
     * @throws Exception
     */
    protected function initialize(): void
    {
        if ($this->initialized) {
            return;
        }

        $response = $this->put('initialize', [
            'saveCredential' => true,
            'resumeWithInvalidCache' => true,
            'cachLookupDurationInHours' => 24,
            'maximumSubmissionDocumentCount' => 500,
        ])->json();

        logger('initialize', $response);

        if (isset($response['initialized']) && $response['initialized']) {
            $this->initialized = $response['initialized'];

            $response = $this->put('refreshcache')->json();
            logger('refreshcache', $response);

            (new Auth($this))->handle();
        }
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
