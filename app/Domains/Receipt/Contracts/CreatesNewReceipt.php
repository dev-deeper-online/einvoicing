<?php

namespace App\Domains\Receipt\Contracts;

use App\Domains\Receipt\DTO;
use App\Domains\Receipt\Models;

interface CreatesNewReceipt
{
    /**
     * Creates a new receipt.
     *
     * @param  DTO\Receipt  $receipt
     * @return Models\Receipt
     */
    public function handle(DTO\Receipt $receipt): Models\Receipt;
}
