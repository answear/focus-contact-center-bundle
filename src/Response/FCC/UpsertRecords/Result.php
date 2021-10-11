<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Response\FCC\UpsertRecords;

class Result
{
    private $id;
    private $action;
    private $externalId;

    public function __construct(int $id, string $action, string $externalId)
    {
        $this->id = $id;
        $this->action = $action;
        $this->externalId = $externalId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }
}
