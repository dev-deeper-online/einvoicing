<?php

namespace App\Domains\ETA\DTO;

class ItemData
{
    public function __construct(
        public string $internalCode,
        public string $description,
        public string $itemCode,
        public string $quantity,
        public string $unitPrice,
        public string $netSale,
        public string $totalSale,
        public string $total,
        public array $taxableItems,
        public string $itemType = 'EGS',
        public string $unitType = 'CS',
        public array $commercialDiscountData = [
            [
                'amount' => 0,
                'description' => 'Commercial Discount',
            ],
        ],
        public array $itemDiscountData = [],
        public string $valueDifference = '0',
    ) {
        //
    }
}
