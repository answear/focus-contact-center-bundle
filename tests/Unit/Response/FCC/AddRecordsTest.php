<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Tests\Unit\Response\FCC;

use Answear\FocusContactCenterBundle\Exception\MalformedResponse;
use Answear\FocusContactCenterBundle\Response\FCC\AddRecords;
use Answear\FocusContactCenterBundle\ValueObject\IdMapping;
use PHPUnit\Framework\TestCase;

class AddRecordsTest extends TestCase
{
    /**
     * @test
     */
    public function correctResponse(): void
    {
        $response = AddRecords::fromArray(
            [
                'records_id' => [
                    ['fcc_id' => 1, 'external_id' => 'A'],
                    ['fcc_id' => 2, 'external_id' => 'B'],
                ],
            ]
        );

        $this->assertEquals(
            [
                new IdMapping(1, 'A'),
                new IdMapping(2, 'B'),
            ],
            $response->getRecordsId()
        );
    }

    /**
     * @test
     */
    public function noRecordsId(): void
    {
        $this->expectException(MalformedResponse::class);

        AddRecords::fromArray([]);
    }

    /**
     * @test
     */
    public function recordsIdIsNotAnArray(): void
    {
        $this->expectException(MalformedResponse::class);

        AddRecords::fromArray(['records_id' => true]);
    }

    /**
     * @test
     */
    public function noFccId(): void
    {
        $this->expectException(MalformedResponse::class);

        AddRecords::fromArray(['records_id' => ['external_id' => '1']]);
    }

    /**
     * @test
     */
    public function noExternalId(): void
    {
        $this->expectException(MalformedResponse::class);

        AddRecords::fromArray(['records_id' => ['fcc_id' => 1]]);
    }
}
