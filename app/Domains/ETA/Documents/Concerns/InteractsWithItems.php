<?php

namespace App\Domains\ETA\Documents\Concerns;

use App\Domains\ETA\Documents\Document;

trait InteractsWithItems
{
    protected array $items = [];

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param  array  $items
     * @return Document
     */
    public function setItems(array $items): Document
    {
        $this->items = $items;

        return $this;
    }
}
