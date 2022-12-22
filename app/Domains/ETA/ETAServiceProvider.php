<?php

namespace App\Domains\ETA;

use App\Domains\ETA\APIs\API;
use Illuminate\Support\ServiceProvider;

class ETAServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('eta', ETAManager::class);
        $this->app->singleton(API::class, fn () => (new API())->initialize());
    }
}
