<?php

namespace App\Domains\Feed\Drivers\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rps.invn_sbs_item';

    /**
     * Get the current connection name for the model.
     *
     * @return string|null
     */
    public function getConnectionName(): ?string
    {
        return config('feeder.drivers.database.connection');
    }
}
