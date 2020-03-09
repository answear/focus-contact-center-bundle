<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Request\FCC;

class AddRecords
{
    /**
     * @var AddRecords\Record[]
     */
    private $records;

    /**
     * @param AddRecords\Record[] $records
     */
    public function __construct(array $records)
    {
        $this->records = $records;
    }
}
