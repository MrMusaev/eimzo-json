<?php

namespace MrMusaev\EImzo\Responses;

use Spatie\LaravelData\Data;

class MobileAuthenticateResponse extends Data
{
    public function __construct(
        public int $status = 0,
        public string $message = '',
        public SubjectCertificateInfo $subjectCertificateInfo = new SubjectCertificateInfo(),
    ) {

    }
}
