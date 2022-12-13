<?php

namespace App\Domains\Feed\Drivers\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rps.document_item';

    /**
     * Get the current connection name for the model.
     *
     * @return string|null
     */
    public function getConnectionName(): ?string
    {
        return config('feeder.drivers.database.connection');
    }

    /**
     * Get item inventory details.
     *
     * @return BelongsTo
     */
    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class, 'invn_sbs_item_sid', 'sid');
    }
}
