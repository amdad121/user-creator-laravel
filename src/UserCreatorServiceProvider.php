<?php

declare(strict_types=1);

namespace AmdadulHaq\UserCreator;

use AmdadulHaq\UserCreator\Commands\UserCreatorCommand;
use Illuminate\Support\ServiceProvider;

class UserCreatorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/user-creator.php',
            'user-creator'
        );
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/user-creator.php' => config_path('user-creator.php'),
            ], 'user-creator-config');

            $this->commands([
                UserCreatorCommand::class,
            ]);
        }
    }
}
