<?php

namespace MrMusaev\EImzo\Responses;

use Spatie\LaravelData\Data;

class MobileStatusResponse extends Data
{
    public function __construct(
        public int $status = 0,
        public string $message = '',
    ) {

    }
}
