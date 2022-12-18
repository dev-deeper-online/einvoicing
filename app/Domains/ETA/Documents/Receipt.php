<?php

namespace App\Domains\ETA\Documents;

class Receipt extends Document
{
    /**
     * @var string|null
     */
    protected ?string $type = 'S';

    /**
     * @var string|null
     */
    protected ?string $version = '1.2';

    protected function submitAPIHandler(): \App\Domains\ETA\APIs\Receipt
    {
        return app(\App\Domains\ETA\APIs\Receipt::class);
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'header' => [
                'dateTimeIssued' => $this->getDate()?->toDateTimeLocalString(),
                'receiptNumber' => $this->getBranchCode().'_'.$this->getId(),
                'uuid' => null,
                'previousUUID' => '',
                'currency' => 'EGP',
                'exchangeRate' => 1,
                'orderdeliveryMode' => 'FC',
            ],
            'documentTypeVersion' => $this->getVersion(),
            'documentType' => [
                'receiptType' => $this->getType(),
                'typeVersion' => $this->getVersion(),
            ],
            'seller' => $this->getSeller(),
            'buyer' => [
                'type' => 'P',
                'id' => $this->getCustomerId(),
                'name' => $this->getCustomerName(),
            ],
            'itemData' => $this->getItems(),
            'totalSales' => $this->getSalesTotalAmount(),
            'totalAmount' => $this->getTotalAmount(),
            'netAmount' => $this->getSalesSubtotal(),
            'feesAmount' => 0,
            'paymentMethod' => 'C',
            'extraReceiptDiscountData' => [[
                'amount' => $this->getTotalDiscountAmount(), 'description' => 'ExtraDISC',
            ]],
        ];
    }
}
