<?php

namespace App\Domains\Receipt\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    /**
     * Indicates if all mass assignment is enabled.
     *
     * @var bool
     */
    protected static $unguarded = ['*'];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
}
