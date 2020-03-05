<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Request\FCC;

class UpdateRecords
{
    /**
     * @var UpdateRecords\Record[]
     */
    private $records;

    public function __construct(array $records)
    {
        $this->records = $records;
    }
}
