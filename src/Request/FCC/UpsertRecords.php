<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Request\FCC;

use Answear\FocusContactCenterBundle\Request\Request;
use Webmozart\Assert\Assert;

class UpsertRecords implements Request
{
    /**
     * @var UpsertRecords\Record[]
     */
    private $records;

    public function __construct(array $records)
    {
        Assert::allIsInstanceOf($records, UpsertRecords\Record::class);
        $this->records = $records;
    }

    public function toArray(): array
    {
        return [
            'records' => array_map(
                static function (UpsertRecords\Record $record): array {
                    return $record->toArray();
                },
                $this->records
            ),
        ];
    }
}
