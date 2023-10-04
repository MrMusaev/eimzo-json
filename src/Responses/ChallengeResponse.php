<?php

namespace MrMusaev\EImzo\Responses;

use Spatie\LaravelData\Data;

class ChallengeResponse extends Data
{
    public function __construct(
        public string $challenge = '',
        public int $ttl = 0,
        public int $status = 0,
        public string $message = '',
    ) {

    }
}
