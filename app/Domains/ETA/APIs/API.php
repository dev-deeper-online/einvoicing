<?php

namespace App\Domains\ETA\APIs;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class API
{
    protected string $baseURL = 'http://localhost:8020/api/v1/toolkit/';

    protected PendingRequest $http;

    public function __construct()
    {
        $this->http = Http::baseUrl($this->baseURL);

        $this->put('initialize', [
            'saveCredential' => true,
            'resumeWithInvalidCache' => false,
            'cachLookupDurationInHours' => 24,
            'maximumSubmissionDocumentCount' => 500,
        ]);
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
