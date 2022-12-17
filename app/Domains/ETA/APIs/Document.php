<?php

namespace App\Domains\ETA\APIs;

use Closure;

abstract class Document extends API
{
    /**
     * Submits the given receipt.
     *
     * @param  \App\Domains\ETA\Documents\Document  $document
     * @param  Closure  $callback
     * @return void
     */
    abstract public function submit(\App\Domains\ETA\Documents\Document $document, Closure $callback): void;
}
