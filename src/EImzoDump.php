<?php

namespace MrMusaev\EImzo;

use MrMusaev\EImzo\Requests\AuthenticateRequest;
use MrMusaev\EImzo\Responses\ChallengeResponse;
use MrMusaev\EImzo\Responses\MobileAuthenticateResponse;
use MrMusaev\EImzo\Responses\MobileAuthResponse;
use MrMusaev\EImzo\Responses\MobileSignResponse;
use MrMusaev\EImzo\Responses\MobileStatusResponse;
use MrMusaev\EImzo\Responses\MobileVerifyResponse;
use MrMusaev\EImzo\Responses\SubjectCertificateInfo;

class EImzoDump implements EImzoConnection
{
    public function createChallenge(): ChallengeResponse
    {
        return new ChallengeResponse(
            status: 1,
            challenge: substr(md5(rand()), 0, 32),
            ttl: 120,
            message: '',
        );
    }

    public function mobileAuth(): MobileAuthResponse
    {
        return new MobileAuthResponse(
            status: 1,
            siteId: config('eimzo-json.site_id'),
            documentId: substr(md5(rand()), 0, 8),
            challange: substr(md5(rand()), 0, 32),
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

    public function mobileAuthenticate(AuthenticateRequest $request): MobileAuthenticateResponse
    {
        return new MobileAuthenticateResponse(
            status: 1,
            message: '',
            subjectCertificateInfo: SubjectCertificateInfo::from([
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
            ]),
        );
    }

    public function mobileSign(): MobileSignResponse
    {
        return new MobileSignResponse(
            status: 1,
            siteId: config('eimzo-json.site_id'),
            documentId: substr(md5(rand()), 0, 8),
            message: '',
        );
    }

    public function mobileVerify(AuthenticateRequest $request, string $document): MobileVerifyResponse
    {
        return new MobileVerifyResponse(
            status: 1,
            message: '',
            subjectCertificateInfo: SubjectCertificateInfo::from([
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
            ]),
            verificationInfo: [
                "policyIdentifiers" => [
                    "1.2.860.3.2.2.1.2.1",
                    "1.2.860.3.2.2.1.2.2",
                    "1.2.860.3.2.2.1.2.3",
                    "1.2.860.3.2.2.1.2.4"
                ],
                "signingTime" => "2022-12-30 12:36:12",
                "timestampedTime" => "2022-12-30 12:36:15",
            ],
            pkcs7Attached: "MIAGC.....AAAAA\u003d\u003d",
        );
    }
}
