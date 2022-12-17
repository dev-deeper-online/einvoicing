<?php

namespace App\Domains\ETA;

use App\Domains\ETA\Commands\DocumentSignatureCommand;
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
        $this->commands([
            DocumentSignatureCommand::class,
        ]);

        $this->app->singleton('eta', ETAManager::class);
    }
}
