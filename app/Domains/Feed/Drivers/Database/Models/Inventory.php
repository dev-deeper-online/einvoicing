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
}
