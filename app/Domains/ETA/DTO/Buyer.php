<?php

namespace App\Domains\ETA\DTO;

class Buyer
{
    public function __construct(
        public ?string $buyerId = null,
        public ?string $buyerName = null,
    ) {
        //
    }
}
