<?php

namespace App\Domains\ETA;

use App\Domains\ETA\Documents\Document;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin Document
 * @mixin ETAManager
 */
class ETA extends Facade
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'eta';
    }
}
