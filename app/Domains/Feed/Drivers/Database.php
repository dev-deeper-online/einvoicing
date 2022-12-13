<?php

namespace App\Domains\Feed\Drivers;

use App\Domains\Feed\Drivers\Database\Models\Document;
use App\Domains\Receipt\Contracts\CreatesNewReceipt;
use App\Domains\Receipt\DTO\Receipt;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Database implements Driver
{
    public function __construct(
        protected ?string $connection = null
    ) {
        DB::connection($connection);
    }

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
