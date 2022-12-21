<?php

namespace App\Domains\ETA\Documents;

use App\Domains\ETA\Documents\Concerns\InteractsWithUUIDs;
use Closure;

class Receipt extends Document
{
    use InteractsWithUUIDs;

    /**
     * @var string|null
     */
    protected ?string $type = 'S';

    /**
     * @var string|null
     */
    protected ?string $version = '1.2';

    /**
     * {@inheritdoc}
     *
     * @return \App\Domains\ETA\APIs\Receipt
     */
    protected function submitAPIHandler(): \App\Domains\ETA\APIs\Receipt
    {
        return app(\App\Domains\ETA\APIs\Receipt::class);
    }

    /**
     * {@inheritdoc}
     *
     * @param  Closure  $callback
     * @return void
     */
    public function submit(Closure $callback): void
    {
        $uuid = $this->submitAPIHandler()->generateUUID($this);
        $this->setUuid($uuid);

        parent::submit($callback);
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
                'uuid' => $this->getUUID(),
                'previousUUID' => $this->getPreviousUUID(),
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
