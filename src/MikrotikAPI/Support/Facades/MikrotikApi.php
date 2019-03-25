<?php

namespace MikrotikAPI\Support\Facades;

use Illuminate\Support\Facades\Facade;

class MikrotikApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'MikrotikAPI';
    }
}
