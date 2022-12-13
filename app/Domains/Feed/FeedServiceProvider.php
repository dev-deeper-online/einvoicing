<?php

namespace App\Domains\Feed;

use Illuminate\Support\ServiceProvider;

class FeedServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('feeder', fn ($app) => new FeedManager($app));
    }
}
