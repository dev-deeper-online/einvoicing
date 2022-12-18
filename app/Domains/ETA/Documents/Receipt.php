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
                'previousUUID' => '89F8875315D17E52E1EDE0FCC59C0FD340439B0E30B2F8C51371490EF8D44A70',
                'currency' => 'EGP',
                'exchangeRate' => null,
                'orderdeliveryMode' => 'FC',
            ],
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
