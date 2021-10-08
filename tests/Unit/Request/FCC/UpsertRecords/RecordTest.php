<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Tests\Unit\Request\FCC\UpsertRecords;

use Answear\FocusContactCenterBundle\Request\FCC\UpsertRecords\Record;
use Answear\FocusContactCenterBundle\ValueObject\AttributeValue;
use Answear\FocusContactCenterBundle\ValueObject\AttributeValueCollection;
use PHPUnit\Framework\TestCase;

class RecordTest extends TestCase
{
    /**
     * @test
     */
    public function emptyRecord(): void
    {
        $record = new Record('1');

        $this->assertSame(['external_id' => '1'], $record->toArray());
    }

    /**
     * @test
     */
    public function full(): void
    {
        $record = new Record('1');
        $record->setValues(new AttributeValueCollection(new AttributeValue('Name', 'John')));
        $record->setNumbers(['123456789']);
        $record->setEmails(['john@example.org']);
        $record->setSegments(['segment', 'another']);

        $this->assertSame(
            [
                'external_id' => '1',
                'numbers' => ['123456789'],
                'emails' => ['john@example.org'],
                'values' => ['Name' => 'John'],
                'segments' => ['segment', 'another'],
            ],
            $record->toArray()
        );
    }
}
