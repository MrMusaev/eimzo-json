<?php

namespace MrMusaev\EImzo\Responses;

use MrMusaev\EImzo\Enums\GeneralStatuses;
use Spatie\LaravelData\Data;

class VerifyAttachedResponse extends Data
{
    public function __construct(
        public int $status = 0,
        public string $message = '',
        public Pkcs7Info $pkcs7Info = new Pkcs7Info(),
    ) {

    }

    public function isSuccessful(): bool
    {
        return $this->status == GeneralStatuses::SUCCESSFUL->value;
    }
}
