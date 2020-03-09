<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Request\FCC;

use Answear\FocusContactCenterBundle\Request\Request;

class UpdateRecords implements Request
{
    /**
     * @var UpdateRecords\Record[]
     */
    private $records;

    public function __construct(array $records)
    {
        $this->records = $records;
    }

    public function toArray(): array
    {
        return [
            'updates' => array_map(
                static function (UpdateRecords\Record $record): array {
                    return $record->toArray();
                },
                $this->records
            ),
        ];
    }
}
