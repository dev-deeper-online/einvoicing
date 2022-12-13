<?php

namespace App\Domains\Feed\Drivers\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Document extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rps.document';

    /**
     * Get the document
     *
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(DocumentItem::class, 'doc_sid', 'sid');
    }
}
