<?php

namespace App\Domains\Feed\Drivers\Database\Actions;

use App\Domains\ETA;
use App\Domains\Feed\Drivers\Database\Models\Document;
use App\Domains\Feed\Drivers\Database\Models\DocumentItem;
use App\Domains\Receipt;
use Illuminate\Support\Carbon;

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
     *
     * @throws \JsonException
     */
    private static function getReceipt(Document $document): ETA\DTO\Receipt
    {
        $receipt = new ETA\DTO\Receipt(
            new ETA\DTO\Header(
                Carbon::parse($document->post_date)->toDateTimeLocalString(),
                $document->doc_no ?? '',
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
                    (int) $item->qty,
                    (float) $item->orig_price,
                    (float) $item->orig_price,
                    (float) $item->orig_price,
                    (float) $item->orig_price + (float) $item->orig_tax_amt,
                    [
                        [
                            'taxType' => 'T1',
                            'subType' => 'V009',
                            'amount' => (float) $item->orig_tax_amt,
                            'rate' => 1,
                        ],
                    ]
                ))->toArray(),
            ],
            (float) $document->sale_total_amt,
            (float) $document->sale_total_amt,
            (float) $document->sale_subtotal,
            'C',
            [[
                'amount' => (float) $document->total_discount_amt, 'description' => 'ExtraDISC',
            ]],
        );

        $receipt->header->previousUUID = '89F8875315D17E52E1EDE0FCC59C0FD340439B0E30B2F8C51371490EF8D44A70';
        $receipt->header->uuid = hash_hmac('sha256', ETA\DTO\Signature::serialize($receipt->toArray()), $receipt->header->receiptNumber);

        return $receipt;
    }
}
