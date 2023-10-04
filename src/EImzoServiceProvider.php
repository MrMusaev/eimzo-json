<?php

namespace MrMusaev\EImzo;

use MrMusaev\EImzo\Commands\EImzoCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class EImzoServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('eimzo-json')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_eimzo-json_table')
            ->hasCommand(EImzoCommand::class);

        $this->app->bind(EImzoConnection::class, config('eimzo-json.connection_class'));
    }
}
