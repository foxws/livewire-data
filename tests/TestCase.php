<?php

namespace Foxws\Data\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Foxws\Data\DataServiceProvider;

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

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_livewire-data_table.php.stub';
        $migration->up();
        */
    }
}
