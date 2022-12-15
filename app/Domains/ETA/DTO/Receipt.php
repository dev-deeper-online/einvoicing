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
    protected ?array $signatures = null;

    /**
     * @param  Header  $header
     * @param  Seller  $seller
     * @param  Buyer  $buyer
     * @param  array  $itemData
     * @param  float  $totalSales
     * @param  float  $totalAmount
     * @param  float  $netAmount
     * @param  string|null  $paymentMethod
     * @param  array|null  $extraReceiptDiscountData
     * @param  float|null  $feesAmount
     *
     * @throws JsonException
     */
    public function __construct(
        public Header $header,
        public Seller $seller,
        public Buyer $buyer,
        public array $itemData,
        public float $totalSales,
        public float $totalAmount,
        public float $netAmount,
        public ?string $paymentMethod = 'C',
        public ?array $extraReceiptDiscountData = null,
        public ?float $feesAmount = null,
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

    /**
     * Get Document signatures.
     *
     * @return Signature[]
     */
    public function getSignatures(): array
    {
        return $this->signatures;
    }
}
