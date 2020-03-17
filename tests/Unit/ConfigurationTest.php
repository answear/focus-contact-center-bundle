<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Tests\Unit;

use Answear\FocusContactCenterBundle\Configuration;
use Answear\FocusContactCenterBundle\PseudorandomChangeGenerator;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    /**
     * @test
     */
    public function apiUrlIsTrimmed(): void
    {
        $config = new Configuration(
            'https://example.org/',
            'test@example.org',
            '1',
            1,
            'sha1',
            new PseudorandomChangeGenerator()
        );

        $this->assertSame('https://example.org', $config->getUrl());
    }

    /**
     * @test
     */
    public function unsupportedHashMethodIsRejected(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/Got: "md1"/');

        new Configuration(
            'https://example.org',
            'test@example.org',
            '1',
            1,
            'md1',
            new PseudorandomChangeGenerator()
        );
    }

    /**
     * @test
     */
    public function loginMustContainAtCharacter(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Expected a value to contain "@". Got: "test"');

        new Configuration(
            'https://example.org',
            'test',
            '1',
            1,
            'sha1',
            new PseudorandomChangeGenerator()
        );
    }
}
