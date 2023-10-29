<?php

namespace MrMusaev\EImzo\Requests;

use Spatie\LaravelData\Data;

class AuthenticateRequest extends Data
{
    public function __construct(
        public string $documentId,
        public string $realIP,
        public string $host,
    ) {

    }
}
