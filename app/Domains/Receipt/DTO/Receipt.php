<?php

namespace App\Domains\Receipt\DTO;

use Illuminate\Support\Carbon;

class Receipt
{
    /**
     * @param  string|null  $id
     * @param  string|null  $receiver
     * @param  string|null  $total
     * @param  Carbon|null  $created_at
     */
    public function __construct(
        public ?string $id,
        public ?string $receiver,
        public ?string $total,
        public ?Carbon $created_at,
    ) {
        //
    }
}
