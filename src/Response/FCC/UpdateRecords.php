<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Response\FCC;

use Answear\FocusContactCenterBundle\Exception\MalformedResponse;
use Webmozart\Assert\Assert;

class UpdateRecords
{
    /**
     * @var int
     */
    private $updated;

    public function __construct(int $updated)
    {
        $this->updated = $updated;
    }

    public static function fromArray(array $response): self
    {
        try {
            Assert::keyExists($response, 'updated');

            return new self($response['updated']);
        } catch (\Throwable $e) {
            throw new MalformedResponse($e->getMessage(), $response, $e);
        }
    }

    public function getUpdated(): int
    {
        return $this->updated;
    }
}
