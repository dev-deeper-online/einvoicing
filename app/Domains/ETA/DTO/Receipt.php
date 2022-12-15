<?php

namespace App\Domains\ETA\DTO;

use JsonException;

class Receipt
{
    /**
     * Document type name. Must be s for receipts.
     *
     * @var array
     */
    public array $documentType = [
        'receiptType' => 'SR',
        'typeVersion' => '1.2',
    ];

    /**
     * Structure containing one or two digital signatures. At least signature of the Issuer must be present. Signature of the Service provider is optional.
     *
     * @var Signature[]
     */
    public ?array $signatures = null;

    /**
     * @param  Header  $header
     * @param  array  $seller
     * @param  array  $buyer
     * @param  array  $itemData
     * @param  string  $totalSales
     * @param  string  $totalAmount
     * @param  string  $netAmount
     * @param  string  $paymentMethod
     * @param  string|null  $totalCommercialDiscount
     * @param  string|null  $totalItemsDiscount
     * @param  array|null  $extraReceiptDiscountData
     * @param  string|null  $feesAmount
     * @param  array|null  $taxTotals
     * @param  string|null  $adjustment
     * @param  array|null  $contractor
     * @param  array|null  $beneficiary
     *
     * @throws JsonException
     */
    public function __construct(
        public Header $header,
        public Seller $seller,
        public Buyer $buyer,
        public array $itemData,
        public string $totalSales,
        public string $totalAmount,
        public string $netAmount,
        public ?string $paymentMethod = 'C',
        public ?string $totalCommercialDiscount = null,
        public ?string $totalItemsDiscount = null,
        public ?array $extraReceiptDiscountData = null,
        public ?string $feesAmount = null,
        public ?array $taxTotals = [],
        public ?string $adjustment = null,
        public ?array $contractor = null,
        public ?array $beneficiary = null,
    ) {
        $this->signatures = [
            [
                'signatureType' => 'I',
                'value' => Signature::serialize($this->toArray()),
            ],
        ];
    }

    /**
     * Get the document as array.
     *
     * @return array
     *
     * @throws JsonException
     */
    public function toArray(): array
    {
        return json_decode(json_encode($this, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
    }
}
