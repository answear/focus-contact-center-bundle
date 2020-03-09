<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Request;

interface Request
{
    /**
     * Converts request object to an array that will be sent via the API.
     */
    public function toArray(): array;
}
