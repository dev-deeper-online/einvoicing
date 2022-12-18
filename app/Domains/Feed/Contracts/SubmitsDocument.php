<?php

namespace App\Domains\Feed\Contracts;

use App\Domains\ETA\Documents\Document as ETADocument;
use App\Domains\Feed\Drivers\Database\Models\Document as DatabaseDocumentModel;
use App\Domains\Receipt\Models\Receipt as ReceiptDomainModel;

abstract class SubmitsDocument
{
    /**
     * Creates a new Document DTO object from the given document.
     *
     * @param  mixed  $document
     * @return ETADocument
     */
    abstract protected static function buildDocumentFrom(mixed $document): ETADocument;

    /**
     * Submit the given document to the ETA.
     *
     * @param  DatabaseDocumentModel  $document
     * @param  ReceiptDomainModel  $receipt
     * @return void
     */
    public static function handle(mixed $document, ReceiptDomainModel $receipt): void
    {
        if (! empty($receipt->status)) {
            return;
        }

        static::buildDocumentFrom($document)->submit(
            static fn ($response, $doc) => $receipt->saveResponse($response)
        );
    }
}
