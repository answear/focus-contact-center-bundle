<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Response\FCC;

use Answear\FocusContactCenterBundle\Exception\MalformedResponse;
use Answear\FocusContactCenterBundle\ValueObject\IdMapping;
use Webmozart\Assert\Assert;

class AddRecords
{
    /**
     * @var IdMapping[]
     */
    private array $recordsId;

    /**
     * @param IdMapping[] $recordsId
     */
    public function __construct(array $recordsId)
    {
        Assert::allIsInstanceOf($recordsId, IdMapping::class);
        $this->recordsId = $recordsId;
    }

    public static function fromArray(array $response): self
    {
        try {
            Assert::keyExists($response, 'records_id');
            Assert::isArray($response['records_id']);
            $mappings = [];
            foreach ($response['records_id'] as $mapping) {
                if (!isset($mapping['fcc_id']) && !isset($mapping['id'])) {
                    throw new \InvalidArgumentException('Expected the key "fcc_id" or "id" to exist.');
                }
                Assert::keyExists($mapping, 'external_id');
                $mappings[] = new IdMapping($mapping['fcc_id'] ?? $mapping['id'], $mapping['external_id']);
            }

            return new self($mappings);
        } catch (\Throwable $e) {
            throw new MalformedResponse($e->getMessage(), $response, $e);
        }
    }

    public function getRecordsId(): array
    {
        return $this->recordsId;
    }
}
