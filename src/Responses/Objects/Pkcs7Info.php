<?php

namespace MrMusaev\EImzo\Responses;

use Spatie\LaravelData\Data;

class Pkcs7Info extends Data
{
    public function __construct(
        public array $signers = [],
        public string $documentBase64 = '',
    )
    {

    }

    public function getSigners(): array
    {
        return $this->pkcs7Info['signers'] ?? [];
    }

    public function getDocumentBase64(): string
    {
        return $this->pkcs7Info['documentBase64'] ?? '';
    }
}
