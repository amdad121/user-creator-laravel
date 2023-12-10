<?php

declare(strict_types=1);

namespace AmdadulHaq\UserCreator;

use AmdadulHaq\UserCreator\Commands\UserCreatorCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class UserCreatorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('user-creator-laravel')
            ->hasCommand(UserCreatorCommand::class);
    }
}
