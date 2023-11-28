<?php

namespace MrMusaev\EImzo\Responses;

use MrMusaev\EImzo\Enums\GeneralStatuses;
use Spatie\LaravelData\Data;

class MobileVerifyResponse extends Data
{
    public function __construct(
        public int $status = 0,
        public string $message = '',
        public SubjectCertificateInfo $subjectCertificateInfo = new SubjectCertificateInfo(),
        public array $verificationInfo = [],
        public string $pkcs7Attached = '',
    ) {

    }

    public function isSuccessful(): bool
    {
        return $this->status == GeneralStatuses::SUCCESSFUL->value;
    }
}
