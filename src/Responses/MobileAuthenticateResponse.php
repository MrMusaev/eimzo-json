<?php

namespace MrMusaev\EImzo\Responses;

use Spatie\LaravelData\Data;

class MobileAuthenticateResponse extends Data
{
    public function __construct(
        public int $status = 0,
        public string $message = '',
        public array $subjectCertificateInfo = [],
    ) {

    }

    public function getSerialNumber(): string
    {
        return $this->subjectCertificateInfo['serialNumber'] ?? '';
    }

    public function getSurname(): string
    {
        return $this->subjectCertificateInfo['subjectName']['SURNAME'] ?? '';
    }

    public function getName(): string
    {
        return $this->subjectCertificateInfo['subjectName']['Name'] ?? '';
    }

    public function getFullName(): string
    {
        return $this->getName() . ' ' . $this->getSurname();
    }

    public function getCN(): string
    {
        return $this->subjectCertificateInfo['subjectName']['CN'] ?? '';
    }

    public function getUid(): string
    {
        return $this->subjectCertificateInfo['subjectName']['UID'] ?? '';
    }
}
