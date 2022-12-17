<?php

namespace App\Domains\Feed\Drivers;

use App\Domains\Feed\Drivers\Database\Actions\CreateNewReceipt;
use App\Domains\Feed\Drivers\Database\Actions\SubmitDocument;
use App\Domains\Feed\Drivers\Database\Models\Document;
use Illuminate\Support\Collection;

class Database extends Driver
{
    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function run(): void
    {
        Document::with([
            'items:sid,description1,qty,orig_price,orig_tax_amt,', 'items.inventory:text6',
        ])->select([
            'sid',
            'bt_first_name',
            'sale_total_amt',
            'created_datetime',
        ])->chunk(100, fn (Collection $documents) => $documents->each(function (Document $document) {
            $receipt = CreateNewReceipt::handle($document);

            SubmitDocument::handle($document, $receipt);
        }));
    }
}
