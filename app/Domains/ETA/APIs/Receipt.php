<?php

namespace App\Domains\ETA\APIs;

use Closure;

class Receipt extends Document
{
    public function generateUUID(\App\Domains\ETA\Documents\Document $receipt): string
    {
        $response = $this->post('uuid', $receipt->toArray())->json();

        return $response['uuid'];
    }

    public function submit(\App\Domains\ETA\Documents\Document $receipt, Closure $callback): void
    {
        $response = $this->post('receipt', $receipt->toArray())->json();

        $callback($response);
    }
}
