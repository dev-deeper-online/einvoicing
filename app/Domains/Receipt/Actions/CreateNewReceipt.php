<?php

namespace App\Domains\Receipt\Actions;

use App\Domains\Receipt\Contracts\CreatesNewReceipt;
use App\Domains\Receipt\DTO;
use App\Domains\Receipt\Models;

class CreateNewReceipt implements CreatesNewReceipt
{
    /**
     * {@inheritdoc}
     *
     * @return Models\Receipt
     */
    public function handle(DTO\Receipt $receipt): Models\Receipt
    {
        return Models\Receipt::firstOrCreate([
            'id' => $receipt->id,
            'created_at' => $receipt->created_at,
        ], [
            'receiver' => $receipt->receiver,
            'total' => $receipt->total,
            'status' => null,
        ]);
    }
}
