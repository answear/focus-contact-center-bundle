<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Response\FCC;

class UpdateRecords
{
    /**
     * @var int
     */
    private $updated;

    public function __construct(int $updated)
    {
        $this->updated = $updated;
    }

    public static function fromArray(array $response): self
    {
        // TODO VALIDATE
        return new self($response['updated']);
    }

    public function getUpdated(): int
    {
        return $this->updated;
    }
}
