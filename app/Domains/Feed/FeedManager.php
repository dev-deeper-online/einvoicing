<?php

namespace App\Domains\Feed;

use App\Domains\Feed\Drivers\Driver;
use Illuminate\Support\Manager;

/**
 * @mixin Driver
 * @mixin Manager
 */
class FeedManager extends Manager
{
    /**
     * Create a new instance of the database feeder driver.
     *
     * @return Drivers\Database
     */
    public function createDatabaseDriver(): Drivers\Database
    {
        return new Drivers\Database();
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getDefaultDriver(): string
    {
        return $this->config->get('feeder.driver', 'database');
    }
}
