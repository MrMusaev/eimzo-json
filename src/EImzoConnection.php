<?php

namespace MrMusaev\EImzo;

use MrMusaev\EImzo\Responses\ChallengeResponse;
use MrMusaev\EImzo\Responses\MobileAuthResponse;
use MrMusaev\EImzo\Responses\MobileStatusResponse;

interface EImzoConnection
{
    public function createChallenge(): ChallengeResponse;

    public function mobileAuth(): MobileAuthResponse;

    public function mobileStatus(string $documentId): MobileStatusResponse;
}
