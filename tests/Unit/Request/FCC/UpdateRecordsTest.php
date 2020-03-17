<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Tests\Unit\Request\FCC;

use Answear\FocusContactCenterBundle\Request\FCC\UpdateRecords;
use PHPUnit\Framework\TestCase;

class UpdateRecordsTest extends TestCase
{
    /**
     * @test
     */
    public function requestIsCorrect(): void
    {
        $r1 = $this->createStub(UpdateRecords\Record::class);
        $r1->method('toArray')->willReturn(['external_id' => '1']);

        $r2 = $this->createStub(UpdateRecords\Record::class);
        $r2->method('toArray')->willReturn(['external_id' => '2']);

        $request = new UpdateRecords([$r1, $r2]);

        $this->assertSame(
            [
                'updates' => [
                    $r1->toArray(),
                    $r2->toArray(),
                ],
            ],
            $request->toArray()
        );
    }
}
