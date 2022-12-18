<?php

namespace App\Domains\ETA\APIs;

use App\Domains\ETA\APIs\Document as AbstractDocument;
use App\Domains\ETA\Documents\Document;
use App\Domains\ETA\Exceptions\BadRequestException;
use Closure;

class Receipt extends AbstractDocument
{
    /**
     * {@inheritdoc}
     *
     * @param  Document  $document
     * @param  Closure  $callback
     * @return void
     *
     * @throws BadRequestException
     */
    public function submit(Document $document, Closure $callback): void
    {
        $auth = app(Auth::class)->login();

        $doc = $document->toArray();
        $doc['header']['uuid'] = bin2hex($document->hashedSerialization());

        $response = $this->asJson()
            ->withToken($auth['access_token'], $auth['token_type'])
            ->post('/receiptsubmissions', [
                'receipts' => [$doc],
            ]);

        $callback($response);
    }
}
