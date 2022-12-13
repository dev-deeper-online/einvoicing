<?php

namespace App\Domains\Receipt\Actions;

use App\Domains\Receipt\Contracts\CreatesNewReceipt;

class CreateNewReceipt implements CreatesNewReceipt
{
    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function handle(array $receipt): void
    {
        dd($receipt);
    }
}
