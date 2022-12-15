<?php

namespace App\Domains\Feed\Drivers\Database\Actions;

use App\Domains\Feed\Drivers\Database\Models\Document;
use App\Domains\Receipt\Contracts\CreatesNewReceipt;
use App\Domains\Receipt\DTO\Receipt;
use App\Domains\Receipt\Models\Receipt as ReceiptModel;
use Exception;
use Illuminate\Support\Carbon;

class CreateNewReceipt
{
    /**
     * Create a new receipt from the driver document.
     *
     * @param  Document  $document
     * @return ReceiptModel
     *
     * @throws Exception
     */
    public static function handle(Document $document): ReceiptModel
    {
        return app(CreatesNewReceipt::class)->handle(new Receipt(
            $document->sid,
            $document->bt_first_name,
            $document->sale_total_amt,
            Carbon::parse($document->created_datetime),
        ));
    }
}
