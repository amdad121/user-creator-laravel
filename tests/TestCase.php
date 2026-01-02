<?php

declare(strict_types=1);

namespace AmdadulHaq\UserCreator\Tests;

use AmdadulHaq\UserCreator\UserCreatorServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            UserCreatorServiceProvider::class,
        ];
    }
}
