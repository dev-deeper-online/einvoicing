<?php

namespace App\Domains\ETA\DTO;

class Seller
{
    public function __construct(
        public string $rin,
        public ?string $companyTradeName = null,
        public ?string $branchCode = '0',
        public ?string $deviceSerialNumber = '13NQ9Z1',
        public ?string $activityCode = '4751',
        public ?Address $branchAddress = null
    ) {
        //
    }
}
