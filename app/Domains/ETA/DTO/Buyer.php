<?php

namespace App\Domains\ETA\DTO;

class Buyer
{
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $type = 'P',
    ) {
        //
    }
}
