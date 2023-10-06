<?php

namespace MrMusaev\EImzo;

use MrMusaev\EImzo\Responses\ChallengeResponse;
use MrMusaev\EImzo\Responses\MobileAuthenticateResponse;
use MrMusaev\EImzo\Responses\MobileAuthResponse;
use MrMusaev\EImzo\Responses\MobileStatusResponse;

class EImzoDump implements EImzoConnection
{
    public function createChallenge(): ChallengeResponse
    {
        return new ChallengeResponse(
            challenge: substr(md5(rand()), 0, 32),
            ttl: 120,
            status: 1,
            message: '',
        );
    }

    public function mobileAuth(): MobileAuthResponse
    {
        return new MobileAuthResponse(
            challange: substr(md5(rand()), 0, 32),
            documentId: substr(md5(rand()), 0, 8),
            siteId: config('eimzo-json.site_id'),
            status: 1,
            message: '',
        );
    }

    public function mobileStatus(string $documentId): MobileStatusResponse
    {
        return new MobileStatusResponse(
            status: 1,
            message: '',
        );
    }

    public function mobileAuthenticate(string $documentId, string $realIP, string $host): MobileAuthenticateResponse
    {
        return new MobileAuthenticateResponse(
            status: 1,
            message: '',
            subjectCertificateInfo: [
                "serialNumber" => "7700000",
                "X500Name" => "CN\u003dIVANOV IVAN IVANOVICH,Name\u003dIVAN,SURNAME\u003dIVANOV,UID\u003d400000000,1.2.860.3.16.1.2\u003d30000000000000",
                "subjectName" => [
                    "UID" => "400000000",
                    "SURNAME" => "IVANOV",
                    "1.2.860.3.16.1.2" => "30000000000000",
                    "CN" => "IVANOV IVAN IVANOVICH",
                    "Name" => "IVAN"
                ],
                "validFrom" => "2022-09-16 12:21:38",
                "validTo" => "2024-09-16 23:59:59",
            ],
        );
    }
}
