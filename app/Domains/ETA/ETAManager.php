<?php

namespace App\Domains\ETA;

use App\Domains\ETA\Documents\Document;
use Illuminate\Support\Manager;

class ETAManager extends Manager
{
    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getDefaultDriver(): string
    {
        return $this->config->get('eta.driver', 'receipt');
    }

    /**
     * Create a new ETA document instance.
     * The document type is 'R'.
     *
     * @return Documents\Document
     */
    public function createReceiptDriver(): Documents\Document
    {
        return new Documents\Receipt();
    }

    /**
     * Create a new ETA document instance.
     * The document type is 'RS'.
     *
     * @return Documents\Document
     */
    public function createRetailReceiptDriver(): Documents\Document
    {
        return new Documents\RetailReceipt();
    }
}
