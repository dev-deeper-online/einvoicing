<?php

namespace App\Domains\Feed\Drivers\Database\Actions;

use App\Domains\ETA\Documents\Document as ETADocument;
use App\Domains\ETA\ETA;
use App\Domains\Feed\Contracts\SubmitsDocument;
use App\Domains\Feed\Drivers\Database\Models\Document;
use App\Domains\Feed\Drivers\Database\Models\DocumentItem;
use Illuminate\Support\Carbon;

class SubmitDocument extends SubmitsDocument
{
    /**
     * {@inheritdoc}
     *
     * @param  Document  $document
     * @return ETADocument
     */
    protected static function buildDocumentFrom(mixed $document): ETADocument
    {
        return ETA::build(
            id: $document->sid,
            date: Carbon::parse($document->post_date),
            sales_total_amount: $document->sale_total_amt,
            total_amount: $document->sale_total_amt,
            sales_subtotal: $document->sale_subtotal,
            customer_name: $document->bt_first_name,
            customer_id: $document->bt_cuid,
            total_discount_amount: $document->total_discount_amt,
            items: $document->items->map(fn (DocumentItem $item) => [
                'internalCode' => $item->sid,
                'description' => $item->description1,
                'itemCode' => $item->inventory?->text6,
                'quantity' => (int) $item->qty,
                'unitPrice' => (float) $item->orig_price,
                'netSale' => (float) $item->orig_price,
                'totalSale' => (float) $item->orig_price,
                'total' => (float) $item->orig_price + (float) $item->orig_tax_amt,
                'taxableItems' => [
                    [
                        'taxType' => 'T1',
                        'subType' => 'V009',
                        'amount' => (float) $item->orig_tax_amt,
                        'rate' => (int) $item->tax_prec,
                    ],
                ],
                'itemType' => 'EGS',
                'unitType' => 'CS',
            ])->toArray(),
        );
    }
}
