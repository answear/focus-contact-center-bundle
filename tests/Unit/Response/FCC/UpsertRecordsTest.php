<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Tests\Unit\Response\FCC;

use Answear\FocusContactCenterBundle\Exception\MalformedResponse;
use Answear\FocusContactCenterBundle\Response\FCC\UpsertRecords;
use PHPUnit\Framework\TestCase;

class UpsertRecordsTest extends TestCase
{
    /**
     * @test
     */
    public function correctResponse(): void
    {
        $response = UpsertRecords::fromArray(
            [
                'success' => true,
                'records' => [
                    ['id' => 1, 'action' => 'update', 'external_id' => 'A'],
                    ['id' => 2, 'action' => 'update', 'external_id' => 'B'],
                ],
            ]
        );

        $this->assertTrue($response->isSuccess());
        $this->assertEquals(
            [
                new UpsertRecords\Result(1, 'update', 'A'),
                new UpsertRecords\Result(2, 'update', 'B'),
            ],
            $response->getRecords()
        );
    }

    /**
     * @test
     */
    public function unsuccessfulResponse(): void
    {
        $response = UpsertRecords::fromArray(
            [
                'success' => false,
                'records' => [],
            ]
        );

        $this->assertFalse($response->isSuccess());
        $this->assertSame([], $response->getRecords());
    }

    /**
     * @test
     */
    public function noSuccess(): void
    {
        $this->expectException(MalformedResponse::class);

        UpsertRecords::fromArray(['records' => []]);
    }

    /**
     * @test
     */
    public function noRecords(): void
    {
        $this->expectException(MalformedResponse::class);

        UpsertRecords::fromArray(['success' => true]);
    }

    /**
     * @test
     */
    public function recordsIdNotAnArray(): void
    {
        $this->expectException(MalformedResponse::class);

        UpsertRecords::fromArray(['success' => true, 'records_id' => true]);
    }

    /**
     * @test
     */
    public function noIdInResult(): void
    {
        $this->expectException(MalformedResponse::class);

        UpsertRecords::fromArray(
            [
                'success' => true,
                'records' => [
                    ['action' => 'update', 'external_id' => 'A'],
                ],
            ]
        );
    }

    /**
     * @test
     */
    public function noActionInResult(): void
    {
        $this->expectException(MalformedResponse::class);

        UpsertRecords::fromArray(
            [
                'success' => true,
                'records' => [
                    ['id' => 1, 'external_id' => 'A'],
                ],
            ]
        );
    }

    /**
     * @test
     */
    public function noExternalIdInResult(): void
    {
        $this->expectException(MalformedResponse::class);

        UpsertRecords::fromArray(
            [
                'success' => true,
                'records' => [
                    ['id' => 1, 'action' => 'update'],
                ],
            ]
        );
    }
}
