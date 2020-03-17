<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Tests\Unit;

use Answear\FocusContactCenterBundle\ChangeGenerator;
use Answear\FocusContactCenterBundle\Configuration;
use Answear\FocusContactCenterBundle\HashGenerator;
use PHPUnit\Framework\TestCase;

class HashGeneratorTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideHashIsCorrect
     */
    public function hashIsCorrect(string $method, string $expected): void
    {
        $config = new Configuration(
            'https://example.org',
            'test@example.org',
            'apikey',
            1,
            $method,
            new class() implements ChangeGenerator {
                public function generate(): string
                {
                    return 'change';
                }
            }
        );

        $generator = new HashGenerator($config);
        $this->assertSame($expected, $generator->hash('change'));
    }

    public function provideHashIsCorrect(): iterable
    {
        yield 'sha1' => ['sha1', 'e5e49a1767ad90ca997914dbc10f28b6c1e03437'];
        yield 'md5' => ['md5', '934d1b26bdbe5ed66c4e8fef6a395ddc'];
    }
}
