<?php

namespace App\Domains\Feed;

use Illuminate\Support\Manager;

class FeedManager extends Manager
{
    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getDefaultDriver(): string
    {
        return config('feeder.driver', 'database');
    }

    /**
     * Create a new instance of the database feeder driver.
     *
     * @return Drivers\Database
     */
    public function createDatabaseDriver(): Drivers\Database
    {
        return new Drivers\Database();
    }
}
