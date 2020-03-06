<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Request\FCC\AddRecords;

use Answear\FocusContactCenterBundle\ValueObject\AttributeValueCollection;

class Record
{
    /**
     * @var string
     */
    private $externalId;

    /**
     * @var AttributeValueCollection
     */
    private $values;

    /**
     * @var string[]
     */
    private $numbers;

    /**
     * @var string[]
     */
    private $emails;

    /**
     * @var AttributeValueCollection
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

    public function __construct(string $externalId, AttributeValueCollection $values, array $numbers, array $emails)
    {
        $this->externalId = $externalId;
        $this->values = $values;
        $this->numbers = $numbers;
        $this->emails = $emails;
        $this->skills = new AttributeValueCollection();
    }

    public function setSkills(AttributeValueCollection $skills): void
    {
        $this->skills = $skills;
    }

    public function setPriority(?string $priority): void
    {
        $this->priority = $priority;
    }

    public function setClassifiersId(?string $classifiersId): void
    {
        $this->classifiersId = $classifiersId;
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

    public function setPrivate(?string $private): void
    {
        $this->private = $private;
    }

    public function setSlaGroupId(?string $slaGroupId): void
    {
        $this->slaGroupId = $slaGroupId;
    }

    public function setSegment(?string $segment): void
    {
        $this->segment = $segment;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function getValues(): AttributeValueCollection
    {
        return $this->values;
    }

    public function getNumbers(): array
    {
        return $this->numbers;
    }

    public function getEmails(): array
    {
        return $this->emails;
    }

    public function getSkills(): AttributeValueCollection
    {
        return $this->skills;
    }

    public function getPriority(): ?string
    {
        return $this->priority;
    }

    public function getPrivate(): ?string
    {
        return $this->private;
    }

    public function getRecall(): ?\DateTimeInterface
    {
        return $this->recall;
    }

    public function getClassifiersId(): ?string
    {
        return $this->classifiersId;
    }

    public function getSlaGroupId(): ?string
    {
        return $this->slaGroupId;
    }

    public function getSegment(): ?string
    {
        return $this->segment;
    }

    public function toArray(): array
    {
        $data = [
            'external_id' => $this->externalId,
            'numbers' => $this->numbers,
            'emails' => $this->emails,
        ];
        if (\count($this->values)) {
            $data['values'] = $this->values->toArray();
        }
        if (\count($this->skills)) {
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
