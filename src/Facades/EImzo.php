<?php

namespace MrMusaev\EImzo\Facades;

use Illuminate\Support\Facades\Facade;
use MrMusaev\EImzo\EImzoJson;

/**
 * @see \MrMusaev\EImzo\EImzoJson
 */
class EImzo extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return EImzoJson::class;
    }
}
