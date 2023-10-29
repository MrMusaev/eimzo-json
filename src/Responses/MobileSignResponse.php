<?php

namespace MrMusaev\EImzo\Responses;

use Spatie\LaravelData\Data;

class MobileSignResponse extends Data
{
    public function __construct(
        public int $status = 0,
        public string $siteId = '',
        public string $documentId = '',
        public string $message = '',
    ) {

    }
}
