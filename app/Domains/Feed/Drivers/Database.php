<?php

namespace App\Domains\Feed\Drivers;

use App\Domains\Feed\Drivers\Database\Models\Document;
use Illuminate\Support\Collection;

class Database implements Driver
{
    /**
     * {@inheritdoc}
     *
     * @return Collection
     */
    public function run(): Collection
    {
        return Document::with([
            'items', 'items.inventory',
        ])->get();
    }
}
