<?php

namespace App\Domains\ETA\DTO;

class ItemData
{
    public function __construct(
        public string $internalCode,
        public string $description,
        public string $itemCode,
        public int $quantity,
        public float $unitPrice,
        public float $netSale,
        public float $totalSale,
        public float $total,
        public array $taxableItems,
        public string $itemType = 'EGS',
        public string $unitType = 'CS',
    ) {
        //
    }
}
