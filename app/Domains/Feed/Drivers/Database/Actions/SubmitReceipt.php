<?php

namespace App\Domains\Feed\Drivers\Database\Actions;

use App\Domains\ETA;
use App\Domains\Feed\Drivers\Database\Models\Document;
use App\Domains\Feed\Drivers\Database\Models\DocumentItem;
use App\Domains\Receipt;

class SubmitReceipt
{
    /**
     * Submit the given document to the ETA.
     *
     * @param  Document  $document
     * @param  Receipt\Models\Receipt  $receipt
     * @return void
     *
     * @throws ETA\Exceptions\BadRequestException
     * @throws \JsonException
     */
    public static function handle(Document $document, Receipt\Models\Receipt $receipt): void
    {
        app(ETA\APIs\Receipt::class)->submit(
            static::getReceipt($document),
            fn ($response) => $receipt->saveResponse($response)
        );
    }

    /**
     * Creates a new Receipt DTO object from the given document.
     *
     * @param  Document  $document
     * @return ETA\DTO\Receipt
     */
    private static function getReceipt(Document $document): ETA\DTO\Receipt
    {
        $receipt = new ETA\DTO\Receipt(
            new ETA\DTO\Header(
                $document->post_date,
                $document->doc_no,
                '',
                ''
            ),
            new ETA\DTO\Seller(
                562415149,
                'coup',
                0,
                '13NQ9Z1',
                '4751',
                new ETA\DTO\Address(
                    'EG',
                    'cairo',
                    'el nozha',
                    'josef tito',
                    74,
                    11223,
                    4,
                    1,
                    1,
                    1
                )
            ),
            new ETA\DTO\Buyer(
                $document->bt_cuid,
                $document->bt_first_name,
            ),
            [
                $document->items->map(fn (DocumentItem $item) => new ETA\DTO\ItemData(
                    $item->sid,
                    $item->description1,
                    $item->inventory?->text6,
                    $item->qty,
                    $item->orig_price,
                    $item->orig_price,
                    $item->orig_price,
                    (string) ((int) $item->orig_price + (int) $item->orig_tax_amt),
                    [
                        [
                            'taxType' => 'T1',
                            'subType' => 'V009',
                            'amount' => $item->orig_tax_amt,
                            'rate' => $item->tax_perc,
                            'taxTypeName' => 'Value added Tax',
                            'taxTypeNameAr' => 'ضريبه القيمه المضافه',
                            'sign' => 1,
                            'exchangeRate' => 1,
                        ],
                    ]
                ))->toArray(),
            ],
            $document->sale_total_amt,
            $document->sale_total_amt,
            $document->sale_subtotal,
            'C',
            $document->total_discount_amt,
            $document->total_discount_amt,
            [[
                'amount' => $document->total_discount_amt, 'description' => 'ExtraDISC',
            ]],
            $document->total_fee_amt,
            [[
                'taxType' => 'T1',
                'amount' => $document->sale_total_tax_amt,
                'taxTypeName' => 'Value added Tax',
                'taxTypeNameAr' => 'ضريبه القيمه المضافه',
                'exchangeRate' => 1,
            ]],
        );

        $receipt->header->previousUUID = '89F8875315D17E52E1EDE0FCC59C0FD340439B0E30B2F8C51371490EF8D44A70';
        $receipt->header->uuid = hash_hmac('sha256', $receipt->signatures[0]['value'], $receipt->header->receiptNumber);

        return $receipt;
    }
}
