<?php

namespace RyanChandler\Shortlinks\Facades;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Facade;

class Shortlinks extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \RyanChandler\Shortlinks\Shortlinks::class;
    }
}