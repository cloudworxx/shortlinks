<?php

namespace RyanChandler\Shortlinks\Facades;

use Illuminate\Support\Facades\Facade;

class Shortlinks extends Facade
{
    protected function getFacadeAccessor()
    {
        return \RyanChandler\Shortlinks\Shortlinks::class;
    }
}