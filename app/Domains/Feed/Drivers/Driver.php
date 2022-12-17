<?php

namespace App\Domains\Feed\Drivers;

abstract class Driver
{
    /**
     * Run the corresponded driver to feed the app.
     *
     * @return void
     */
    abstract public function run(): void;
}
