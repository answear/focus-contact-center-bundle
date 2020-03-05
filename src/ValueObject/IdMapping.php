<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\ValueObject;

final class IdMapping
{
    /**
     * @var string
     */
    private $fccId;

    /**
     * @var string
     */
    private $externalId;

    public function __construct(string $fccId, string $externalId)
    {
        $this->fccId = $fccId;
        $this->externalId = $externalId;
    }

    public function getFccId(): string
    {
        return $this->fccId;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }
}
