<?php

namespace App\Domains\ETA\Documents\Concerns;

use App\Domains\ETA\Documents\Document;

trait WorkingWithAmount
{
    protected float $total_amount = 0;

    protected float $total_discount_amount = 0;

    protected float $sales_total_amount = 0;

    protected float $sales_subtotal = 0;

    /**
     * @return float
     */
    public function getTotalAmount(): float
    {
        return $this->total_amount;
    }

    /**
     * @param  float  $total_amount
     * @return Document
     */
    public function setTotalAmount(?float $total_amount = 0): Document
    {
        $this->total_amount = $total_amount ?? 0;

        return $this;
    }

    /**
     * @return float
     */
    public function getSalesTotalAmount(): float
    {
        return $this->sales_total_amount;
    }

    /**
     * @param  float  $sales_total_amount
     * @return Document
     */
    public function setSalesTotalAmount(?float $sales_total_amount = 0): Document
    {
        $this->sales_total_amount = $sales_total_amount ?? 0;

        return $this;
    }

    /**
     * @return float
     */
    public function getSalesSubtotal(): float
    {
        return $this->sales_subtotal;
    }

    /**
     * @param  float  $sales_subtotal
     * @return Document
     */
    public function setSalesSubtotal(?float $sales_subtotal = 0): Document
    {
        $this->sales_subtotal = $sales_subtotal ?? 0;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalDiscountAmount(): float
    {
        return $this->total_discount_amount;
    }

    /**
     * @param  float  $total_discount_amount
     * @return Document
     */
    public function setTotalDiscountAmount(?float $total_discount_amount = 0): Document
    {
        $this->total_discount_amount = $total_discount_amount ?? 0;

        return $this;
    }
}
