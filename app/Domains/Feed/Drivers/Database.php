<?php

namespace App\Domains\Feed\Drivers;

use App\Domains\Feed\Drivers\Database\Models\Document;
use App\Domains\Receipt\Contracts\CreatesNewReceipt;
use App\Domains\Receipt\DTO\Receipt;
use Illuminate\Support\Collection;

class Database implements Driver
{
    /**
     * {@inheritdoc}
     *
     * @return Collection
     */
    public function run(): void
    {
        Document::with([
            'items', 'items.inventory',
        ])->each(function (Document $document) {
            $receipt = app(CreatesNewReceipt::class)->handle(new Receipt(
                $document->sid,
                $document->bt_first_name,
                $document->sale_total_amt,
                $document->created_datetime,
            ));

//            $submitAction->handle($document, function ($response) use ($receipt) {
//                $receipt->handleResponse($response);
//            });
        });
    }
}