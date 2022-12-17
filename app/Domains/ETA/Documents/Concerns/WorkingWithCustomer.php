<?php

namespace App\Domains\ETA\Documents\Concerns;

use App\Domains\ETA\Documents\Document;

trait WorkingWithCustomer
{
    protected ?string $customer_name = null;

    protected ?string $customer_id = null;

    /**
     * @param  string|null  $customer_id
     * @param  string|null  $customer_name
     * @return Document
     */
    public function setCustomer(?string $customer_id, ?string $customer_name): Document
    {
        $this->customer_id = $customer_id;
        $this->customer_name = $customer_name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCustomerName(): ?string
    {
        return $this->customer_name;
    }

    /**
     * @return string|null
     */
    public function getCustomerId(): ?string
    {
        return $this->customer_id;
    }
}
