<?php

namespace App\Domains\ETA\Documents\Concerns;

use App\Domains\ETA\Documents\Document;
use Illuminate\Support\Carbon;

trait Buildable
{
    /**
     * Build a new document from given data.
     *
     * @param  string|null  $id
     * @param  Carbon|null  $date
     * @param  float  $sales_total_amount
     * @param  float  $total_amount
     * @param  float  $sales_subtotal
     * @param  array  $items
     * @param  string|null  $customer_name
     * @param  string|null  $customer_id
     * @param  float|null  $total_discount_amount
     * @return Document
     */
    public function build(
        ?string $id = null,
        ?Carbon $date = null,
        ?float $sales_total_amount = 0,
        ?float $total_amount = 0,
        ?float $sales_subtotal = 0,
        ?string $customer_name = null,
        ?string $customer_id = null,
        ?float $total_discount_amount = 0,
        array $items = [],
    ): Document {
        $this->setId($id);
        $this->setCustomer($customer_id, $customer_name);
        $this->setDate($date);
        $this->setSalesTotalAmount($sales_total_amount);
        $this->setTotalAmount($total_amount);
        $this->setSalesSubtotal($sales_subtotal);
        $this->setItems($items);
        $this->setTotalDiscountAmount($total_discount_amount);

        return $this;
    }
}
