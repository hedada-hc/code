<?php

namespace Yunxi\Geetest\Facades;

use Illuminate\Support\Facades\Facade;

class Geetest extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'geetest';
    }
}
