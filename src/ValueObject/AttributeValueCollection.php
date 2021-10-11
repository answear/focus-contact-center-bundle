<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\ValueObject;

class AttributeValueCollection implements \IteratorAggregate, \Countable
{
    /**
     * @var AttributeValue[]
     */
    private array $attributes;

    public function __construct(AttributeValue ...$attributes)
    {
        $this->attributes = $attributes;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->attributes);
    }

    public function count(): int
    {
        return \count($this->attributes);
    }

    public function toArray(): array
    {
        $data = [];
        foreach ($this->attributes as $attribute) {
            $data[$attribute->getAttribute()] = $attribute->getValue();
        }

        return $data;
    }
}
