<?php

namespace App\Domains\Feed\Drivers;

use App\Domains\Feed\Drivers\Database\Actions\CreateNewReceipt;
use App\Domains\Feed\Drivers\Database\Actions\SubmitReceipt;
use App\Domains\Feed\Drivers\Database\Models\Document;
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
        ])->chunk(100, function (Collection $documents) {
            $documents->each(function (Document $document) {
                $receipt = CreateNewReceipt::handle($document);
                SubmitReceipt::handle($document, $receipt);
            });
        });
    }
}
