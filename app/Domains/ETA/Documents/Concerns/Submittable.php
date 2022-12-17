<?php

namespace App\Domains\ETA\Documents\Concerns;

use App\Domains\ETA\APIs;
use Closure;

trait Submittable
{
    /**
     * Get submission api handler.
     *
     * @return APIs\Document
     */
    abstract protected function submitAPIHandler(): APIs\Document;

    /**
     * Submit the given document.
     *
     * @param  Closure  $callback
     * @return void
     */
    public function submit(Closure $callback): void
    {
        $this->submitAPIHandler()->submit($this, $callback);
    }
}
