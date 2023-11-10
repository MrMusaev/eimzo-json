<?php

namespace MrMusaev\EImzo\Responses;

use MrMusaev\EImzo\Enums\GeneralStatuses;
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

    public function isSuccessful(): bool
    {
        return $this->status == GeneralStatuses::SUCCESSFUL;
    }
}
