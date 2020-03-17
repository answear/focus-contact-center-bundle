<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Tests\Unit\Request\FCC\AddRecords;

use Answear\FocusContactCenterBundle\Request\FCC\AddRecords\Record;
use Answear\FocusContactCenterBundle\ValueObject\AttributeValue;
use Answear\FocusContactCenterBundle\ValueObject\AttributeValueCollection;
use PHPUnit\Framework\TestCase;

class RecordTest extends TestCase
{
    /**
     * @test
     */
    public function minimal(): void
    {
        $record = new Record(
            '1',
            new AttributeValueCollection(),
            ['123456789'],
            ['john@example.org']
        );

        $this->assertSame(
            [
                'external_id' => '1',
                'numbers' => ['123456789'],
                'emails' => ['john@example.org'],
            ],
            $record->toArray()
        );
    }

    /**
     * @test
     */
    public function full(): void
    {
        $record = new Record(
            '1',
            new AttributeValueCollection(new AttributeValue('Name', 'John')),
            ['123456789'],
            ['john@example.org']
        );
        $record->setSkills(new AttributeValueCollection(new AttributeValue('Coding', 'Master')));
        $record->setPriority('High');
        $record->setPrivate('Yes');
        $record->setRecall(new \DateTimeImmutable('01-04-2020 12:00'), '10');
        $record->setSlaGroupId('100');
        $record->setSegment('Segment');

        $this->assertSame(
            [
                'external_id' => '1',
                'numbers' => ['123456789'],
                'emails' => ['john@example.org'],
                'values' => ['Name' => 'John'],
                'skills' => ['Coding' => 'Master'],
                'priority' => 'High',
                'private' => 'Yes',
                'recall' => '2020-04-01 12:00',
                'classifiers_id' => '10',
                'sla_group_id' => '100',
                'segment' => 'Segment',
            ],
            $record->toArray()
        );
    }
}
