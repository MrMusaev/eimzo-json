<?php

namespace opencard\EImzo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \opencard\EImzo\EImzo
 */
class EImzo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \opencard\EImzo\EImzo::class;
    }
}
