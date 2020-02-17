<?php

namespace RyanChandler\Shortlinks\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use RyanChandler\Shortlinks\ShortlinksServiceProvider;

abstract class TestCase extends BaseTestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    protected function getPackageProviders($app)
    {
        return [ShortlinksServiceProvider::class];
    }

    protected function tableName(string $table)
    {
        return $this->app->config['shortlinks.database_table_prefix'].$table;
    }
}