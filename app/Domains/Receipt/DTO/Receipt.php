<?php

namespace App\Domains\Receipt\DTO;

use Illuminate\Support\Carbon;

class Receipt
{
    public function __construct(
        public string $id,
        public string $receiver,
        public string $total,
        public Carbon $created_at,
    ) {
        //
    }
}
