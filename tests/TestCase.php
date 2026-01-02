<?php

declare(strict_types=1);

namespace AmdadulHaq\UserCreator\Tests;

use AmdadulHaq\UserCreator\UserCreatorServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            UserCreatorServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app->make(Repository::class)->set('database.default', 'testing');
        $app->make(Repository::class)->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}
