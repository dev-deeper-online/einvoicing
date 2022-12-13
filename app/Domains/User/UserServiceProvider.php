<?php

namespace App\Domains\User;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class UserServiceProvider extends PluginServiceProvider
{
    /**
     * Configure the plugin service provider.
     *
     * @param  Package  $package
     * @return void
     */
    public function configurePackage(Package $package): void
    {
        $package->name('user_domain');
    }
}
