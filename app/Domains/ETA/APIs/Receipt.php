<?php

namespace App\Domains\ETA\APIs;

use Closure;

class Receipt extends Document
{
    public function generateUUID(\App\Domains\ETA\Documents\Document $receipt): string
    {
        $response = $this->http->post('uuid', $receipt->toArray())->json();

        logger('generate uuid', $response);

        return $response['uuid'];
    }

    public function submit(\App\Domains\ETA\Documents\Document $receipt, Closure $callback): void
    {
        $response = $this->http->post('receipt', $receipt->toArray())->json();

        logger('submit', $response);

        $callback($response);
    }
}
