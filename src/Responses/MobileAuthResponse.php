<?php

namespace MrMusaev\EImzo\Responses;

use Spatie\LaravelData\Data;

class MobileAuthResponse extends Data
{
    public function __construct(
        public string $challange = '',
        public string $documentId = '',
        public string $siteId = '',
        public int $status = 0,
        public string $message = '',
    ) {

    }
}
