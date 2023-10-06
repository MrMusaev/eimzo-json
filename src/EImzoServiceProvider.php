<?php

namespace MrMusaev\EImzo;

use Exception;
use MrMusaev\EImzo\Commands\EImzoCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class EImzoServiceProvider extends PackageServiceProvider
{
    /**
     * @param Package $package
     * @return void
     * @throws Exception
     */
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

        $this->configureBindings();
    }

    /**
     * @return void
     * @throws Exception
     */
    public function configureBindings(): void
    {
        $implementation = config('eimzo-json.implementation');

        switch ($implementation) {
            case 'dump':
                $this->app->bind(EImzoConnection::class, EImzoDump::class);
                break;
            case 'custom':
                $implementationClass = config('eimzo-json.implementation_class');
                if (!class_exists($implementationClass)) {
                    throw new Exception("EIMZO_IMPLEMENTATION_CLASS parameter is not set in .env file!");
                }
                $this->app->bind(EImzoConnection::class, $implementationClass);
                break;
            case 'json': default:
                $this->app->bind(EImzoConnection::class, EImzoJson::class);
                break;
        }
    }
}
