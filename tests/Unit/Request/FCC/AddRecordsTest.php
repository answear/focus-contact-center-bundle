<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Tests\Unit\Request\FCC;

use Answear\FocusContactCenterBundle\Request\FCC\AddRecords;
use PHPUnit\Framework\TestCase;

class AddRecordsTest extends TestCase
{
    /**
     * @test
     */
    public function requestIsCorrect(): void
    {
        $r1 = $this->createStub(AddRecords\Record::class);
        $r1->method('toArray')->willReturn(['external_id' => '1']);

        $r2 = $this->createStub(AddRecords\Record::class);
        $r2->method('toArray')->willReturn(['external_id' => '2']);

        $request = new AddRecords([$r1, $r2]);

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
