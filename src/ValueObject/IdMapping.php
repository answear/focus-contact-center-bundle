<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\ValueObject;

final class IdMapping
{
    private int $fccId;
    private string $externalId;

    public function __construct(int $fccId, string $externalId)
    {
        $this->fccId = $fccId;
        $this->externalId = $externalId;
    }

    public function getFccId(): int
    {
        return $this->fccId;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }
}
