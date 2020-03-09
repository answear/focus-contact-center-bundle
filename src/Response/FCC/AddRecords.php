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

    public function getRecordsId(): array
    {
        return $this->recordsId;
    }
}
