<?php

namespace App\Domains\ETA\APIs;

use App\Domains\ETA\APIs\Document as AbstractDocument;
use App\Domains\ETA\Documents\Document;
use App\Domains\ETA\Exceptions\BadRequestException;
use Closure;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

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
     * @throws \JsonException
     */
    public function submit(Document $document, Closure $callback): void
    {
        $auth = app(Auth::class)->login();

        File::put(
            storage_path('app/temp/SourceDocumentJson.json'),
            json_encode($document->toArray(), JSON_THROW_ON_ERROR)
        );

        Artisan::call('document:sign');

        $uuid = File::get(storage_path('app/temp/Cades.txt'));

        $doc = $document->toArray();
        $doc['header']['uuid'] = $uuid;

        $response = $this->asJson()
            ->withToken($auth->access_token, $auth->token_type)
            ->post('/receiptsubmissions', [
                'receipts' => [$doc],
                'signatures' => [[
                    'type' => 'I',
                    'value' => File::get(storage_path('app/temp/CanonicalString.txt')),
                ]],
            ]);

        $callback($response);
    }
}
