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

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'bool',
        'responses' => 'array',
    ];

    /**
     * Save the given response.
     *
     * @param  mixed  $response
     * @return void
     */
    public function saveResponse(mixed $response): void
    {
        $responses = $this->responses;
        $responses[] = $response;

        $this->update([
            'responses' => $responses,
        ]);
    }
}
