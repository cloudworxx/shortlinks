<?php

namespace RyanChandler\Shortlinks\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use RyanChandler\Shortlinks\ShortlinksServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [ShortlinksServiceProvider::class];
    }
}