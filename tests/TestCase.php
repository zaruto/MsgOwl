<?php

namespace Loopcraft\MsgOwl\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Loopcraft\MsgOwl\MsgOwlServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Loopcraft\\MsgOwl\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            MsgOwlServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_msgowl_table.php.stub';
        $migration->up();
        */
    }
}
