<?php

namespace App\Facades\Model;

use Illuminate\Support\Facades\Facade;

class RsModel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return getClass(__CLASS__);
    }
}
