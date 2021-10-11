<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Tests\Unit\Request\FCC;

use Answear\FocusContactCenterBundle\Request\FCC\UpsertRecords;
use PHPUnit\Framework\TestCase;

class UpsertRecordsTest extends TestCase
{
    /**
     * @test
     */
    public function requestIsCorrect(): void
    {
        $r1 = $this->createStub(UpsertRecords\Record::class);
        $r1->method('toArray')->willReturn(['external_id' => '1']);

        $r2 = $this->createStub(UpsertRecords\Record::class);
        $r2->method('toArray')->willReturn(['external_id' => '2']);

        $request = new UpsertRecords([$r1, $r2]);

        $this->assertSame(
            [
                'records' => [
                    $r1->toArray(),
                    $r2->toArray(),
                ],
            ],
            $request->toArray()
        );
    }
}
