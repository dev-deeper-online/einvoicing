<?php

namespace App\Domains\ETA\DTO;

class Address
{
    public function __construct(
        public ?string $country = 'EG',
        public ?string $governate = 'cairo',
        public ?string $regionCity = null,
        public ?string $street = null,
        public ?string $buildingNumber = null,
        public ?string $postalCode = null,
        public ?string $floor = null,
        public ?string $room = null,
        public ?string $landmark = null,
        public ?string $additionalInformation = null,
    ) {
        //
    }
}
