<?php

namespace Codenexus\Zipcode\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class Zipcode extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'zipcode';
    }
}
