<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Request\FCC;

use Answear\FocusContactCenterBundle\Request\Request;

class AddRecords implements Request
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

    public function toArray(): array
    {
        return [
            'records' => array_map(
                static function (AddRecords\Record $record): array {
                    return $record->toArray();
                },
                $this->records
            ),
        ];
    }
}
