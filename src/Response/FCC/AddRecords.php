<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Response\FCC;

use Answear\FocusContactCenterBundle\ValueObject\IdMapping;

class AddRecords
{
    /**
     * @var IdMapping[]
     */
    private $recordsId;

    /**
     * @param IdMapping[] $recordsId
     */
    public function __construct(array $recordsId)
    {
        $this->recordsId = $recordsId;
    }

    public static function fromArray(array $response): self
    {
        // TODO VALIDATE
        $mappings = [];
        foreach ($response['records_id'] as $mapping) {
            $mappings[] = new IdMapping($mapping['fcc_id'], $mapping['external_id']);
        }

        return new self($mappings);
    }

    public function getRecordsId(): array
    {
        return $this->recordsId;
    }
}
