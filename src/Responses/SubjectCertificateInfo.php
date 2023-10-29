<?php

namespace MrMusaev\EImzo\Responses;

use Spatie\LaravelData\Data;

class SubjectCertificateInfo extends Data
{
    public function __construct(
        public string $serialNumber = '',
        public string $X500Name = '',
        public array $subjectName = [],
        public string $validFrom = '',
        public string $validTo = '',
    ) {

    }

    public function getSurname(): string
    {
        return $this->subjectName['SURNAME'] ?? '';
    }

    public function getName(): string
    {
        return $this->subjectName['Name'] ?? '';
    }

    public function getFullName(): string
    {
        return $this->getName() . ' ' . $this->getSurname();
    }

    public function getCN(): string
    {
        return $this->subjectName['CN'] ?? '';
    }

    public function getUid(): string
    {
        return $this->subjectName['UID'] ?? '';
    }
}
