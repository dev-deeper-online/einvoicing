<?php

namespace App\Domains\Receipt;

use App\Domains\Feed\Commands\CheckForNewReceiptsCommand;
use App\Domains\Receipt\Actions\CreateNewReceipt;
use App\Domains\Receipt\Contracts\CreatesNewReceipt;
use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class ReceiptServiceProvider extends PluginServiceProvider
{
    /**
     * Configure the plugin service provider.
     *
     * @param  Package  $package
     * @return void
     */
    public function configurePackage(Package $package): void
    {
        $package
            ->name('receipt_domain')
            ->hasCommand(CheckForNewReceiptsCommand::class);
    }

    /**
     * Register a booted callback to be run after the "boot" method is called.
     *
     * @return void
     */
    public function packageBooted(): void
    {
        parent::packageBooted();

        $this->app->bind(CreatesNewReceipt::class, CreateNewReceipt::class);
    }
}
