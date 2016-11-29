<?php

namespace Yunxi\Alidayu\Facades;

use Illuminate\Support\Facades\Facade;

class Alidayu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'alidayu';
    }
}
