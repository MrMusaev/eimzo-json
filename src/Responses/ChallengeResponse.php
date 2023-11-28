<?php

namespace MrMusaev\EImzo\Responses;

use MrMusaev\EImzo\Enums\GeneralStatuses;
use Spatie\LaravelData\Data;

class ChallengeResponse extends Data
{
    public function __construct(
        public int $status = 0,
        public string $challenge = '',
        public int $ttl = 0,
        public string $message = '',
    ) {

    }

    public function isSuccessful(): bool
    {
        return $this->status == GeneralStatuses::SUCCESSFUL->value;
    }
}
