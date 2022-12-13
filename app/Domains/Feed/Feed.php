<?php

namespace App\Domains\Feed;

use App\Domains\Feed\Drivers\Driver;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin Driver
 */
class Feed extends Facade
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'feeder';
    }
}
