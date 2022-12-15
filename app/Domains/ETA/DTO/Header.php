<?php

namespace App\Domains\ETA\DTO;

class Header
{
    public function __construct(
        public ?string $dateTimeIssued,
        public ?string $receiptNumber,
        public ?string $uuid,
        public ?string $previousUUID,
        public ?string $referenceOldUUID = null,
        public ?string $currency = 'EGP',
        public ?string $exchangeRate = null,
        public ?string $orderdeliveryMode = 'FC'
    ) {
        //
    }
}
