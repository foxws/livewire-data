<?php

namespace Foxws\Data\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Foxws\Data\Data
 */
class Data extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Foxws\Data\Data::class;
    }
}
