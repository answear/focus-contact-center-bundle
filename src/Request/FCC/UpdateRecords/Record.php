<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Request\FCC\UpdateRecords;

use Answear\FocusContactCenterBundle\ValueObject\AttributeValueCollection;

class Record
{
    /**
     * @var string|null
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

    private function __construct(?string $recordsId, ?string $externalId)
    {
        $this->recordsId = $recordsId;
        $this->externalId = $externalId;
    }

    public static function byRecordsId(string $recordsId): self
    {
        return new self($recordsId, null);
    }

    public static function byExternalId(string $externalId): self
    {
        return new self(null, $externalId);
    }

    public function getRecordsId(): ?string
    {
        return $this->recordsId;
    }

    public function setRecordsId(?string $recordsId): void
    {
        $this->recordsId = $recordsId;
    }

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function setExternalId(?string $externalId): void
    {
        $this->externalId = $externalId;
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
}
