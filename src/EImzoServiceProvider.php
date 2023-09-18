<?php

namespace opencard\EImzo;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use opencard\EImzo\Commands\EImzoCommand;

class EImzoServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('eimzo-json')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_eimzo-json_table')
            ->hasCommand(EImzoCommand::class);
    }
}
