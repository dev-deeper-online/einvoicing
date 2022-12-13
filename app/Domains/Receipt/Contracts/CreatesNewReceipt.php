<?php

namespace App\Domains\Receipt\Contracts;

interface CreatesNewReceipt
{
    /**
     * Creates a new receipt.
     *
     * @param  array  $receipt
     * @return void
     */
    public function handle(array $receipt): void;
}
