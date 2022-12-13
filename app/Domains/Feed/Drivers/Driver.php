<?php

namespace App\Domains\Feed\Drivers;

interface Driver
{
    /**
     * Run the corresponded driver to feed the app.
     *
     * @return void
     */
    public function run(): void;
}
