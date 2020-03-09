<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\ValueObject;

class AttributeValueCollection implements \IteratorAggregate
{
    /**
     * @var AttributeValue[]
     */
    private $attributes;

    public function __construct(AttributeValue ...$attributes)
    {
        $this->attributes = $attributes;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->attributes);
    }
}
