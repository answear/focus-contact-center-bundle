<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Request\FCC\UpsertRecords;

use Answear\FocusContactCenterBundle\ValueObject\AttributeValueCollection;

class Record
{
    private string $externalId;
    private ?AttributeValueCollection $values = null;
    /**
     * @var string[]|null
     */
    private ?array $numbers = null;
    /**
     * @var string[]|null
     */
    private ?array $emails = null;
    /**
     * @var string[]|null
     */
    private ?array $segments = null;

    public function __construct(string $externalId)
    {
        $this->externalId = $externalId;
    }

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function getValues(): ?AttributeValueCollection
    {
        return $this->values;
    }

    public function setValues(?AttributeValueCollection $values): void
    {
        $this->values = $values;
    }

    public function getNumbers(): ?array
    {
        return $this->numbers;
    }

    public function setNumbers(?array $numbers): void
    {
        $this->numbers = $numbers;
    }

    public function getEmails(): ?array
    {
        return $this->emails;
    }

    public function setEmails(?array $emails): void
    {
        $this->emails = $emails;
    }

    public function getSegments(): ?array
    {
        return $this->segments;
    }

    public function setSegments(?array $segments): void
    {
        $this->segments = $segments;
    }

    public function toArray(): array
    {
        $data = ['external_id' => $this->externalId];
        if (null !== $this->numbers) {
            $data['numbers'] = $this->numbers;
        }
        if (null !== $this->emails) {
            $data['emails'] = $this->emails;
        }
        if (null !== $this->values && \count($this->values)) {
            $data['values'] = $this->values->toArray();
        }
        if (null !== $this->segments) {
            $data['segments'] = $this->segments;
        }

        return $data;
    }
}
