<?php

namespace App\Domains\Feed\Drivers;

use Illuminate\Support\Collection;

interface Driver
{
    /**
     * Run the corresponded driver to feed the app.
     *
     * @return Collection
     */
    public function run(): Collection;
}
