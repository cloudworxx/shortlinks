<?php

namespace RyanChandler\Shortlinks\Facades;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Facade;

/**
 * @method \RyanChandler\Shortlinks\PendingShortlink route(string $route, array $parameters = [], bool $absolute = true)
 * @method \RyanChandler\Shortlinks\PendingShortlink url(string $url)
 */
class Shortlinks extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \RyanChandler\Shortlinks\Shortlinks::class;
    }
}