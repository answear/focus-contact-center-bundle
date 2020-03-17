<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Tests\Unit\Response\FCC;

use Answear\FocusContactCenterBundle\Exception\MalformedResponse;
use Answear\FocusContactCenterBundle\Response\FCC\UpdateRecords;
use PHPUnit\Framework\TestCase;

class UpdateRecordsTest extends TestCase
{
    /**
     * @test
     */
    public function correctResponse(): void
    {
        $response = UpdateRecords::fromArray(['updated' => 1]);

        $this->assertSame(1, $response->getUpdated());
    }

    /**
     * @test
     */
    public function noUpdated(): void
    {
        $this->expectException(MalformedResponse::class);

        UpdateRecords::fromArray([]);
    }
}
