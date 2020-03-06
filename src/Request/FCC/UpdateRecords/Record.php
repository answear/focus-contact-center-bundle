<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Request\FCC\UpdateRecords;

use Answear\FocusContactCenterBundle\ValueObject\AttributeValueCollection;

class Record
{
    /**
     * @var int|null
     */
    private $recordsId;

    /**
     * @var string|null
     */
    private $externalId;

    /**
     * @var AttributeValueCollection|null
     */
    private $values;

    /**
     * @var string[]|null
     */
    private $numbers;

    /**
     * @var string[]|null
     */
    private $emails;

    /**
     * @var AttributeValueCollection|null
     */
    private $skills;

    /**
     * @var string|null
     */
    private $priority;

    /**
     * @var string|null
     */
    private $private;

    /**
     * @var \DateTimeInterface|null
     */
    private $recall;

    /**
     * @var string|null
     */
    private $classifiersId;

    /**
     * @var string|null
     */
    private $slaGroupId;

    /**
     * @var string|null
     */
    private $segment;

    private function __construct(?int $recordsId, ?string $externalId)
    {
        $this->recordsId = $recordsId;
        $this->externalId = $externalId;
    }

    public static function byRecordsId(int $recordsId): self
    {
        return new self($recordsId, null);
    }

    public static function byExternalId(string $externalId): self
    {
        return new self(null, $externalId);
    }

    public function getRecordsId(): ?int
    {
        return $this->recordsId;
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

    public function getSkills(): ?AttributeValueCollection
    {
        return $this->skills;
    }

    public function setSkills(?AttributeValueCollection $skills): void
    {
        $this->skills = $skills;
    }

    public function getPriority(): ?string
    {
        return $this->priority;
    }

    public function setPriority(?string $priority): void
    {
        $this->priority = $priority;
    }

    public function getPrivate(): ?string
    {
        return $this->private;
    }

    public function setPrivate(?string $private): void
    {
        $this->private = $private;
    }

    public function clearRecall(): void
    {
        $this->recall = null;
        $this->classifiersId = null;
    }

    public function setRecall(\DateTimeInterface $recall, string $classifiersId): void
    {
        $this->recall = $recall;
        $this->classifiersId = $classifiersId;
    }

    public function getSlaGroupId(): ?string
    {
        return $this->slaGroupId;
    }

    public function setSlaGroupId(?string $slaGroupId): void
    {
        $this->slaGroupId = $slaGroupId;
    }

    public function getSegment(): ?string
    {
        return $this->segment;
    }

    public function setSegment(?string $segment): void
    {
        $this->segment = $segment;
    }

    public function toArray(): array
    {
        $data = [];
        if ($this->recordsId) {
            $data['records_id'] = $this->recordsId;
        } else {
            $data['external_id'] = $this->externalId;
        }
        if (null !== $this->numbers) {
            $data['numbers'] = $this->numbers;
        }
        if (null !== $this->emails) {
            $data['emails'] = $this->emails;
        }
        if (null !== $this->values && \count($this->values)) {
            $data['values'] = $this->values->toArray();
        }
        if (null !== $this->skills && \count($this->skills)) {
            $data['skills'] = $this->skills->toArray();
        }
        if (null !== $this->priority) {
            $data['priority'] = $this->priority;
        }
        if (null !== $this->private) {
            $data['private'] = $this->private;
        }
        if (null !== $this->recall) {
            $data['recall'] = $this->recall->format('Y-m-d H:i');
        }
        if (null !== $this->classifiersId) {
            $data['classifiers_id'] = $this->classifiersId;
        }
        if (null !== $this->slaGroupId) {
            $data['sla_group_id'] = $this->slaGroupId;
        }
        if (null !== $this->segment) {
            $data['segment'] = $this->segment;
        }

        return $data;
    }
}
