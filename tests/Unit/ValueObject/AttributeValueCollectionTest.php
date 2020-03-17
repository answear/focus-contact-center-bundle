<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Tests\Unit\ValueObject;

use Answear\FocusContactCenterBundle\ValueObject\AttributeValue;
use Answear\FocusContactCenterBundle\ValueObject\AttributeValueCollection;
use PHPUnit\Framework\TestCase;

class AttributeValueCollectionTest extends TestCase
{
    /**
     * @test
     */
    public function isConvertedToAssociativeArray(): void
    {
        $this->assertSame(
            [
                'Name' => 'John',
                'Surname' => 'Doe',
            ],
            (new AttributeValueCollection(
                new AttributeValue('Name', 'John'),
                new AttributeValue('Surname', 'Doe')
            ))->toArray()
        );
    }
}
