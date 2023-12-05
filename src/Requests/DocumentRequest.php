<?php

namespace MrMusaev\EImzo\Requests;

use Spatie\LaravelData\Data;

class DocumentRequest extends Data
{
    public function __construct(
        public string $document,
        public string $realIP,
        public string $host,
    ) {

    }
}
