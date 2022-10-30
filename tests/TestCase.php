<?php

namespace Foxws\Data\Tests;

use Foxws\Data\DataServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            DataServiceProvider::class,
        ];
    }
}
