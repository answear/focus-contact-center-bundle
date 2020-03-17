<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Tests\Unit\Request\FCC\UpdateRecords;

use Answear\FocusContactCenterBundle\Request\FCC\UpdateRecords\Record;
use Answear\FocusContactCenterBundle\ValueObject\AttributeValue;
use Answear\FocusContactCenterBundle\ValueObject\AttributeValueCollection;
use PHPUnit\Framework\TestCase;

class RecordTest extends TestCase
{
    /**
     * @test
     */
    public function byRecordsIs(): void
    {
        $record = Record::byRecordsId(1);

        $this->assertSame(['records_id' => 1], $record->toArray());
    }

    /**
     * @test
     */
    public function byExternalId(): void
    {
        $record = Record::byExternalId('1');

        $this->assertSame(['external_id' => '1'], $record->toArray());
    }

    /**
     * @test
     */
    public function full(): void
    {
        $record = Record::byExternalId('1');
        $record->setValues(new AttributeValueCollection(new AttributeValue('Name', 'John')));
        $record->setNumbers(['123456789']);
        $record->setEmails(['john@example.org']);
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
