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
            'items:document_item.sid,document_item.description1,document_item.qty,document_item.orig_price,document_item.orig_tax_amt,',
            'items.inventory:invn_sbs_item.text6',
        ])->select([
            'document.sid',
            'document.bt_first_name',
            'document.sale_total_amt',
            'document.created_datetime',
        ])->chunk(100, fn (Collection $documents) => $documents->each(function (Document $document) {
            $receipt = CreateNewReceipt::handle($document);

            SubmitDocument::handle($document, $receipt);
        }));
    }
}
