<?php

namespace Nurdaulet\FluxCatalog\Facades\Helpers;

use Illuminate\Support\Facades\Facade;

class TextConverter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'textConverter';
    }
}
