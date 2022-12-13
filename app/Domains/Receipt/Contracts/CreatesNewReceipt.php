<?php

namespace App\Domains\Receipt\Contracts;

interface CreatesNewReceipt
{
    /**
     * Creates a new receipt.
     *
     * @return void
     */
    public function handle(): void;
}
