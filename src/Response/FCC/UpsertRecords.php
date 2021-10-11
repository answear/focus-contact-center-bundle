<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Response\FCC;

use Answear\FocusContactCenterBundle\Exception\MalformedResponse;
use Webmozart\Assert\Assert;

class UpsertRecords
{
    private bool $success;
    private array $records;

    public function __construct(bool $success, array $records)
    {
        $this->success = $success;
        Assert::allIsInstanceOf($records, UpsertRecords\Result::class);
        $this->records = $records;
    }

    public static function fromArray(array $response): self
    {
        try {
            Assert::keyExists($response, 'success');
            Assert::keyExists($response, 'records');
            Assert::isArray($response['records']);
            $records = [];
            foreach ($response['records'] as $record) {
                Assert::keyExists($record, 'id');
                Assert::keyExists($record, 'action');
                Assert::keyExists($record, 'external_id');
                $records[] = new UpsertRecords\Result($record['id'], $record['action'], $record['external_id']);
            }

            return new self($response['success'], $records);
        } catch (\Throwable $e) {
            throw new MalformedResponse($e->getMessage(), $response, $e);
        }
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getRecords(): array
    {
        return $this->records;
    }
}
