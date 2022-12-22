<?php

namespace App\Domains\ETA\APIs;

use Closure;

class Document
{
    public function __construct(
        protected API $http,
    ) {
    }

    public function submit(\App\Domains\ETA\Documents\Document $receipt, Closure $callback): void
    {
        //
    }
}
