<?php

namespace MrMusaev\EImzo;

use MrMusaev\EImzo\Requests\AuthenticateRequest;
use MrMusaev\EImzo\Responses\ChallengeResponse;
use MrMusaev\EImzo\Responses\AuthenticateResponse;
use MrMusaev\EImzo\Responses\MobileAuthResponse;
use MrMusaev\EImzo\Responses\MobileSignResponse;
use MrMusaev\EImzo\Responses\MobileStatusResponse;
use MrMusaev\EImzo\Responses\MobileVerifyResponse;

interface EImzoConnection
{
    public function frontendChallenge(): ChallengeResponse;

    public function backendAuth(AuthenticateRequest $request): AuthenticateResponse;

    public function mobileAuth(): MobileAuthResponse;

    public function mobileStatus(string $documentId): MobileStatusResponse;

    public function mobileAuthenticate(AuthenticateRequest $request): AuthenticateResponse;

    public function mobileSign(): MobileSignResponse;

    public function mobileVerify(AuthenticateRequest $request, string $document): MobileVerifyResponse;
}
